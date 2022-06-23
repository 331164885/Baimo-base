<?php

namespace Baimo\Base\Http\Controllers;

use Baimo\Base\Http\Requests\UserStoreRequest;
use Baimo\Base\Http\Requests\UserUpdateRequest;
use Baimo\Base\Models\Admin;
use Baimo\Base\Service\RoleService;
use Baimo\Core\Http\Controllers\BaseApiController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * 获取用户列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request,RoleService $service)
    {
        $page = $request->get('page', 1);
        $pageSize = $request->get('limit', 10);
        $email = $request->get('email');
        $name = $request->get('name');

        $query = Admin::query();
        if($email) {
            $query->where('email',$email);
        }

        if ($name) {
            $query->where('name', 'like', "%$name%");
        }

        $total = $query->count();

        $list = $query->forPage($page, $pageSize)->get();

        foreach ($list as  &$value){
            $value->roles_node = $service->getRoles($value->id);
        }

        return $this->success([
            'list' => $list,
            'mate'=>[
                'total' => $total,
                'pageSize'=>$pageSize
            ]
        ]);
    }

    /**
     * 新增用户
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(UserStoreRequest $request,RoleService $service)
    {
        $email  = $request->post('email');
        $name   = $request->post('name');
        $roles  = $request->post('roles');
        $password = bcrypt($request->post('password'));

        $created_at = now()->toDateTimeString();
        $id = Admin::query()->insertGetId(compact('email','name','password','created_at'));

        abort_if(!$id,500,'添加用户错误');

        $service->setRoles($roles,$id);

        return $this->success();


    }

    /**
     * 更新用户信息
     * @param $id
     * @param UserUpdateRequest $request
     * @param RoleService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id,UserUpdateRequest $request,RoleService $service)
    {
        $email     = $request->post('email');
        $name      = $request->post('name');
        $roles     = $request->post('roles');
        $password  = $request->post('password');

        $user = Admin::query()->where(compact('id'))->first();

        $user->email = $email;
        $user->name = $name;
        !empty($password) && $user->password = Hash::make($password);;
        $user->save();
        if(!empty($roles)) {
            $roles = array_column($roles,'id');
            $service->setRoles($roles,$id);
        }
        return $this->success([],'更新成功');

    }

    public function updateImg(Request $request)
    {

        $request->validate([
            'file' => ['required','image']
        ]);

        $path = $request->file('file')->store('public');

        return $this->success([
            'url'=>env('APP_URL').'/storage/'.explode('/',$path)[1]
        ]);
    }
}
