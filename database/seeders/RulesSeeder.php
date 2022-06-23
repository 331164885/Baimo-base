<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RulesSeeder extends Seeder
{
    public function run()
    {
        DB::table('baimo_rules')->truncate();

        $baimo_rules = [
            ['id' => 64,'p_type' => 'p','v0' => 'permission_1','v1' => '/permission','v2' => '*','v3' => '2','v4' => NULL,'v5' => NULL,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => NULL],
            ['id' => 65,'p_type' => 'p','v0' => 'permission_1','v1' => '/role','v2' => '*','v3' => '3','v4' => NULL,'v5' => NULL,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => NULL],
            ['id' => 66,'p_type' => 'p','v0' => 'permission_1','v1' => '/user','v2' => '*','v3' => '4','v4' => NULL,'v5' => NULL,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => NULL],
            ['id' => 68,'p_type' => 'p','v0' => 'permission_1','v1' => '/system','v2' => '*','v3' => '15','v4' => NULL,'v5' => NULL,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => NULL],
            ['id' => 88,'p_type' => 'g','v0' => 'roles_1','v1' => '1','v2' => 'administrator','v3' => NULL,'v4' => NULL,'v5' => NULL,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => NULL],
            ['id' => 91,'p_type' => 'g','v0' => 'roles_2','v1' => '2','v2' => 'admin','v3' => NULL,'v4' => NULL,'v5' => NULL,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => NULL]
        ];

        DB::table('baimo_rules')->insert($baimo_rules);
    }
}
