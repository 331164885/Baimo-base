<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminRolesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('baimo_admin_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment("角色名称");
            $table->string('description', 255)->comment("描述");
            $table->integer('status')->comment("状态 0正常 1 禁用");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('baimo_admin_roles');
    }
}
