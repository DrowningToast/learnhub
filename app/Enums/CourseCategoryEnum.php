<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum CourseCategoryEnum: string
{
    use InteractWithEnum;

    case SCIENCE = '1';
    case MATH = '2';
    case THAI = '3';
    case SOCIAL = '4';
    case ENGLISH = '5';
    case IT = '6';
}