<?php
error_reporting(0);
require('load.php');
use screenbot\client as bot;


$bot = new bot\Client("Your Token");
$bot->load();
function run($up){
    global $bot;
    $msg = $up['message'];
    if(isset($msg) and isset($msg['text'])){
        $text = $msg['text'];
        $chat = $msg['chat']['id'];
        echo "\n\n\033[31m CHAT ID : ".$chat."\nTEXT : ".$text."\n\n\e[0m";
        if($msg['entities'][0]['type'] == "url"){
            file_put_contents("screen.png",$bot::screen($text));
            $bot->bot("sendPhoto",[
                "chat_id"=>$chat,
                'photo'=>new CURLFILE("screen.png")
            ]);
        }else{
            $bot->bot('sendMessage',[
               'chat_id'=>$chat,
                'text'=>"لطفا یک لینک ارسال کنید"
            ]);
        }
    }
}
while(true){
    $i;
    $get_up = $bot->getupdates($i+1);
    $i = $get_up['update_id'];
    run($get_up);
    sleep(0.1);
}
