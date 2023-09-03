<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
               'name'=>'Admin User',
               'email'=>'admin@gmail.com',
               'mobile'=>'8895623652',
               'type'=>3,
               'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'Hospital',
                'email'=>'hospital@gmail.com',
                'mobile'=>'8895623651',
                'type'=>2,
                'password'=> bcrypt('123456'),
             ],
            [
               'name'=>'Doctor',
               'email'=>'manager@gmail.com',
               'mobile'=>'8895623686',
               'type'=> 1,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Patient',
               'email'=>'user@gmail.com',
               'mobile'=>'8895623645',
               'type'=>0,
               'password'=> bcrypt('123456'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
