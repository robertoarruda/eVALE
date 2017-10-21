<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Admin',
            'login' => 'admin',
            'password' => bcrypt('123456'),
        ];

        $exists = DB::table('users')
            ->where($user)
            ->first();

        if (!empty($exists)) {
            return false;
        }

        DB::table('users')->insert($user);
    }
}
