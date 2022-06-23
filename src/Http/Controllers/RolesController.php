<?php

namespace Baimo\Base\Http\Controllers;

use Baimo\Core\Http\Controllers\BaseApiController as Controller;
use Baimo\Base\Http\Requests\RoleStoreRequest;
use Baimo\Base\Models\Permission;
use Baimo\Base\Models\AdminRole;
use Baimo\Base\Service\PermissionService;
use Baimo\Base\Service\RoleService;
use Illuminate\Http\Request;
use Lauthz\Facades\Enforcer;

class RolesController extends Controller
{

    /**
     * 获取角色列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request,PermissionService $service)
    {
        $page     = $request->get('page',1);
        $pageSize = $request->get('pageSize',10);

        $query = AdminRole::query();

        if($keyword = \request('keyword')){
            $query = $query->where('name','like',"%$keyword%");
        }
        $total = $query->count();

        $list = $query->forPage($page,$pageSize)->get();

        foreach ($list as &$value){

            list($node_id,$nodes) = $service->getPermissions($value->id);

            $value->node = $node_id;
            $value->nodes = $nodes;
        }

        return $this->success([
            'list'=>$list,
            'total'=>$total
        ]);
    }

    /**
     * 添加角色
     * @param RoleStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleStoreRequest $request,PermissionService $service)
    {
        $name        = $request->get('name');
        $status      = $request->get('status');
        $description = $request->get('description');
        $node        = $request->get('node',[]);
        $created_at  =  now()->toDate();
        $updated_at  =  now()->toDate();

        if(AdminRole::query()->where(compact('name','status'))->exists()) {
            return $this->fail('角色已存在');
        }

        $id = AdminRole::query()->insertGetId(compact('name','status','description','created_at','updated_at'));

        abort_if(!$id,500,'添加角色错误');

        !empty($node) &&  $service->setPermissions($node,$id);

        return $this->success([],'角色添加成功');
    }

    public function update($id,Request $request,PermissionService $service)
    {
        $name        = $request->get('name');
        $status      = $request->get('status');
        $description = $request->get('description');
        $node        = $request->get('node',[]);

        $updated_at  =  now()->toDate();

        if(AdminRole::query()->where(compact('id'))->doesntExist()) {
            return $this->fail('角色不存在');
        }

        AdminRole::query()->where(compact('id'))->update(compact('name','description','updated_at','status'));

        if(!empty($node)) {
            $service->setPermissions($node,$id);
        }


        return $this->success([],'更新成功');

    }

    /**
     * 删除角色
     * @param $id
     * @param PermissionService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id,PermissionService $service)
    {
        AdminRole::destroy($id);
        $service->delPermissions($id);
        return $this->success();
    }

    /**
     * 获取所有的角色
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function allRule()
    {
        $list = AdminRole::query()->where('status',1)->get(['id','name']);

        return $this->success($list);
    }
}
