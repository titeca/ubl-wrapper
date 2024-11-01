<?php

namespace Uctoplus\UblWrapper\UBL\v21\Common\UnqualifiedDataTypes;

use Uctoplus\UblWrapper\UBL\Schema\BasicComponent;

/**
 * Class AmountType
 *
 * @author Mário <mario@uctoplus.sk>
 * @copyright uctoplus.sk, a.s.
 * @package Uctoplus\UblWrapper\UBL\v21\Common\UnqualifiedDataTypes
 *
 * @method mixed getCurrencyIDAttribute()
 * @method self setCurrencyIDAttribute($string)
 * @method mixed getCurrencyCodeListVersionIDAttribute()
 * @method self setCurrencyCodeListVersionIDAttribute($string)
 */
class AmountType extends BasicComponent
{
    protected $type = "udt:AmountType";

    protected $attributeCasts = [
        'currencyID' => true,
        'currencyCodeListVersionID' => false,
    ];
}