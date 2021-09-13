<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();

            $table->unique('slug');
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();

            $table->unique('slug');
        });

        Schema::table('role_permission', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');

            $table->unique(['role_id', 'permission_id'], 'rp');
        });

        Schema::table('user_role', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('role_id');

            $table->unique('user_id');
        });
    }

    public function down()
    {
        Schema::drop('roles');
        Schema::drop('permissions');
        Schema::drop('role_permission');
        Schema::drop('user_role');
    }
}