<?php

namespace Baimo\Base\Providers;

use Baimo\Base\Services\AdminService;
use Baimo\Base\Services\Interfaces\AdminServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AdminServiceInterface::class, AdminService::class);
    }
}