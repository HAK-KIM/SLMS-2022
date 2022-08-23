<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        // User::factory(5)->create();
        User::create(
            
                ['name'=>'Admin','email'=>'kimhak6747@gmail.com','role'=>'1','email_verified_at'=>now(),'password'=>bcrypt('hakpassword')]
            
            
        );
        Admin::factory(5)->create();

        // $this->call(class:RoleSeeder::class);
        // $this->call(class:AdminUserSeeder::class);

    }
}
