<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;

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

     /**
     * 获取微信access_token
     */
    public function getAccessToken()
    {
        $app_id = 'wxaa3fdba21e822298';
        $appsecret = '14618ca21e115be6cbca4de84c145e42';
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$app_id."&secret=".$appsecret;
        echo $url;
        echo "<hr>";
        // 使用file_get_contents 发起GET请求
        $response = file_get_contents($url);
        $arr = json_decode($response,true);
        // echo '<pre>';print_r($arr);echo '</pre>';
        var_dump($response);
    }

    public function curl1()
    {
        $app_id = 'wxaa3fdba21e822298';
        $appsecret = '14618ca21e115be6cbca4de84c145e42';
        $url = "https://api.weixin.q1q.com/cgi-bin/token?grant_type=client_credential&appid=".$app_id."&secret=".$appsecret;
        // echo $url;
        // echo "<hr>";
        // 初始化
        $ch = curl_init($url);

        // 设置参数选项
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //0启用浏览器输出1 关闭浏览器输出,可用变量接收响应

        // 执行会话
        $response = curl_exec($ch);

        // 关闭会话
        curl_close($ch);

        // 处理错误
        $errno = curl_errno($ch);
        $error = curl_error($ch);

        if($errno > 0){
            echo "错误码:" .$errno;echo "<br>";
            echo "错误信息:" .$error;die; 
        }

        // 处理逻辑
        var_dump($response);
    }

    /**
     * curl post 请求
     */
    public function curl2()
    {
        $access_token = '30_MlMdDB4CBok7IqO6_Zy9qdCh5L-Zwmu2rim8MkcMTaF7_ZZklD_5eQXc1zWtaUvOTQQWuUE-smN54VYhqoZgDtVI-_mmbo9_KHe-y3xANMHVYuZ3-7WzdVZUev6xuAK7NxtjarAEhh12jnaBGHKaAFAQRU';
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $menu = [
            "button" => [
                [
                    "type" => "click",
                    "name" => "CURL",
                    "key"  => "curl001"
                ]
            ]
        ];

        // 初始化
        $ch = curl_init($url);

        // 设置参数
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //0启用浏览器输出1 关闭浏览器输出,可用变量接收响应
        // post请求
        curl_setopt($ch,CURLOPT_POST,true);
        // 发送json数据,非form-data形式
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($menu));

        // 执行curl会话
        $response = curl_exec($ch);

        
        // 处理错误
        $errno = curl_errno($ch);
        $error = curl_error($ch);

        if($errno > 0){
            echo "错误码:" .$errno;echo "<br>";
            echo "错误信息:" .$error;die; 
        }

        // 关闭会话
        curl_close($ch);


        // 数据处理
        var_dump($response);

    }

    public function guzzle()
    {
        $app_id = 'wxaa3fdba21e822298';
        $appsecret = '14618ca21e115be6cbca4de84c145e42';
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$app_id."&secret=".$appsecret;
        // echo $url;
        
        $client = new Client();
        $response = $client->request('GET',$url);
        $data = $response->getBody();
        echo $data;
    }
}
