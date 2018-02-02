<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Model\Role;
use App\Model\User;

class AddUserRoleSeeder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $role_employee = new Role();
        $role_employee->name = 'user';
        $role_employee->description = 'A Employee User';
        $role_employee->save();
        $role_manager = new Role();
        $role_manager->name = 'admin';
        $role_manager->description = 'A Manager User';
        $role_manager->save();
        $role_manager = new Role();
        $role_manager->name = 'super_admin';
        $role_manager->description = 'A Manager User';
        $role_manager->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
