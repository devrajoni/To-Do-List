<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\RoleTypeEnum;
use App\Models\Permission;
use App\Models\User;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            'manage_task' => [
                'view'   => 'tasks.index',
                'create' => 'tasks.create',
                'edit'   => 'tasks.edit',
                'delete' => 'tasks.destroy',
            ],
            
        ];
    
        $role = \DB::table('roles')->where('name', RoleTypeEnum::Admin->value)->first();
    
        foreach ($attributes as $key => $attribute) {
            $permission             = new Permission();
            $permission->name       = str_replace('_', ' ', $key);
            $permission->attribute  = $key;
            $permission->keywords   = json_encode($attribute);
            $permission->save();
    
            $admin_permission       = [];
    
            foreach ($attribute as $index => $permit) {
                $admin_permission[] = trim($permit);
            }
    
            $user = User::where('role_id', $role->id)->first();
            if ($user) {
                $user->permissions = json_encode($admin_permission);
                $user->save();
            }
        }
    }
}
