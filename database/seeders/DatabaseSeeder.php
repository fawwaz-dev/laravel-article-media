<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\ArticleFactory;
use Database\Factories\UserFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissions = [
            'store-articles',
            'read-articles',
            'update-articles',
            'destroy-articles',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $user_role = Role::create(['name' => 'user']);
        $admin_role = Role::create(['name' => 'admin']);

        $user_role->syncPermissions(['read-articles']);
        $admin_role->syncPermissions($permissions);

        $admin = User::Create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]);

        $admin->syncRoles(['admin']);
        $user = UserFactory::new()->count(count: 10)->create();

        $user->each(function ($user) {
            $user->syncRoles(['user']);
        });
        ArticleFactory::new()->count(20)->create();
    }
}
