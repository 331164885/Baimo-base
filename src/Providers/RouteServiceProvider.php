<?php

namespace Baimo\Base\Providers;

use Baimo\Base\Http\Controllers\AuthController;
use Baimo\Base\Http\Controllers\UsersController;
use Baimo\Base\Http\Controllers\RolesController;
use Baimo\Base\Http\Controllers\PermissionsController;
use Baimo\Base\Http\Controllers\LogController;
use Baimo\Base\Http\Controllers\SystemController;
use Baimo\Base\Http\Controllers\CaptchaController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        /**
         * Core admin routes
         **/
        Route::prefix('api')->group(function (Router $router) {
            Route::post('captcha',[CaptchaController::class, 'captcha']);      //获取验证码
            //Route::get('captcha',[CaptchaController::class, 'captcha']);      //获取验证码

            Route::middleware([])->prefix('auth')->group(function (Router $router) {
                $router->post('login', [AuthController::class, 'login']);   // 登录
                $router->post('logout', [AuthController::class, 'logout']);  // 注销
                $router->post('refresh', [AuthController::class, 'refresh']); // 刷新用户状态
                $router->put('update', [AuthController::class, 'update']);   // 更新用户信息
                $router->post('me', [AuthController::class, 'me'])->name('me')->middleware(['jwt.auth']);
            });

            Route::middleware(['jwt.auth', 'baimo.base-log'])->group(function (Router $router) {
                Route::middleware(['baimo.base-permission'])->prefix('admin')->group(function (Router $router) {
                    $router->get('/users', [UsersController::class, 'index']);       // 用户列表
                    $router->post('/users', [UsersController::class, 'store']);      // 添加新用户;
                    $router->put('users/{id}', [UsersController::class, 'update']);  // 更新用户信息

                    // $router->resource('roles', RolesController::class);
                    $router->get('/roles',[RolesController::class, 'index']);            // 角色列表
                    $router->post('/roles',[RolesController::class, 'store']);           // 添加角色
                    $router->put('/roles/{id}',[RolesController::class, 'update']);      // 更新角色
                    $router->delete('/roles/{id}',[RolesController::class, 'destroy']);  // 删除角色

                    $router->get('/permissions',[PermissionsController::class, 'index']);            // 权限列表
                    $router->post('/permissions', [PermissionsController::class, 'store']);          // 添加权限
                    $router->put('/permissions/{id}',[PermissionsController::class, 'update']);      // 更新权限
                    $router->delete('/permissions/{id}',[PermissionsController::class, 'destroy']);  // 删除权限

                    $router->get('/log',[LogController::class, 'index']);                   //获取日志列表
                    $router->delete('/log/{id}',[LogController::class, 'destroy']);         //删除日志
                    $router->get('/system',[SystemController::class, 'info']);              //系统信息
                    $router->get('/terminal',[SystemController::class, 'terminal']);        //系统终端认证 注意防止漏洞
                });

                $router->get('/admin/all_permissions',[PermissionsController::class, 'allPermissions']); //获取所有权限
                $router->get('/admin/all_role',[RolesController::class, 'allRule']);                     //获取所有角色
                $router->post('upload_img',[UsersController::class, 'updateImg']);                       //头像更新
                $router->post('sshCertification',[UsersController::class, 'sshCertification']);          //头像更新

                /*Route::middleware(['permission'])->prefix('server')->group(function (Router $router) {
                    $router->get('/tasks',[TaskController::class,'index']);            //任务列表
                    $router->post('/tasks',[TaskController::class,'store']);           //添加新任务;
                    $router->put('/tasks/{id}',[TaskController::class,'update']);      //更新任务;
                    $router->delete('/tasks/{id}',[TaskController::class,'destroy']);  //删除任务;
                });*/
            });

            /**
             * Core api routes
             **/
            /*Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {

            });*/
        });

    }
}