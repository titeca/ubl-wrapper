<?php

namespace Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents;

use Uctoplus\UblWrapper\UBL\Schema\BasicComponent;

/**
 *
 * @method mixed getTimeType()
 * @method self setTimeType(string $value)
 */
class GuaranteedDespatchTimeType extends BasicComponent
{
    protected $type = "udt:TimeType";
}