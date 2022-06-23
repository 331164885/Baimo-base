<?php

namespace Baimo\Base\Service;

use Baimo\Base\Models\Permission;
use Illuminate\Support\Facades\Log;
use Lauthz\Facades\Enforcer;

class AuthService
{
    public $permissionService;
    public $roleService;

    public function __construct()
    {
        $this->permissionService = new PermissionService();
        $this->roleService = new RoleService;
    }

    public function getRoles($id)
    {
      return  $this->roleService->getRoles($id);
    }

    public function checkPermission($id,$method,$route) :bool
    {
       $role =  $this->getRoles($id);

       //Log::info($role);
       if(empty($role)) return false;

       $role = $role->map(function ($val){
           return $val['id'];
       })->toArray();
       //Log::info($role);

       $node_array = [];
       foreach ($role as $value) {
          list($node,$permissions) = $this->permissionService->getPermissions($value);
           $node_array[] = $node;
       }
       $where['url'] = $route;
        /*Log::info($id);
        Log::info($method);
        Log::info($where);*/
       return
           Permission::query()->whereIn('id',$node_array[0])->where('is_menu',0)->where($where)
               ->where(function ($query) use($method){
                   $query->where('method',$method)->orWhere('method',"*");
               })
               ->exists();
    }
}
