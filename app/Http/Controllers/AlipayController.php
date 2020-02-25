<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AlipayController extends Controller
{
    public function test1()
    {
        $url = "https://openapi.alipaydev.com/gateway.do";  //沙箱测试环境

        $client = new Client;

        // 请求参数
        $common_param = [
            'out_trade_no'  =>  '1906test_'.time().'_'.mt_rand(11111,99999),
            'product_code'  =>  'FAST_INSTANT_TRADE_PAY',
            'total_amount'  =>  '1.00',
            'subject'       =>  '测试订单:'.mt_rand(11111,99999)
        ];

        // 公共请求参数
        $pub_param = [   
            'app_id'        =>  env('ALIPAY_APPID'),
            'method'        =>  'alipay.trade.page.pay',
            'charset'       =>  'utf-8',
            'sign_type'     =>  'RSA2',
            'timestamp'     =>  date('Y-m-d H:i:s'),
            'version'       =>  '1.0',
            'biz_content'   =>  json_encode($common_param)
        ];

        $param = array_merge($common_param,$pub_param);
        echo '排序前:<pre>';print_r($param);echo '</pre>';
        // 筛选并排序
        ksort($param);
        echo '排序后:<pre>';print_r($param);echo '</pre>';

        // 拼接得到待签名字符串
        $str = '';
        foreach($param as $k=>$v){
            $str .= $k . '=' . $v . '&';
        }

        $str = rtrim($str,'&');
        echo "待签名字符串:" ."?". $str;echo '<hr>';

        // 调用签名函数 得到$sign base64编码
        $priv_key_id = openssl_pkey_get_private("file://".storage_path('keys/priv_ali.key'));
        openssl_sign($str,$sign,$priv_key_id,OPENSSL_ALGO_SHA256);
        echo '签名sign: '.$sign;echo '</br>';
        $b64_sign = base64_encode($sign);

        // 将编码后的签名拼接到url参数中


        $request_url = $url . '?' .$str. '&sign=' .urlencode($b64_sign);
        echo "request_url:" .$request_url;

        header("Location:".$request_url);
    }
}
