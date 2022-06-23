<?php

namespace Baimo\Base\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class Install extends Command
{
    protected $name = 'baimo-base:install';

    protected $description = 'Installation of Baimo';

    public function handle()
    {
        // 欢迎信息
        $this->line('------------------');
        $this->line('Welcome use Baimo');
        $this->line('------------------');

        // 创建数据库
        $this->info('Setting up database...');
        $dbName = $this->ask('Enter a database name', $this->getDBName());
        $this->call('baimocms:database', ['database' => $dbName]);
        $this->line('------------------');

        // 创建管理员
        $this->info('Create a super user...');
        $this->call('baimocms:admin');
        $this->line('------------------');

        // 安装前文件权限检查
        if(function_exists('system')) {
            // 修改bootatrap/cache文件夹权限
            system('chmod 755 $(find bootstrap/cache -type d)');
            $this->info('Directory bootstrap/cache is now writable (755).');

            // 修改storage文件夹权限
            system('chmod 755 $(find storage -type d)');
            $this->info('Directory storage is now writable (755).');
        } else {
            $this->line('You can now make /storage, /bootstrap/cache directories writable,');
        }

        // 安装完成
        $this->line(' Install Successfully. Enjoy Baimo!');
    }

    /**
     * 获取数据库名称
     **/
    protected function getDBName()
    {
        try {
            $segments = array_reverse(explode(DIRECTORY_SEPARATOR, app_path()));
            $name = explode('.', $segments[1])[0];

            return Str::slug($name);
        } catch (Exception $e) {
            return '';
        }
    }

}