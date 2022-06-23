<?php

namespace Baimo\Base\Providers;

use Baimo\Base\Repositories\AdminRepository;
use Baimo\Base\Repositories\Interfaces\AdminRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
    }
}