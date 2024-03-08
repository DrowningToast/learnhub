<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum RoleEnum: string
{
    use InteractWithEnum;

    case Learner = 'LEARNER';
    case Lecturer = 'LECTURER';
    case Moderator = 'MODERATOR';
}