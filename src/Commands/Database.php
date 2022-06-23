<?php
namespace Baimo\Base\Commands;

use DB;
use Schema;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\SymfonyQuestionHelper;

class Database extends Command
{
    protected $name = 'baimo-base:database';

    protected $description = 'Set database credentials in .env file';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle()
    {
        $contents = $this->getEnvFile();

        $dbName = $this->argument('database');

        $dbAddress = $this->ask('What is your MySQL address?', '127.0.0.1');

        $dbPort = $this->ask('What is your MySQL port?', '3306');

        $dbUsername = $this->ask('What is your MySQL username?', 'admin');

        $question = new Question('What is your MySQL password?', '<none>');
        $question->setHidden(true)->setHiddenFallback(true);
        $dbPassword = (new SymfonyQuestionHelper())->ask($this->input, $this->output, $question);

        if ($dbPassword === '<none>') {
            $dbPassword = '';
        }

        $search_target = [
            '/('.preg_quote('DB_HOST=').')(.*)/',
            '/('.preg_quote('DB_PORT=').')(.*)/',
            '/('.preg_quote('DB_DATABASE=').')(.*)/',
            '/('.preg_quote('DB_USERNAME=').')(.*)/',
            '/('.preg_quote('DB_PASSWORD=').')(.*)/',
        ];

        $replace = [
            '${1}'.$dbAddress,
            '${1}'.$dbPort,
            '${1}'.$dbName,
            '${1}'.$dbUsername,
            '${1}'.$dbPassword,
        ];

        if (!preg_replace($search_target, $replace, $contents)) {
            throw new Exception('Error while writing credentials to .env file.');
        }

        $this->laravel['config']['database.connections.mysql.host'] = $dbAddress;
        $this->laravel['config']['database.connections.mysql.port'] = $dbPort;
        $this->laravel['config']['database.connections.mysql.username'] = $dbUsername;
        $this->laravel['config']['database.connections.mysql.password'] = $dbPassword;

        unset($this->laravel['config']['database.connections.mysql.database']);

        // 强制使用新用户名登录
        DB::purge();

        // 如果数据库不存在就创建数据库
        DB::unprepared('CREATE DATABASE IF NOT EXISTS `'.$dbName.'`');
        DB::unprepared('USE `'.$dbName.'`');
        DB::connection()->setDatabaseName($dbName);

        // 执行数据迁移
        if (Schema::hasTable('megrations')) {
            $this->error('A migrations table was found in database ['.$dbName.'], no migration and seed were done.');
        } else {
            $this->call('migrate');
            $this->call('db:seed');
        }

        // 将配置信息写到配置文件
        $this->files->put('.env', $contents);
    }

    /**
     * 获取配置文件.env的内容并返回
     *
     * @return string
     **/
    protected function getEnvFile()
    {
        return $this->files->exists('.env') ? $this->files->get('.env') : $this->files->get('.env.example');
    }

    /**
     * 获取命令行参数
     *
     * @return array
     **/
    protected function getArguments()
    {
        return [
            ['database', InputArgument::REQUIRED, 'The database name'],
        ];
    }

    /**
     * 清除默认Laravel程序下的数据库迁移文件
     **/
    protected function cleanDatabaseFiles()
    {
        try {
            $targetDir = base_path() . '/database/migrations/';

            $file = new Filesystem();
            $file->cleanDirectory($targetDir);
        } catch (Exception $e) {
            throw new Exception('Cannot delete the original database file!');
        }
    }
}