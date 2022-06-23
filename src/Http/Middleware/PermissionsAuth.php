<?php

namespace Baimo\Base\Http\Middleware;

use Baimo\Base\Models\Admin;
use Baimo\Base\Service\AuthService;
use Baimo\Base\Service\PermissionService;
use Baimo\Base\Service\RoleService;
use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class PermissionsAuth
{
    /**
     * 权限控制中间件
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth('admin')->user()->superuser) {
            return $next($request);
        }

        $id = auth('admin')->id();
        $authService = new AuthService();

        //Log::info($request->route()->uri());
        //Log::info($request->route()->uri());
        $bool = $authService->checkPermission($id,$request->method(),$request->route()->uri());

        if(!$bool) {
            $response = JsonResponse::fromJsonString(
                collect(['data' => [], 'code' => 403, 'message' => "没有访问权限"]
                )->toJson(),200);
            throw new HttpResponseException($response);
        }

        return $next($request);
    }
}
