<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('baimo_admin_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->comment("权限名");
            $table->string('title', 255)->comment("前端路由名称");
            $table->string('icon', 60)->nullable()->default('link')->comment("权限图标");
            $table->string('path', 60)->nullable()->comment("路径");
            $table->string('url', 60)->nullable()->comment("前端url");
            $table->integer('status')->comment("状态1正常；2禁用");
            $table->string('method', 255)->default('GET')->comment("方法名称");
            $table->integer('p_id')->default(0)->comment("父节点");
            $table->integer('hidden')->default(2)->comment("是否隐藏 1:是 2否");
            $table->integer('is_menu')->default(2)->comment("是否为菜单 0是 1否");
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
        Schema::dropIfExists('baimo_admin_permissions');
    }
}
