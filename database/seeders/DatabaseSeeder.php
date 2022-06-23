<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * 基础数据填充
     **/
    public function run()
    {
        Model::unguard();
        $this->call(AdminsSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(RulesSeeder::class);
        Model::reguard();
    }
}
