<?php

namespace App\Enums;

enum UserRole: string
{
    // Laravel 12 Multi Auth Starter Kit: https://www.youtube.com/watch?v=jS86bTjx-K
    case User = 'user';
    case Admin = 'admin';
}
