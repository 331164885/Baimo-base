<?php

namespace Baimo\Base\Repositories;

use Baimo\Base\Models\AdminLog;
use Baimo\Base\Repositories\Interfaces\AdminRepositoryInterface;

class AdminLogRepository implements AdminRepositoryInterface
{
    protected $admin;

    public function all()
    {
        return AdminLog::all();
    }



    // ...
}