<?php

namespace Baimo\Base\Models;

use Baimo\Core\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminRole extends BaseModel
{
    use SoftDeletes;

    protected $table = 'baimo_admin_roles';

    protected $datas = ['deleted_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}
