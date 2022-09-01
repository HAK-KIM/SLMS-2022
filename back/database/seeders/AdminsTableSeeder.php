<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'firstName'=>'Admin',
                'lastName'=>'kimhak',
                'email'=>'hak.kim@passerellesnumeriques.org',
                'password'=>bcrypt('123456789'),
            ],
            [
                'firstName'=>'Admin',
                'lastName'=>'kimhak',
                'email'=>'kimhak6747@gmail.com',
                'password'=>bcrypt('123456789'),

            ]
            ];
            foreach($admins as $key => $value){
                Admin::create($value);
            }
    }
}