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

    public function get1()
    {
        echo "接受的数据:";echo "<br>";
        echo '<pre>';print_r($_GET);echo '</pre>';
    }

    public function post1()
    {
        // $data = file_get_contents("php://input");
        // var_dump($data);
        echo "<hr>";
        echo "1906API";
        echo '<pre>';print_r($_POST);echo '</pre>';
        echo '<pre>';print_r($_FILES);echo '</pre>';
    }

    public function post2()
    {
        echo '<pre>';print_r($_POST);echo '</pre>';
    }

    /**
     * 可以接受json xml
     */
    public function post3()
    {
        // echo '<pre>';print_r($_POST);echo '</pre>';
        $json = file_get_contents("php://input");  //接收json 或xml数据
        $arr = json_decode($json,true);
        print_r($arr);
    }

    /**
     * 接收post 上传文件
     */
    public function testUpload()
    {
        echo '<pre>';print_r($_POST);echo '</pre>';
        echo "接受文件:";echo "<br>";
        echo '<pre>';print_r($_FILES);echo '</pre>';
    }

    /**
     * 获取当前完整的url地址
     */
    public function getUrl()
    {
        // 协议
        $scheme = $_SERVER['REQUEST_SCHEME'];

        // 域名
        $host = $_SERVER['HTTP_HOST'];
        
        // 请求uri
        $uri = $_SERVER['REQUEST_URI'];

        $url = $scheme . "://" . $host  . $uri;

        echo '<pre>';print_r($url);echo '</pre>';
    }

    public function redisStr1()
    {
        $key = "username";
        $value = "lisi";
        Redis::set($key,$value);
    }

    public function count1()
    {
        // UA识别用户
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $u = md5($ua);
        $u = substr($u,5,5);

        $max = 15;

        // 判断次数是否达到上限
        $k = $ua.':count1';
        $num = Redis::get($k);
        echo "现有访问次数: ".$num;echo '</br>';


        if($num>$max){
            Redis::expire($k,10);

            echo "该接口访问次数已达上限".$max;echo '</br>';
            echo "请在10s后访问";
            die;
        }

        $count = Redis::incr($k);
        echo $count;echo '</br>';
        echo "正常访问";
    }

    public function api2()
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $u = md5($ua);
        $u = substr($u,5,5);
        echo "U: ".$u;echo '</br>';

        $uri = $_SERVER['REQUEST_URI'];
        echo "uri:" . $uri;echo '</br>';

        $md5_uri = substr(md5($uri),0,8);
        echo $md5_uri;

        // $key = $u . ":" . $md5_uri . ":count";
        $key = 'count:uri:'.$u.':'.$md5_uri;
        echo "Redis Key:".$key;echo '</br>';

        echo '<hr>';
        $count = Redis::get($key);
        echo "当前接口计数:".$count;echo '</br>';
        $max = 15;
        echo "接口访问最大次数:".$max;echo '</br>';
        if($count>$max){
            echo "你在!你在!无中生有 暗度陈仓 凭空想象 凭空捏造";
            die;
        }
        Redis::incr($key);
    }

    public function api3()
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $u = md5($ua);
        $u = substr($u,5,5);
        echo "U: ".$u;echo '</br>';

        $uri = $_SERVER['REQUEST_URI'];
        echo "uri:" . $uri;echo '</br>';

        $md5_uri = substr(md5($uri),0,8);
        echo $md5_uri;

        // $key = $u . ":" . $md5_uri . ":count";
        $key = 'count:uri:'.$u.':'.$md5_uri;
        echo "Redis Key:".$key;echo '</br>';

        echo '<hr>';
        $count = Redis::get($key);
        echo "当前接口计数:".$count;echo '</br>';
        $max = 15;
        echo "接口访问最大次数:".$max;echo '</br>';
        if($count>$max){
            echo "你在!你在!无中生有 暗度陈仓 凭空想象 凭空捏造";
            die;
        }
        Redis::incr($key);
    }

    public function md5Test()
    {
        $key = "1906api";  //发送方 与 接收方 使用同一个 key
        
        $str = $_GET['str'];
        echo "签名前的数据:" .$str;echo '</br>';

        // 计算签名
        $sign = md5($str.$key);
        echo "计算的签名:" . $sign;

        // 发送数据(原始数据+签名)
    }

    /**
     * 接收数据 验证签名
     */
    public function verifySign()
    {
        $key = "1906api";

        $data = $_GET['data'];  //接收到的数据
        $sign = $_GET['sign'];  //接受到了签名

        //验签
        $sign2 = md5($data.$key);
        echo "接收端计算的签名:".$sign2;echo '</br>';

        // 与接收到的签名对比
        if($sign2 == $sign){
            echo "验签通过,数据完整";
        }else{
            echo "验签失败,数据损坏";
        }
    }

}
