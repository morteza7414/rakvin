<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        if (!User::count()) {
            $this->registerData();
        }
    }

    private function registerData()
    {
        User::query()->truncate();

        User::create([
            'name' => 'admin',
            'slut' => 'admin',
            'mobile' => '09123227832',
            'identifier_id' => 1,
            'role'=> 'admin',
            'username' => 'admin' ,
            'password' => bcrypt('33333333'),
        ]);

    }
}
