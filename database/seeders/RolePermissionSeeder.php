<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage categories',
            'manage tools',
            'manage projects',
            'manage projects tools',
            'manage wallets',
            'manage applicants',

            // other singular action freelance

            'apply job',
            'topup wallet',
            'withdraw wallet'

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        $clientRole = Role::firstOrCreate([
            'name' => 'project_client'
        ]);

        $clientPermissions = [
            
            'manage projects',
            'manage projects tools',
            'manage wallets',
            'manage applicants',

            // other singular action freelance

            'topup wallet',
            'withdraw wallet'
        ];

        $clientRole->syncPermissions($clientPermissions);

        $freelancerRole = Role::firstOrCreate([
            'name' => 'project_freelancer'
        ]);

        $freelancerPermissions = [

            'apply job',
            'withdraw wallet',

        ];

        $freelancerRole->syncPermissions($freelancerPermissions);


        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
        ]);

        $user = User::create([
            'name' => 'Freelancer Rivaldi',
            'email' => 'superadmin@rivaldi.com',
            'occupation' => 'Owner',
            'connect' => 8888,
            'avatar' => 'images/default-avatar.png',
            'password' => bcrypt('123456'),
        ]);

        $user->assignRole($superAdminRole);

        $wallet = new Wallet([
            'balance' => 0,
        ]);

        $user->wallet()->save($wallet);
    }
}
