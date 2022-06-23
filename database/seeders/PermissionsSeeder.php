<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('baimo_admin_permissions')->truncate();

        $baimo_admin_permissions = [
            ['id' => 1,'name' => '系统管理','title' => '系统管理','icon' => 'fa fa-steam-square','path' => '/admin','url' => '/admin','status' => 1,'method' => '*','p_id' =>0,'hidden' => 1,'is_menu' => 1,1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 2,'name' => '权限管理','title' => '权限管理','icon' => 'fa fa-pencil-square','path' => '/permission','url' => '/permission','status' => 1,'method' => '*','p_id' =>1,'hidden' => 1,'is_menu' => 1,1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 3,'name' => '角色管理','title' => '角色管理','icon' => 'fa fa-user-secret','path' => '/role','url' => '/role','status' => 1,'method' => '*','p_id' =>1,'hidden' => 1,'is_menu' => 1,1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 4,'name' => '用户管理','title' => '用户管理','icon' => 'fa fa-users','path' => '/user','url' => '/user','status' => 1,'method' => '*','p_id' =>1,'hidden' => 1,'is_menu' => 1,1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 5,'name' => '系统日志','title' => '系统日志','icon' => 'fa fa-location-arrow','path' => '/log','url' => '/log','status' => 1,'method' => '*','p_id' =>1,'hidden' => 1,'is_menu' => 1,1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 7,'name' => '日志列表','title' => '日志列表','icon' => '','path' => '','url' => 'api/admin/log','status' => 1,'method' => 'GET','p_id' =>6,'hidden' => 1,'is_menu' => 1,0,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 8,'name' => '用户列表','title' => '用户列表','icon' => '','path' => '','url' => 'api/admin/users','status' => 1,'method' => 'GET','p_id' =>6,'hidden' => 1,'is_menu' => 1,0,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 9,'name' => '日志删除','title' => '日志删除','icon' => '','path' => '','url' => 'api/admin/log/{id}','status' => 1,'method' => 'DELETE','p_id' =>6,'hidden' => 1,'is_menu' => 1,0,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 10,'name' => '添加用户','title' => '添加用户','icon' => '','path' => '','url' => 'api/admin/users','status' => 1,'method' => 'POST','p_id' =>6,'hidden' => 1,'is_menu' => 1,0,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 11,'name' => '更新用户','title' => '更新用户','icon' => '','path' => '','url' => 'api/admin/users/{id}','status' => 1,'method' => 'PUT','p_id' =>6,'hidden' => 1,'is_menu' => 1,0,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 12,'name' => '权限列表','title' => '权限列表','icon' => 'fa fa-user-secret','path' => '*','url' => '/api/admin/permissions','status' => 1,'method' => '*','p_id' =>6,'hidden' => 1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 13,'name' => '权限列表','title' => '权限列表','icon' => '','path' => '','url' => '/api/admin/permissions','status' => 1,'method' => 'GET','p_id' =>6,'hidden' => 1,'is_menu' => 1,0,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 14,'name' => '角色列表','title' => '角色列表','icon' => '','path' => '','url' => '/api/admin/roles','status' => 1,'method' => 'GET','p_id' =>6,'hidden' => 1,'is_menu' => 1,0,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 15,'name' => '系统信息','title' => '系统信息','icon' => 'fa fa-sun-o','path' => '/system','url' => '/system','status' => 1,'method' => '*','p_id' =>1,'hidden' => 1,'is_menu' => 1,1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
            ['id' => 6,'name' => '系统','title' => '系统','icon' => '','path' => '','url' => 'api/admin','status' => 1,'method' => '*','p_id' =>0,'hidden' => 1,'is_menu' => 1,0,'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),'deleted_at' => NULL],
        ];

        DB::table('baimo_admin_permissions')->insert($baimo_admin_permissions);
    }
}
