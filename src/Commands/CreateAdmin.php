<?php

namespace Baimo\Base\Commands;

use Exception;
use Illuminate\Console\Command;
use Baimo\Base\Models\Admin;
use Illuminate\Support\Carbon;

class CreateAdmin extends Command
{
    protected $name = 'baimo-base:admin';

    protected $description = 'Creation of a superuser.';

    public function handle()
    {
        $this->info('Creating a Super User...');

        $username = $this->ask('Enter admin username');
        $email = $this->ask('Enter admin email address');
        $password = $this->ask('Enter a passwor');

        $data = [
          'name' => $username,
          'phone' => '',
          'email' => $email,
          'email_verified_at' => '',
          'avatar' => '',
          'password' => bcrypt($password),
          'remember_token' => '',
          'superuser' => '1',
          'activated' => '1',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ];

        try {
            Admin::create($data);
            $this->info('Superuser created.');
        } catch (Exception $e) {
            $this->error('Superuser could not be created.');
        }

        $this->line('------------------');
    }
}