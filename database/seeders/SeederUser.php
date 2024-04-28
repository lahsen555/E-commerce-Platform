<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class SeederUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
               'name'=>'Lahcen',
               'email'=>'admin@lahcen.com',
               'role'=>'admin',
               'city' => 'Oujda',
               'sell' => 'no',
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'User',
               'email'=>'user@lahcen.com',
               'role'=>'normal',
               'city' => 'Tanger',
               'sell' => 'no',
               'password'=> bcrypt('12345678'),
            ],
        ];

    
        foreach ($users as $key => $user) {
            User::create($user);
        }

    
    }
}

// that also is nice now we have to filter the products based  on that thngs well let us try 