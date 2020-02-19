<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;


class ApiFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $uri = $_SERVER['REQUEST_URI'];
        $ua = $_SERVER['HTTP_USER_AGENT'];

        $md5_uri = substr(md5($uri),5,9);
        $md5_ua = substr(md5($ua),5,9);

        $k = 'count:uri:' . $md5_uri . ':' . $md5_ua;
        echo $k;echo '</br>';

        $count = Redis::get($k);
        echo "当前访问次数:".$count;echo '</br>';
        $max = 5;
        if($count>$max){
            // 设置key过期时间
            Redis::expire($k,10);
            echo "无中生有 暗度陈仓 凭空想象 凭空捏造";
            die;
        }
        Redis::incr($k);
        return $next($request);
    }
}
