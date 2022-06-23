<?php

namespace Baimo\Base\Http\Controllers;

use Baimo\Core\Http\Controllers\BaseApiController as Controller;
use Baimo\Base\Http\Requests\PermissionStoreRequest;
use Baimo\Base\Models\Rule;
use Baimo\Base\Models\Permission;
use Baimo\Base\Service\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PermissionsController extends Controller
{
    /**
     * 获取权限列表
     * @param Request $request
     * @param PermissionService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request,PermissionService $service)
    {
        $keyword = $request->get('keyword');
        $allPermission = $service->getAllPermission($keyword);
        $list = $service->permissionTreeNode($allPermission);

        return $this->success([
            'list'=>$list
        ]);

    }

    /**
     * 获取所有权限节点
     * @param Request $request
     * @param PermissionService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function allPermissions(Request $request,PermissionService $service)
    {
        $keyword = $request->get('keyword');
        $allPermission = $service->getAllPermission($keyword);
        $list = $service->permissionTreeNode($allPermission);

        return response()->json([
            'code'=>200,
            'message'=>'success',
            'data'=>[
                'list'=>$list
            ]
        ]);
    }

    /**
     * 添加权限
     * @param PermissionStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PermissionStoreRequest $request)
    {
        $hidden = $request->post('hidden',1);
        $icon   = $request->post('icon');
        $method = $request->post('method','*');
        $name   = $request->post('name');
        $p_id   = $request->post('p_id');
        $path   = $request->post('path');
        $is_menu = $request->post('is_menu');
        $url     = $request->post('url');
        $title = $request->post('name');
        $status = 1;

        if($path && Permission::query()->where(compact('path','method','p_id','is_menu'))->exists()) {
            return $this->fail('权限不存在');
        }

        Permission::query()->insert(compact('hidden','icon','method','name','path','p_id','is_menu','method','url','title', 'status'));

        return $this->success();
    }

    /**
     * 更新权限
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id,Request $request)
    {
        $hidden = $request->post('hidden',1);
        $icon   = $request->post('icon');
        $method = $request->post('method','*');
        $name = $request->post('name');
        $p_id = $request->post('p_id');
        $path = $request->post('path');
        $is_menu = $request->post('is_menu');
        $title = $request->post('name');
        $url = $request->post('url');
        $status = 1;

        if($path && Permission::query()->where(compact('id'))->doesntExist()) {
            return $this->fail('权限不存在');
        }
        //更新权限
        Rule::query()->where('ptype','p')
            ->where('v1',$url)
            ->update([
                'v2'=>$method
            ]);

        Permission::query()->where('id',$id)->update(compact('hidden','icon','method','name','path','p_id','is_menu','method','title','url', 'status'));

        return $this->success();
    }



    /**
     * 删除权限
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Permission::destroy($id);
        return $this->success();
    }
}
