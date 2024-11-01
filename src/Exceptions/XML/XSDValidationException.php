<?php

namespace Uctoplus\UblWrapper\Exceptions\XML;

use Exception;
use Throwable;

/**
 * Class XSDValidationException
 *
 * @author Mário <mario@uctoplus.sk>
 * @copyright uctoplus.sk, a.s.
 * @package Uctoplus\UblWrapper\XML\Exceptions
 */
class XSDValidationException extends Exception
{
    public function __construct($name, $cast, Throwable $previous = null)
    {
        parent::__construct("Attribute[" . $name . "] has not valid type[" . $cast . "]!");
    }
}