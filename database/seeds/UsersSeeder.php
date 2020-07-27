<?php

use Illuminate\Database\Seeder;
use App\Models\User;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin MeZamÜ',
            'email' => 'mezamucorporativo@gmail.com',
            'password' => bcrypt('admin_mezamu'),
            'role' => 'administrador',
            'branch_id' => random_int(\DB::table('branches')->min('id'), \DB::table('branches')->max('id'))
        ]);
    }
}
