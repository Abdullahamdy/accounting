<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountGuidesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_guides')->insert([
            [
                'title' => 'ميزانية عمومية'
            ],[
                'title' => 'أرباح وخسارة'
            ],[
                'title' => 'متاجرة'
            ]
        ]);
    }
}
