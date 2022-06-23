<?php

namespace Baimo\Base\Models;

use Baimo\Core\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminLog extends BaseModel
{
    use SoftDeletes;

    public $table = 'baimo_admin_logs';

    protected $datas = ['deleted_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];



    protected $fillable = [
      'url','ip','method','name','u_id'
    ];
}
