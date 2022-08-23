<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
// use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create
            (
                [
                    'firstName'=>'Admin',
                    'lastName'=>'kimhak',
                    'email'=>'kimhak6747@gmail.com',
                    'email_verified_at'=>now(),
                    'password'=>bcrypt('Adminpassword'),
                    'role'=>'1',
                    'bitch'=>'2022',
                    'gender'=>'M',
                    'phone'=>'098765432',
                    'personal_id'=>'22',
                ]

            );
    }
}
