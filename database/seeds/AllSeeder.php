<?php

use App\User;
use Illuminate\Database\Seeder;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //data user admin
        $userAdmin = new User();
        $userAdmin->name = 'Admin';
        $userAdmin->email = 'im.admin@gmail.com';
        $userAdmin->email_verified_at = now();
        $userAdmin->remember_token = Str::random(10);
        $userAdmin->password = bcrypt('password');
        $userAdmin->save();

        factory('App\User', 5)->create();
    }
}
