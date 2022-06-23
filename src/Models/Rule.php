<?php

namespace Baimo\Base\Models;

use Baimo\Core\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rule extends BaseModel
{
    use SoftDeletes;

    protected $datas = ['deleted_at'];

    protected $table = "baimo_rules";
}
