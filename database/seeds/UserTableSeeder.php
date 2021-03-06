<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->username = 'test';
        $user->email = 'test@test.com';
        $user->password = bcrypt('test');
        $user->save();
    }
}
