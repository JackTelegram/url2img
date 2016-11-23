<?php
$dir = "lib/screenbot/client";
$array = scandir($dir);
foreach ($array as $b){
    if(!preg_match('/\.php/',$b)){
        continue;
    }else{
        require($dir."/".$b);
    }
}