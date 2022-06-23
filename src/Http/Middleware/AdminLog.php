<?php

namespace Baimo\Base\Http\Middleware;

use Baimo\Base\Models\AdminLog as Log;
use Closure;
use Illuminate\Http\Request;

class AdminLog
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * 是否开启日志记录
         */
        if(env('OPERATION_LOG')==false) {
            return $next($request);
        }

        /**
         * 功能过滤
         */
        if(!in_array($request->route()->uri(),static::$url) && in_array($request->method(),static::$method)){

            Log::query()->create([
                'url'    => $request->route()->uri(),
                'method' => $request->method(),
                'ip'     => $request->getClientIp(),
                'u_id'   => auth('admin')->id(),
                'address'   =>'',
                'name'   => auth('admin')->user()->name
            ]);
        }
        return $next($request);
    }

    // 过滤路由
    protected static $url = [
        'api/admin/log',
        'api/admin/log/{id}'
    ];

    // 记录访问的方法
    protected static $method = ['DELETE','POST','PUT','PUTCH','GET'];
}
