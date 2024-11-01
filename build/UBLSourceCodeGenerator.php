<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Uctoplus\UblWrapper\UBL\Schema\AggregateComponent;
use Uctoplus\UblWrapper\UBL\Schema\BasicComponent;
use Uctoplus\UblWrapper\UBL\Schema\MainDoc;

class UBLSourceCodeGenerator extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'generate';

    private $xsd_Type;
    private $xsd_Version;
    /**
     * @var OutputInterface
     */
    private $output;

    private $nameToType = [];

    protected function configure(): void
    {
        $this->setHelp('This command allows you to create a user...');

        $this->addArgument('file_path', InputArgument::REQUIRED, 'Path to XSD file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->output = $output;
        $file_path = $input->getArgument('file_path');

        if (!file_exists($file_path)) {
            $this->output->writeln("<error>File not found!</error>");
            return Command::FAILURE;
        }

        $file = file_get_contents($file_path);

        $xml = simplexml_load_string($file);

        $nameToType = [];

        /** @var DOMNode $element */
        //elements -> name => type
        foreach ($xml->xpath('//xsd:element') as $element) {
            $attributes = $element->attributes();

            if ($attributes != null && empty($attributes['ref'])) {
                $nameToType[(string)$attributes['name']] = (string)$attributes['type'];
            } else {
                break;
            }
        }

        $this->nameToType = $nameToType;

        $domDoc = new DOMDocument();
        $domDoc->load($file_path);

        $xpathvar = new DOMXPath($domDoc);

        foreach ($xpathvar->query('//xsd:schema')->item(0)->attributes as $attribute) {
            if ($attribute->localName === "targetNamespace") {
                $this->xsd_Type = $attribute->value;
            }
            if ($attribute->localName === "version") {
                $this->xsd_Version = "v" . str_replace('.', '', $attribute->value);
            }
        }

        $this->output->writeln("Type of Scheme: " . $this->xsd_Type);
        $this->output->writeln("Version of Scheme: " . $this->xsd_Version);

        if ($this->xsd_Type === AggregateComponent::XMLNS_URI)
            $this->generateCacClasses($domDoc, $xpathvar);
        elseif ($this->xsd_Type === BasicComponent::XMLNS_URI)
            $this->generateCbcClasses($domDoc, $xpathvar);
        else {
            $this->generateMainDocClasses($domDoc, $xpathvar);
        }

        return Command::SUCCESS;
    }

    /**
     * @param $type
     * @return string|null
     */
    private function _getClass($type, $_subElementNamespace = null)
    {
        if (!empty($_subElementNamespace)) {
            switch ($_subElementNamespace) {
                case "cac":
                    return 'Uctoplus\UblWrapper\UBL\\' . $this->xsd_Version . '\Common\AggregateComponents\\' . $type;
                case "cbc":
                    return 'Uctoplus\UblWrapper\UBL\\' . $this->xsd_Version . '\Common\BasicComponents\\' . $type;
                case "udt":
                    return 'Uctoplus\UblWrapper\UBL\\' . $this->xsd_Version . '\Common\UnqualifiedDataTypes\\' . $type;
                default:
                    return null;
            }
        } else {
            switch ($this->xsd_Type) {
                case AggregateComponent::XMLNS_URI:
                    return 'Uctoplus\UblWrapper\UBL\\' . $this->xsd_Version . '\Common\AggregateComponents\\' . $type;
                case BasicComponent::XMLNS_URI:
                    return 'Uctoplus\UblWrapper\UBL\\' . $this->xsd_Version . '\Common\BasicComponents\\' . $type;
                default:
                    return null;
            }
        }
    }

    /**
     * @param $name
     * @param $complexType
     * @param $forCbcType
     * @return void
     * @throws Exception
     */
    private function _generateClassFile($name, $complexType)
    {
        $type = $name;
        $class = $this->_getClass($type);

        if (empty($class))
            throw new Exception('Empty class data');

        $uses = [];
        $casts = [];
        $minOccurs = [];
        $methods = [];

        $forCbcType = false;

        switch ($this->xsd_Type) {
            case AggregateComponent::XMLNS_URI:
                $_schema = Uctoplus\UblWrapper\UBL\Schema\AggregateComponent::class;
                break;
            case BasicComponent::XMLNS_URI:
                $forCbcType = true;
                $_schema = Uctoplus\UblWrapper\UBL\Schema\BasicComponent::class;
                break;
            default:
                throw new Exception('Unknown xsd type');
        }

        $uses[] = $_schema;

        //process
        foreach ($complexType as $castData) {
            if ($forCbcType) {
                //type
                $_cxcVal = $castData['type'];
            } else {
                //..casts
                $_cxcVal = $castData['name'];
            }

            list($_subElementNamespace, $_subElementName) = explode(":", $_cxcVal);
            $_type = $this->getTypeFromName($_subElementName);
            $_classData = $this->_getClass($_type, $_subElementNamespace);

            $_className = substr($_classData, strrpos($_classData, '\\') + 1);
            $casts[$_cxcVal] = $_className;
            $casts[$_cxcVal] .= '::class';

            //..uses
            if (!$forCbcType) {
                if (!in_array($_classData, $uses) && $_classData != $class)
                    $uses[] = $_classData;
            }

            //methods
            if (!$forCbcType) {
                if ($castData['maxOccurs'] > 1 || $castData['maxOccurs'] === 'unbounded') {
                    $methods[] = $_type . '[] get' . $_subElementName . '()';
                    $methods[] = 'self add' . $_subElementName . '(' . $_type . ($_subElementNamespace === "cbc" ? "|string" : "") . ' $value)';
                    $methods[] = 'self set' . $_subElementName . '(' . $_type . ' ...$values)';
                } else {
                    $methods[] = $_type . ' get' . $_subElementName . '()';
                    $methods[] = 'self set' . $_subElementName . '(' . $_type . ($_subElementNamespace === "cbc" ? "|string" : "") . ' $value)';
                }

                //..array?
                if ($castData['maxOccurs'] > 1 || $castData['maxOccurs'] === 'unbounded') {
                    $casts[$_cxcVal] .= ' . "[]"';
                }

                //..minOccurs
                if ($castData['minOccurs'] >= 1) {
                    $minOccurs[$_cxcVal] = $castData['minOccurs'];
                }
            }
        }

//        dd($uses, $casts, $minOccurs);

        //file generation
        $content = '<?php' . PHP_EOL . PHP_EOL;

        $_namespace = substr($class, 0, strrpos($class, '\\'));
        $content .= 'namespace ' . $_namespace . ';' . PHP_EOL . PHP_EOL;

        //uses
        foreach ($uses as $use) {
            $content .= 'use ' . $use . ';' . PHP_EOL;
        }

        $content .= PHP_EOL . '/**' . PHP_EOL;
        $content .= ' * Class ' . $type . PHP_EOL;
        $content .= ' *' . PHP_EOL;
        $content .= ' * @copyright uctoplus.sk, a.s.' . PHP_EOL;
        $content .= ' * @package ' . $_namespace . PHP_EOL;
        //methods
        if (count($methods)) {
            $content .= ' *' . PHP_EOL;

            foreach ($methods as $method) {
                $content .= ' * @method ' . $method . PHP_EOL;
            }
        }
        $content .= ' */' . PHP_EOL;

        //class
        if ($forCbcType) {
            list($namespace, $name) = explode(":", array_key_first($casts));
            $_schema = 'Uctoplus\UblWrapper\UBL\\' . $this->xsd_Version . '\Common\UnqualifiedDataTypes\\' . ucfirst($name);
            $content .= 'class ' . $type . ' extends \\' . $_schema . PHP_EOL;
            $content .= '{' . PHP_EOL;

            //type
//            $content .= 'protected $type = "' . array_key_first($casts) . '";' . PHP_EOL;
        } else {

            $content .= 'class ' . $type . ' extends \\' . $_schema . PHP_EOL;
            $content .= '{' . PHP_EOL;
            //casts
            $content .= '    protected $casts = [' . PHP_EOL;
            foreach ($casts as $cxcVal => $cast) {
                $content .= '        "' . $cxcVal . '" => ' . $cast . ',' . PHP_EOL;
            }
            $content .= '    ];' . PHP_EOL;

            $content .= PHP_EOL;

            //minOccurs
            $content .= '    protected $minOccurs = [' . PHP_EOL;
            foreach ($minOccurs as $cxcVal => $minOccur) {
                $content .= '        "' . $cxcVal . '" => ' . $minOccur . ',' . PHP_EOL;
            }
            $content .= '    ];' . PHP_EOL;
        }

        $content .= '}';

        try {
            $file_path = str_replace(array('Uctoplus\UblWrapper', '\\'), array('', DIRECTORY_SEPARATOR), $class);
            $file_path = ltrim($file_path, DIRECTORY_SEPARATOR);

            file_put_contents("src/" . $file_path . ".php", $content);
        } catch (Throwable $throwable) {
            dd($throwable);
        }
    }

    private function getTypeFromName($name)
    {
        return $this->nameToType[$name] ?? $name . 'Type';
    }

    /**
     * @return void
     */
    public function generateCacClasses(DOMDocument $domDoc, DOMXPath $xpathvar)
    {
        //complex types
        $complexTypes = [];

        /** @var DOMElement $complexType */
        foreach ($xpathvar->query('//xsd:complexType') as $complexType) {
            $name = $complexType->getAttribute('name');

            /** @var DOMElement $xsdElement */
            foreach ($xpathvar->query('.//xsd:element', $complexType) as $xsdElement) {
                $xsdElementData = [
                    'name' => $xsdElement->getAttribute('ref'),
                    'minOccurs' => $xsdElement->getAttribute('minOccurs'),
                    'maxOccurs' => $xsdElement->getAttribute('maxOccurs'),
                ];

                $complexTypes[$name][] = $xsdElementData;
            }
        }

        $nameToType = [];
        /** @var DOMElement $xsdElement */
        foreach ($xpathvar->query('./xsd:element') as $xsdElement) {
            $nameToType[$xsdElement->getAttribute('type')][] = $xsdElement->getAttribute('name');
        }
        file_put_contents("build/aggregatedComponents.map", json_encode($nameToType));

        //generates
        foreach ($complexTypes as $name => $complexType) {
            $this->output->writeln($name, OutputInterface::VERBOSITY_DEBUG);
            $this->_generateClassFile($name, $complexType);
        }

    }

    /**
     * @return void
     */
    public function generateCbcClasses(DOMDocument $domDoc, DOMXPath $xpathvar)
    {
        $complexTypes = [];

        /** @var DOMElement $complexType */
        foreach ($xpathvar->query('//xsd:complexType') as $complexType) {
            $name = $complexType->getAttribute('name');

            /** @var DOMElement $xsdElement */
            foreach ($xpathvar->query('.//xsd:extension', $complexType) as $xsdElement) {
                $complexTypes[$name][] = [
                    'type' => $xsdElement->getAttribute('base')
                ];
            }
        }

        //generates
        foreach ($complexTypes as $name => $complexType) {
            $this->output->writeln($name, OutputInterface::VERBOSITY_DEBUG);
            $this->_generateClassFile($name, $complexType);
        }
    }

    /**
     * @return void
     */
    public function generateMainDocClasses(DOMDocument $domDoc, DOMXPath $xpathvar)
    {
        $complexTypes = [];

        /** @var DOMElement $complexType */
        foreach ($xpathvar->query('./xsd:element') as $complexType) {
            $name = $complexType->getAttribute('name');

            $this->_generateMainDocFile($name, $domDoc, $xpathvar);
        }
    }

    private function _generateMainDocFile(string $name, DOMDocument $domDoc, DOMXPath $xpathvar)
    {
        $class = 'Uctoplus\UblWrapper\UBL\\' . $this->xsd_Version . '\MainDoc\\' . $name;
        $_schema = MainDoc::class;
        $aggregatedMap = json_decode(file_get_contents("build/aggregatedComponents.map"), true);

        $complexType = $xpathvar->query('//xsd:complexType')->item(0);

        $complexTypes = [];

        /** @var DOMElement $xsdElement */
        foreach ($xpathvar->query('.//xsd:element', $complexType) as $xsdElement) {
            if ($xsdElement->getAttribute('ref') === "ext:UBLExtensions")
                continue;

            if ($xsdElement->getAttribute('ref') === "cbc:UBLVersionID")
                continue;

            $xsdElementData = [
                'name' => $xsdElement->getAttribute('ref'),
                'minOccurs' => $xsdElement->getAttribute('minOccurs'),
                'maxOccurs' => $xsdElement->getAttribute('maxOccurs'),
            ];

            $complexTypes[] = $xsdElementData;
        }

        $uses[] = $_schema;

        //process
        foreach ($complexTypes as $castData) {
            $_cxcVal = $castData['name'];

            list($_subElementNamespace, $_subElementName) = explode(":", $_cxcVal);
            $_type = $this->getTypeFromName($_subElementName);
            $_classData = $this->_getClass($_type, $_subElementNamespace);

            if (!class_exists($_classData)) {
                foreach ($aggregatedMap as $classFromMap => $alternatives) {
                    if (in_array($_subElementName, $alternatives)) {
                        $_type = $classFromMap;
                        $_classData = $this->_getClass($_type, $_subElementNamespace);
                    }
                }
            }

            $_className = substr($_classData, strrpos($_classData, '\\') + 1);

            $casts[$_cxcVal] = $_className;
            $casts[$_cxcVal] .= '::class';


            //..uses
            if (!in_array($_classData, $uses) && $_classData != $class)
                $uses[] = $_classData;

            //methods
            if ($castData['maxOccurs'] > 1 || $castData['maxOccurs'] === 'unbounded') {
                $methods[] = $_type . '[] get' . $_subElementName . '()';
                $methods[] = 'self add' . $_subElementName . '(' . $_type . ($_subElementNamespace === "cbc" ? "|string" : "") . ' $value)';
                $methods[] = 'self set' . $_subElementName . '(' . $_type . ' ...$values)';
            } else {
                $methods[] = $_type . ' get' . $_subElementName . '()';
                $methods[] = 'self set' . $_subElementName . '(' . $_type . ($_subElementNamespace === "cbc" ? "|string" : "") . ' $value)';
            }

            //..array?
            if ($castData['maxOccurs'] > 1 || $castData['maxOccurs'] === 'unbounded') {
                $casts[$_cxcVal] .= ' . "[]"';
            }

            //..minOccurs
            if ($castData['minOccurs'] >= 1) {
                $minOccurs[$_cxcVal] = $castData['minOccurs'];
            }
        }

//        dd($uses, $casts, $minOccurs);

        //file generation
        $content = '<?php' . PHP_EOL . PHP_EOL;

        $_namespace = substr($class, 0, strrpos($class, '\\'));
        $content .= 'namespace ' . $_namespace . ';' . PHP_EOL . PHP_EOL;

        $content .= 'use Uctoplus\UblWrapper\UBL\\' . $this->xsd_Version . '\Version;' . PHP_EOL;

        //uses
        foreach ($uses as $use) {
            $content .= 'use ' . $use . ';' . PHP_EOL;
        }

        $content .= PHP_EOL . '/**' . PHP_EOL;
        $content .= ' * Class ' . $name . PHP_EOL;
        $content .= ' *' . PHP_EOL;
        $content .= ' * @copyright uctoplus.sk, a.s.' . PHP_EOL;
        $content .= ' * @package ' . $_namespace . PHP_EOL;
        //methods
        if (count($methods)) {
            $content .= ' *' . PHP_EOL;

            foreach ($methods as $method) {
                $content .= ' * @method ' . $method . PHP_EOL;
            }
        }
        $content .= ' */' . PHP_EOL;

        //class
        $content .= 'class ' . $name . ' extends \\' . $_schema . PHP_EOL;
        $content .= '{' . PHP_EOL;

        $content .= '    protected $UBLVersionID = Version::VERSION_CODE;' . PHP_EOL;
        $content .= '    protected $xmlns = "' . $this->xsd_Type . '";' . PHP_EOL . PHP_EOL;


        //casts
        $content .= '    protected $casts = [' . PHP_EOL;
        foreach ($casts as $cxcVal => $cast) {
            $content .= '        "' . $cxcVal . '" => ' . $cast . ',' . PHP_EOL;
        }
        $content .= '    ];' . PHP_EOL;

        $content .= PHP_EOL;

        //minOccurs
        $content .= '    protected $minOccurs = [' . PHP_EOL;
        foreach ($minOccurs as $cxcVal => $minOccur) {
            $content .= '        "' . $cxcVal . '" => ' . $minOccur . ',' . PHP_EOL;
        }
        $content .= '    ];' . PHP_EOL;

        $content .= '}';

        try {
            $file_path = str_replace(array('Uctoplus\UblWrapper', '\\'), array('', DIRECTORY_SEPARATOR), $class);
            $file_path = ltrim($file_path, DIRECTORY_SEPARATOR);

            file_put_contents("src/" . $file_path . ".php", $content);
        } catch (Throwable $throwable) {
            dd($throwable);
        }
    }
}