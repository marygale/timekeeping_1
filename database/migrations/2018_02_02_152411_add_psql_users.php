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

        $user_role = Role::where('name','user')->first();
        $user_admin_role = Role::where('name','admin')->first();
        $user_super_admin_role = Role::where('name','super_admin')->first();

        $user_user = User::create([
            'name' => 'Coco Martin',
            'email' => 'user@email.com',
            'password' => bcrypt('php123'),
            'remember_token' => str_random(10),
        ]);

        $user_admin = User::create([
            'name' => 'Dingdong Dantes',
            'email' => 'admin@email.com',
            'password' => bcrypt('php123'),
            'remember_token' => str_random(10),
        ]);

        $user_super_admin = User::create([
            'name' => 'Coco Martin',
            'email' => 'super_admin@email.com',
            'password' => bcrypt('php123'),
            'remember_token' => str_random(10),
        ]);

        User::find($user_user)->_roles()->attach($user_role);
        User::find($user_admin)->_roles()->attach($user_admin_role);
        User::find($user_super_admin)->_roles()->attach($user_super_admin_role);
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
