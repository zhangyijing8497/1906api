<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\GModel;
use Illuminate\Support\Facades\Redis;


class GoodsController extends Controller
{
    public function details()
    {

        $goods_id = request()->input('goods_id');
        $goods_key = "str:goodsInfo:" . $goods_id;
        echo 'redis_key:'.$goods_key;
        echo '</br>';

        // 判断是否有缓存信息
        $cache = Redis::get($goods_key);
        if($cache){
            echo "有缓存";echo '</br>';
            $goodsInfo = json_decode($cache,true);
            echo '<pre>';print_r($goodsInfo);echo '</pre>';
        }else{
            echo "无缓存";echo '</br>';

            $goodsInfo = GModel::where('goods_id',$goods_id)->first();
            $arr = $goodsInfo->toArray();
            $json_goods = json_encode($arr);

            Redis::set($goods_key,$json_goods);
            Redis::expire($goods_key,6);
            echo '<pre>';print_r($arr);echo '</pre>';
        } 
        
        die;

        $data = [
            'goods_id'  => $goods_id,
            'ua'        => $_SERVER['HTTP_USER_AGENT'],
            'ip'        => $_SERVER['REMOTE_ADDR'],
            'created_at'=> time()
        ];
        $res = GoodsModel::insert($data);
        var_dump($res);

        echo "<hr>";
        $pv = GoodsModel::where('goods_id',$goods_id)->count();
        echo "pv: ".$pv;echo "<br>";
        $uv = GoodsModel::where('goods_id',$goods_id)->distinct('ua')->count('ua');
        echo "uv: ".$uv;
    }
}
