<?php

use Illuminate\Database\Seeder;

use App\User;

use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'anamolshres55@gmail.com')->first();
        
        if(!$user){
            User::create([
                'name' => 'Anamol Shrestha',
                'email' => 'anamolshres55@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('password')
            ]); 
        }
    }
}
