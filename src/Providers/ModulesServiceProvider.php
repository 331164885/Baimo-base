<?php

namespace Baimo\Base\Providers;

use Baimo\Base\Commands\CreateAdmin;
use Baimo\Base\Commands\Database;
use Baimo\Base\Commands\Install;
use Baimo\Base\Commands\Publish;
use Baimo\Base\Http\Middleware\AdminLog;
use Baimo\Base\Http\Middleware\PermissionsAuth;
use Baimo\Base\Repositories\AdminRepository;
use Baimo\Base\Services\AdminService;
use Baimo\Core\Repositories\Interfaces\RepositoryInterface;
use Baimo\Core\Services\Interfaces\ServiceInterface;
use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider
{
    /**
     * The middleware aliases.
     *
     * @var array
     */
    protected $middlewareAliases = [
        'baimo.base-log' => AdminLog::class,
        'baimo.base-permission' => PermissionsAuth::class
    ];

    public function register()
    {
        $this->app->register(ServiceServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);

        $this->commands([
            CreateAdmin::class,
            Database::class,
            Install::class,
            Publish::class
        ]);
    }

    public function boot()
    {
        /*// 注册扩展包的视图
        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'core');

        // 发布视图
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/base')
        ], 'views');

        // 发布静态资源
        $this->publishes([
            __DIR__.'/../../resources/js' => resource_path('js'),
            __DIR__.'/../../resources/scss' => resource_path('scss')
        ], 'resources');
*/
        // 发布管理员默认头像资源
        $this->publishes([
            __DIR__.'/../../public/storage/' => storage_path('app/public')
        ], 'storage');

        // 发布基础数据库文件
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'migrations');

        // 发布基础数据库填充文件
        $this->publishes([
            __DIR__.'/../../database/seeders' => database_path('seeders'),
        ], 'seeders');

        // 命名中间件
        $this->aliasMiddleware();
    }

    /**
     * Alias the middleware.
     *
     * @return void
     */
    protected function aliasMiddleware()
    {
        $router = $this->app['router'];

        $method = method_exists($router, 'aliasMiddleware') ? 'aliasMiddleware' : 'middleware';

        foreach ($this->middlewareAliases as $alias => $middleware) {
            $router->$method($alias, $middleware);
        }
    }


}