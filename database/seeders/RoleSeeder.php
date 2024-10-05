<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\RoleTypeEnum;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => RoleTypeEnum::Employee->value],
            ['name' => RoleTypeEnum::Admin->value],
        ];

        \DB::table('roles')->insert($roles);
    }
}
