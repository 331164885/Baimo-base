<?php

namespace Baimo\Base\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;
use Lauthz\Facades\Enforcer;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    public $table = 'baimo_admins';

    protected $datas = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','avatar', 'email', 'password','created_at','ding_id','oauth_id','oauth_type'
    ];

    public $appends = [
        'roles',
        'introduction'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return ['role' => 'admin'];
    }

    /**
     * @param $key
     * @return string
     */
    public function getAvatarAttribute($key)
    {
        if(empty($key)) $key= env('APP_URL').'/storage/default-avatar.jpg';
        return $key;
    }

    /**
     * 赋予用户角色
     * @param $key
     * @return string
     */
    public function getRolesAttribute($key)
    {
        $roles = Enforcer::getRolesForUser($this->id);
        if(!empty($roles)) return explode(',',$roles);

        if(empty($key) && $this->name =='admin' || $this->name='test1') {
            //$key = 'admin';
            $key = ['admin'];
        }
        if(empty($key)) {
            //$key='users';
            $key=['users'];
        }
        return $key;
    }

    public function getIntroductionAttribute($key){
        return $key;
    }

    public function getUseridByUnionid()
    {

    }
}
