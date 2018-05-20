<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Admins_TableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
    }
}
