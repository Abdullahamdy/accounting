<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AccountGuidesSeeder::class);
        $this->call(PermissionsSeeder::class);

        $user = User::updateOrCreate([
            'email' => 'test@alkmal.com',
        ], [
            'name' => 'test-kmal',
            'mobile' => '76509765343',
            'password' => Hash::make("123456"),
        ]);

        $user->assignRole('Admin');
    }
}
