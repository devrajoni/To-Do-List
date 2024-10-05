<?php
use App\Enums\RoleTypeEnum;

if (!function_exists('hasPermission')) {
    function hasPermission($key_word)
    {
        $user = auth()->user();
        $userPermissions = json_decode($user->permissions ?? '[]', true);

        $isAdmin = $user->role ? $user->role->name === RoleTypeEnum::Admin->value : false;

        if (in_array($key_word, $userPermissions) || $isAdmin) {
            return true;
        }
        return false;
    }
}

