<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('baimo_admin_roles')->truncate();

        $baimo_admin_roles = [
            ['id' => 1, 'name' => 'administrator', 'description' => '超级管理员', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), NULL],
        ];

        DB::table('baimo_admin_roles')->insert($baimo_admin_roles);
    }
}
