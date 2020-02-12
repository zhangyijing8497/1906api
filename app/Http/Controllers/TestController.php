<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    public function testRedis()
    {
        // echo "qq";
        $key = "1906API";
        $val = "hello API";
        Redis::set($key,$val);//设置值
        $value = Redis::get($key);//获取值
        echo 'value: '.$value;
    }

    public function test1()
    {
        echo "hello php";
    }

    public function test2()
    {
        $userInfo = [
            'user_name' => 'zhangsan',
            'email' => 'zhangsan@qq.com',
            'age' => 13
        ];
        return $userInfo;
    }
}
