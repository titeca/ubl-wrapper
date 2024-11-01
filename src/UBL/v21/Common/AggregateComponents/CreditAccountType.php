<?php

namespace Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents;

use Uctoplus\UblWrapper\UBL\Schema\AggregateComponent;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\AccountIDType;

/**
 * Class CreditAccountType
 *
 * @copyright uctoplus.sk, a.s.
 * @package Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents
 *
 * @method AccountIDType getAccountID()
 * @method self setAccountID(AccountIDType|string $value)
 */
class CreditAccountType extends AggregateComponent
{
    protected $casts = [
        "cbc:AccountID" => AccountIDType::class,
    ];

    protected $minOccurs = [
        "cbc:AccountID" => 1,
    ];
}