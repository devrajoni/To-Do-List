<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\RoleTypeEnum;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role                           = \DB::table('roles')->where('name', RoleTypeEnum::Admin->value)->first();
        $user                           = new User();
        $user->name                     = "Admin";
        $user->email                    = "admin@gmail.com";
        $user->password                 = Hash::make("123456");
        $user->role_id                  = $role->id;
        $user->save();

    }
}
