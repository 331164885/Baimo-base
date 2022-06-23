<?php

namespace Baimo\Base\Service;

use Baimo\Base\Models\Log;
use Lauthz\Facades\Enforcer;
use Baimo\Base\Models\AdminRole;

class RoleService
{
    protected function getIdentifier($id)
    {
        return "roles_".$id;
    }

    /**
     * 设置用户角色
     * @param $roleId
     * @param $id
     */
    public function setRoles($roleId,$id)
    {
        $id = $this->getIdentifier($id);
        $roles = AdminRole::query()->where('status',1)
            ->whereIn('id',$roleId)
            ->get(['id','name']);

        Enforcer::deleteRolesForUser($id);

        foreach ($roles as $value){
            Enforcer::addRoleForUser($id, $value['id'], $value['name']);
        }

    }

    /**
     * 获取用户角色
     * @param $id
     * @return mixed
     */
    public function getRoles($id){
        $id = $this->getIdentifier($id);
        $roles = Enforcer::getRolesForUser($id);

        if(empty($roles)) return [];

        $roles = AdminRole::query()->where('status',1)
            ->whereIn('id',$roles)
            ->get(['id','name']);

        return $roles;
    }

    /**
     * 删除用户所有角色
     * @param $id
     */
    public function delRoles($id,$roleId=[]){
        $id = $this->getIdentifier($id);
        Enforcer::deleteRolesForUser($id);
    }

}
