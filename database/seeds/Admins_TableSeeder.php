<?php

use Illuminate\Database\Seeder;

class Admins_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->delete();
        DB::table('admins')->insert([
            'name' => str_random(10),
            'email' =>'admin@admin.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
