<?php

use App\Models\User;
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
        $users=[
            ['surname'=>'admin',
                'name' => 'admin',
                'patronymic' => 'admin',
                'email'=>'gurax45@gmail.com',
                'password'=>\Illuminate\Support\Facades\Hash::make('qwerty777'),
                'number'=>'3805642352',
                'address'=>'admin',
                'sex'=>'Мужчина',
                'role'=>'Адмін'
            ]
        ];

        User::insert($users);
    }
}
