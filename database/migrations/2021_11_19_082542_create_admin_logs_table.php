<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('baimo_admin_logs', function (Blueprint $table) {
            $table->id();
            $table->string('url', 255)->comment("");
            $table->string('method', 10)->comment("");
            $table->string('ip', 20)->comment("");
            $table->integer('u_id')->comment("");
            $table->string('name', 30)->comment("");
            $table->string('address', 255)->comment("");
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
        Schema::dropIfExists('baimo_admin_logs');
    }
}
