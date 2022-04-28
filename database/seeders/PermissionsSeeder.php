<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Admin' => [
                'accounting show admins',

                'accounting show users',
                'accounting create users',
                'accounting edit users',
                'accounting delete users',

                'accounting show roles',
                'accounting create roles',
                'accounting edit roles',
                'accounting delete roles',

                'accounting show account guides',
                'accounting create account guides',
                'accounting edit account guides',
                'accounting delete account guides',

                'accounting show arrest receipts',
                'accounting create arrest receipts',
                'accounting edit arrest receipts',
                'accounting delete arrest receipts',

                'accounting show index accounts',
                'accounting create index accounts',
                'accounting edit index accounts',
                'accounting delete index accounts',

                'accounting show invoices',
                'accounting create invoices',
                'accounting edit invoices',
                'accounting delete invoices',

                'accounting show invoice discounts',
                'accounting create invoice discounts',
                'accounting edit invoice discounts',
                'accounting delete invoice discounts',

                'accounting show invoice items',
                'accounting create invoice items',
                'accounting edit invoice items',
                'accounting delete invoice items',

                'accounting show items',
                'accounting create items',
                'accounting edit items',
                'accounting delete items',

                'accounting show payroll',
                'accounting create payroll',
                'accounting edit payroll',
                'accounting delete payroll',

                'accounting show settings',
                'accounting create settings',
                'accounting edit settings',
                'accounting delete settings',

                'accounting show categories',
                'accounting create categories',
                'accounting edit categories',
                'accounting delete categories',

                'accounting show units',
                'accounting create units',
                'accounting edit units',
                'accounting delete units',

                'accounting telescope',
            ],

            'Supplier' => [
                'accounting show suppliers',
            ],

            'Customer' => [
                'accounting show customers',
            ],

            'Employee' => [
                'accounting show employees',
            ],

            'Servant' => [
                'accounting show servants',
            ]
        ];

        Schema::disableForeignKeyConstraints();
        DB::table('model_has_permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($roles as $role => $permissions) {
            $Role = Role::findOrCreate($role);
            foreach ($permissions as $permission) {
                $permissionExist = Permission::where('name', $permission)->first();
                if (!$permissionExist) {
                    Permission::insert(['name' => $permission, 'guard_name' => 'web']);
                }
            }
            $Role->syncPermissions(Permission::whereIn('name', $permissions)->get());
        }


        $user = User::updateOrCreate([
            'email' => 'admin@email.com',
        ], [
            'name' => 'Admin',
            'mobile' => '96655000000',
            'password' => Hash::make("12345678"),
        ]);

        $user->assignRole('Admin');

        $userC = User::updateOrCreate([
            'email' => 'customer@email.com',
        ], [
            'name' => 'cust',
            'mobile' => '1111111111',
            'password' => Hash::make("12345678"),
        ]);
        $userC1 = User::updateOrCreate([
            'email' => 'customer1@email.com',
        ], [
            'name' => 'cust1',
            'mobile' => '2222222222',
            'password' => Hash::make("12345678"),
        ]);
        $userC->assignRole('Customer');
        $userC1->assignRole('Customer');

        $userE = User::updateOrCreate([
            'email' => 'emoployee@email.com',
        ], [
            'name' => 'emp',
            'mobile' => '3333333333',
            'password' => Hash::make("12345678"),
        ]);
        $userE1 = User::updateOrCreate([
            'email' => 'emoployee1@email.com',
        ], [
            'name' => 'emp1',
            'mobile' => '4444444444',
            'password' => Hash::make("12345678"),
        ]);
        $userE->assignRole('Employee');
        $userE1->assignRole('Employee');

        $userSup = User::updateOrCreate([
            'email' => 'supplier@email.com',
        ], [
            'name' => 'sup',
            'mobile' => '5555555555',
            'password' => Hash::make("12345678"),
        ]);
        $userSup1 = User::updateOrCreate([
            'email' => 'supplier1@email.com',
        ], [
            'name' => 'sup1',
            'mobile' => '6666666666',
            'password' => Hash::make("12345678"),
        ]);
        $userSup->assignRole('Supplier');
        $userSup1->assignRole('Supplier');

        $userServ = User::updateOrCreate([
            'email' => 'servant@email.com',
        ], [
            'name' => 'serv',
            'mobile' => '7777777772',
            'password' => Hash::make("12345678"),
        ]);
        $userServ1 = User::updateOrCreate([
            'email' => 'servant1@email.com',
        ], [
            'name' => 'serv1',
            'mobile' => '88888888',
            'password' => Hash::make("12345678"),
        ]);
        $userServ->assignRole('Servant');
        $userServ1->assignRole('Servant');
    }
}
