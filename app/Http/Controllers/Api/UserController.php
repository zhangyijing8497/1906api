<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 2020年2月12日12:18:42
     * 获取用户信息
     */
    public function info()
    {
        $user_info = [
            'user_name' => 'zhangsan',
            'sex' => '1',
            'email' => 'zhangsan@qq.com',
            'age' => 12,
            'date' => date('Y-m-d H:i:s')
        ];
        return $user_info;
    }

    /**
     * 2020年2月12日13:10:49
     * 用户注册
     */
    public function reg(Request $request)
    {
        // 处理用户注册
        $user_info = [
            'user_name'   =>   $request->input('user_name'),
            'email'   =>   $request->input('email'),
            'pass'   =>   '666666',
        ];

        $id = UserModel::insertGetId($user_info);
        echo "自增id： " .$id;
    }

    /**
     * 获取天气
     * 2020年2月20日
     */
    public function weather()
    {
        if(empty($_GET['location'])){
            echo "请输入城市名称";die;
        }
        $location = $_GET['location'];
        $url = "https://free-api.heweather.net/s6/weather/now?location=".$location."&key=04ccb59b9258402eba9376be085c7dbd";
        $data = file_get_contents($url);
        $arr = json_decode($data,true);
        echo '<pre>';print_r($arr);echo '</pre>';die;
        return $arr;
    }

}
