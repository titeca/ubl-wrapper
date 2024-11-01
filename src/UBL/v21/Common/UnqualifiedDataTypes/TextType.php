<?php

namespace Uctoplus\UblWrapper\UBL\v21\Common\UnqualifiedDataTypes;

use Uctoplus\UblWrapper\UBL\Schema\BasicComponent;

/**
 * Class TextType
 *
 * @author Mário <mario@uctoplus.sk>
 * @copyright uctoplus.sk, a.s.
 * @package Uctoplus\UblWrapper\UBL\v21\Common\UnqualifiedDataTypes
 *
 * @method mixed getLanguageIDAttribute()
 * @method self setLanguageIDAttribute($string)
 * @method mixed getLanguageLocaleIDAttribute()
 * @method self setLanguageLocaleIDAttribute($string)
 */
class TextType extends BasicComponent
{
    protected $type = "udt:TextType";

    protected $attributeCasts = [
        'languageID' => false,
        'languageLocaleID' => false,
    ];
}