<?php

namespace Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents;

use Uctoplus\UblWrapper\UBL\Schema\AggregateComponent;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\PartecipationPercentType;

/**
 * Class ShareholderPartyType
 *
 * @copyright uctoplus.sk, a.s.
 * @package Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents
 *
 * @method PartecipationPercentType getPartecipationPercent()
 * @method self setPartecipationPercent(PartecipationPercentType|string $value)
 * @method PartyType getParty()
 * @method self setParty(PartyType $value)
 */
class ShareholderPartyType extends AggregateComponent
{
    protected $casts = [
        "cbc:PartecipationPercent" => PartecipationPercentType::class,
        "cac:Party" => PartyType::class,
    ];

    protected $minOccurs = [
    ];
}