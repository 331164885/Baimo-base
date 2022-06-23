<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminsSeeder extends Seeder
{
    public function run()
    {
        DB::table('baimo_admins')->truncate();

        $baimo_admins = [
            ['id' => 1, 'name'=>'Administrator', 'phone' => '', 'email' => 'admin@admin.com', 'avatar' => '', 'password' => '$2y$10$f1Kf7DY1A8WJ5BpuRMu6yuOs3kOu1EoIjkhotApZxWHE30nF1nlvi', 'remember_token' => '', 'superuser' => '1', 'activated' => '1'],
        ];

        DB::table('baimo_admins')->insert($baimo_admins);
    }
}
