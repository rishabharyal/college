<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create([
        	'email' => 'superadmin@cr.com',
        	'name' => 'Super Admin',
        	'role' => 2 // 2 means super admin
        ]);
    }
}