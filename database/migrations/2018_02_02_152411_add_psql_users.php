<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Model\Role;
use App\Model\User;

class AddPsqlUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        $user_super_admin_role = Role::where('name','super_admin')->first();

        $user_super_admin = User::create([
            'name' => 'Coco Martin',
            'email' => 'super_admin@email.com',
            'password' => bcrypt('php123'),
            'remember_token' => str_random(10),
        ]);
        User::find($user_super_admin)->_roles()->attach($user_super_admin_role);





//        $user_role = Role::where('name','user')->first();
//        $user_admin_role = Role::where('name','admin')->first();
//
//        $user_user = new User;
//        $user_user->name = 'Coco Martin';
//        $user_user->email = 'user@email.com';
//        $user_user->password = bcrypt('php123');
//        $user_user->remember_token = str_random(10);
//        $user_user->save();
//
//
//        $user_admin = new User;
//        $user_user->name = 'Coco Martin';
//        $user_user->email = 'user@email.com';
//        $user_user->password = bcrypt('php123');
//        $user_user->remember_token = str_random(10);
//        $user_user->save();
//
//        $user_admin = User::create([
//            'name' => 'Dingdong Dantes',
//            'email' => 'admin@email.com',
//            'password' => bcrypt('php123'),
//            'remember_token' => str_random(10),
//        ]);
//
//
//        User::find($user_user)->_roles()->attach($user_role);
//        User::find($user_admin)->_roles()->attach($user_admin_role);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
