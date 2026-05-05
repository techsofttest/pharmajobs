<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}
