<?php

namespace Baimo\Base\Repositories;

use Baimo\Base\Models\Admin;
use Baimo\Base\Repositories\Interfaces\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    protected $admin;

    public function all()
    {
        return Admin::all();
    }



    // ...
}