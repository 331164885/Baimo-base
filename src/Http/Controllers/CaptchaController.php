<?php

namespace Baimo\Base\Http\Controllers;

use Baimo\Core\Http\Controllers\BaseApiController as Controller;

class CaptchaController extends Controller
{

    public function captcha()
    {
        //dd("hello world! Captcha");
        //dd(bcrypt("123456"));
        return $this->success(['captcha'=>app('captcha')->create('default', true)]);
    }

}
