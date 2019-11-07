<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019-08-16
 * Time: 11:14
 */

/*
 * 获取名言
 * @param int $num 请求接口返回的名言数量
 */
function getSaying(int $num = 1)
{
    $redis = new \Redis();
    $redis->connect(env('REDIS_HOST'),6379);
    $cache = $redis->get("saying");
    if(!$cache){
        header("Content-Type: text/html; charset=utf-8");
        //请求API接口
        $key  = env('TX_SAY_KEY');
        $result = file_get_contents("http://api.tianapi.com/txapi/dictum/?key={$key}&num={$num}");

        $data  = json_decode($result,true);

        $info = [];
        //判断状态码
        if($data['code'] == 200){
            foreach ($data['newslist'] as $key=>$val){
                \App\Models\Saying::create([
                    'content' => $val['content'],
                    'author'  => $val['mrname']
                ]);
                $info['content'] = $val['content'];
                $info['author'] = $val['mrname'];
            }
        }else{
            //请求接口失败 随机从数据库中取出一条数据
           $info = \App\Models\Saying::inRandomOrder()->find();
        }
        //加入缓存 时间一天
        $redis->setex("saying",86400,serialize($info));
    }else{
        $info = unserialize($cache);
    }

    return "<a href=\"https://baidu.com/s?wd={$info['content']}\">每日箴言：{$info['content']} —— {$info['author']}</a>";

}


/*
 * 根据当前时间获取标语
 */
function getSlogan()
{
    //设置时区
    date_default_timezone_set("PRC");
    $hours = (int)date('H');

    switch ($hours){
        case ($hours >= 6 && $hours < 11):
            $slogan = "Good morning";
            break;
        case $hours >= 11 && $hours < 18:
            $slogan = "Good afternoon";
            break;
        case $hours >= 18 && $hours < 24:
            $slogan = "Good evening";
            break;
        default:
            $slogan = "Good evening";
            break;
    }
    return $slogan;
}

/*
 * 获取随机图片
 */
function getRandImage(){

    $redis = new \Redis();
    $redis->connect(env('REDIS_HOST'),6379);
    $cache = $redis->get('rand_image');
    if(!$cache){
        $url = "https://infinity-api.infinitynewtab.com/random-wallpaper";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);  // 从证书中检查SSL加密算法是否存在
        $res = curl_exec($curl);     //返回api的json对象
        //关闭URL请求
        curl_close($curl);
        $result = json_decode($res,'true');
        if($result['status'] == 200){

            $data = reset($result['data']);
            $src = $data['src']['mediumSrc'];

            $path = public_path().'/images/'.date('Ymd').'/';
            make_dir($path);
            $file = md5(uniqid()).".jpg";
            //下载文件
            dlfile($src,$path.$file);

            $return = "/images/".date('Ymd')."/".$file;
            //写入数据库
            \App\Models\Images::create([
                'path' => $return
            ]);
            //加入缓存
            $redis->setex('rand_image',3600,$return);
            
           
        }else{
            $return = '/images/default.jpg';
        }
    }else{
        $return = $cache;
    }

    return $return;


}

/*
 * 下载文件到本地
 */
function dlfile($file_url, $save_to){

    $in  =  fopen($file_url, "rb");
    $out =  fopen($save_to, "wb");
    while ($chunk = fread($in,8192))
    {
        fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);
}


function make_dir($dir, $mode = 0777) {
    if(!is_dir($dir)){
        if(!make_dir(dirname($dir))){
            return false;
        }
        if(!mkdir($dir,$mode)){
            return false;
        }
    }
    return true;
}


function meterTransMile($number,$type){
    if($type == 1 ){
        return floatval($number) * 1.609344;
    }else{
        return floatval($number) / 1.609344;
    }
}