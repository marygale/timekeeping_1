<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Model\Role;
use App\Model\User;

class SeedMoreUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        $user_role = Role::where('name','user')->first();
//        $users = factory(User::class,3)->create();
//        $users->each(function ($user) use ($user_role) {
//            $user->_roles()->attach($user_role);
//        });

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
