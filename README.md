<h1 align="center"> BaimoCMS base Module </h1>

<p align="center"> .</p>


## Installing

```shell
$ composer require baimocms/base -vvv

// 扩展包
$ composer require tymon/jwt-auth
$ composer require casbin/laravel-authz
```

## Usage

### Add service provider
Add the service provider to the providers array in the config/app.php config file as follows:
```shell
'providers' => [
    ...
    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
    Lauthz\LauthzServiceProvider::class,
    Mews\Captcha\CaptchaServiceProvider::class,
]
```

### Add the Facade in config/app.php
```shell
'aliases' => [
    // ...
    'Enforcer' => Lauthz\Facades\Enforcer::class,
    'Captcha' => Mews\Captcha\Facades\Captcha::class,
]
```

### Publish the config
```shell
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan vendor:publish --provider="Lauthz\LauthzServiceProvider"
php artisan vendor:publish --provider="Mews\Captcha\CaptchaServiceProvider"
```

### Generate secret key
```shell
php artisan jwt:secret
```

### Change app/Http/Kernel.php file
add these line 
```php
'log' => \BaimoCMS\Base\Http\Middleware\AdminLog::class,
'permission'=>\BaimoCMS\Base\Http\Middleware\PermissionsAuth::class,
```

### Change .env file
add these line
```php
OPERATION_LOG=false
```

### Change config/database.php file
change mysql.strict
```php
'strict' => false,
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/baimocms/base/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/baimocms/base/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT

## RefLink:
https://learnku.com/courses/creating-package/encapsulation-of-laravel-service-provider/2161
https://learnku.com/docs/laravel/5.8/packages/3922#ba43aa
https://learnku.com/docs/laravel-package-development/middleware/7348



https://learnku.com/laravel/t/62521?order_by=created_at&
https://bluecollardev.io/repository-pattern-in-laravel
