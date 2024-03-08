<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    //public function run(): void
    //{
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        private $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ];
    
    
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            foreach ($this->permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
    
            // Create admin User and assign the role to him.
            $user = User::create([
                'name' => 'Prevail Ejimadu',
                'email' => 'test@example.com',
                'password' => Hash::make('password')
            ]);
    
            $role = Role::create(['name' => 'Admin']);
    
            $permissions = Permission::pluck('id', 'id')->all();
    
            $role->syncPermissions($permissions);
    
            $user->assignRole([$role->id]);
        }
    }
//}

