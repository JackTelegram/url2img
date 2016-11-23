<?php

namespace screenbot\client;


class Client
{
    private static $token = "";


    public function __construct ($token)
    {
        self::$token = $token;
    }



    public static function bot($method,$d=[]){
        $url = "https://api.telegram.org/bot".self::$token."/".$method;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$d);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // fix error on php windows server
        $res = curl_exec($ch);
        curl_close($ch);
        return json_decode($res,true);
    }

    public function getupdates($up_id){
        $get = $this->bot('getupdates',[
            'offset'=>$up_id
        ]);
        return end($get['result']);
    }



    public static function screen($url)
    {
        $ch = curl_init();
        $p[CURLOPT_URL] = "https://api.url2img.com/?url=".$url;
        $p[CURLOPT_USERAGENT] = "Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36";
        $p[CURLOPT_RETURNTRANSFER] = true;
        $p[CURLOPT_SSL_VERIFYPEER] = false;
        curl_setopt_array($ch,$p);
        $result = curl_exec($ch);
        return $result;
        curl_close($ch);
    }
    public function load()
    {
        $text = "
        Copy Right : Taylor Team
        Owner : Negative
        php > 5.6
        ";
        echo $text."\n\n";
        echo "Loading : ... ";
        sleep(5);
        echo "Bot Username : @".self::bot("getme",[null])['result']['username']."\n\n\nBot Started\n";
    }
}