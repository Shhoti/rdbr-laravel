<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Status extends Enum
{
    const Initial = '0';
    const FirstContact = '1';
    const Interview = '2';
    const TechAssignment = '3';
    const Rejected = '4';
    const Hired = '5';
}
