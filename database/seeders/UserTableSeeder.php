<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@mail.com')->first();

        if(!$user) {
            User::create([
                'name' => 'Mohammed Salah Saad',
                'email' => 'admin@mail.com',
                'role' => 'admin',
                'password' => Hash::make('12345678')
            ]);
        }
    }
}
