<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::create([
         'name' => 'Admin',
        ]);

        Role::create([
            'name' => 'Moderator',
           ]);

        Role::create([
            'name' => 'Webmaster',
           ]);

        Role::create([
            'name' => 'Buyer',
           ]);
    }
}
