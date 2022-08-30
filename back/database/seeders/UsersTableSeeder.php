<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            // [
            //     'firstName'=>'Veang',
            //     'lastName'=>'Kroh',
            //     'email'=>'veang.kroh@student.passerellesnumeriques.org',
            //     'email_verified_at'=>now(),
            //     'password'=>bcrypt('123456789'),
            //     'batch'=>'2022',
            //     'gender'=>'M',
            //     'phone'=>'098765432',
            //     'personal_id'=>'22',
            //     'class'=>'WEB-2022A',
            //     'image'=> null,
            // ],
            [
                'firstName'=>'Vibol',
                'lastName'=>'Khan',
                'email'=>'v.k@student.passerellesnumeriques.org',
                'email_verified_at'=>now(),
                'password'=>bcrypt('1234'),
                'batch'=>'2022',
                'gender'=>'M',
                'phone'=>'098765432',
                'personal_id'=>'32',
                'class'=>'WEB-2022A',
                'image'=> null,
            ]
            ];
            foreach($users as $key => $value){
                User::create($value);
            }
    }
}
