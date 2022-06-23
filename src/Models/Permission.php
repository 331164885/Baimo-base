<?php

namespace Baimo\Base\Models;

use Baimo\Core\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends BaseModel
{
    use SoftDeletes;

    protected $table = 'baimo_admin_permissions';

    protected $datas = ['deleted_at'];

    public function getIsMenuAttribute($key)
    {
        if($key == 1){
            return true;
        }else{
            return  false;
        }
    }

    public function getPid(){
        return $this->hasOne(Permission::class,'id','p_id')->select(['id','p_id','path','name','title','icon','method','url']);
    }

}
