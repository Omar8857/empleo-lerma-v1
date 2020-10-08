<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //        
        $user = new User();
        $user->nombre = 'sistemas';
        $user->email = 'sistemas@lerma.gob.mx';
        $user->telefono = '7227826016';
        $user->tipo_user = 'admin';
        $user->password = bcrypt('secret');
        $user->save();
    }
}
