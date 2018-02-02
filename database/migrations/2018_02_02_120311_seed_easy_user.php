<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Model\Role;
use App\Model\User;

class SeedEasyUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user_role = Role::where('name','user')->first();
        $user_admin = Role::where('name','admin')->first();
        $user_super_admin = Role::where('name','super_admin')->first();

        $easy_user = factory(User::class)->states('easy_user')->create();
        $easy_admin = factory(User::class)->states('easy_admin')->create();
        $easy_super_admin = factory(User::class)->states('easy_super_admin')->create();

        $easy_user->_roles()->attach($easy_user);
        $easy_admin->_roles()->attach($user_admin);
        $easy_super_admin->_roles()->attach($easy_super_admin);
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
