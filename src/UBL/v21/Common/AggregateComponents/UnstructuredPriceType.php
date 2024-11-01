<?php

namespace Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents;

use Uctoplus\UblWrapper\UBL\Schema\AggregateComponent;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\PriceAmountType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\TimeAmountType;

/**
 * Class UnstructuredPriceType
 *
 * @copyright uctoplus.sk, a.s.
 * @package Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents
 *
 * @method PriceAmountType getPriceAmount()
 * @method self setPriceAmount(PriceAmountType|string $value)
 * @method TimeAmountType getTimeAmount()
 * @method self setTimeAmount(TimeAmountType|string $value)
 */
class UnstructuredPriceType extends AggregateComponent
{
    protected $casts = [
        "cbc:PriceAmount" => PriceAmountType::class,
        "cbc:TimeAmount" => TimeAmountType::class,
    ];

    protected $minOccurs = [
    ];
}