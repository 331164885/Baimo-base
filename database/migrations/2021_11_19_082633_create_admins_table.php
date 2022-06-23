<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('baimo_admins', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->comment("用户名");
            $table->string('phone', 15)->comment("手机号");
            $table->string('email', 255)->unique()->comment("用户邮箱");
            $table->string('email_verified_at');
            $table->string('avatar')->comment("用户头像");
            $table->string('password')->comment("密码");
            $table->rememberToken();
            $table->integer('superuser')->default(0)->comment("是否是超级管理员 0:不是, 1:是");
            $table->integer('activated')->default(1)->comment("帐号是否活跃 0:不是, 1:是");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baimo_admins');
    }
}
