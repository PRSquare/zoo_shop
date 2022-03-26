<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


function getPoweredBy($url){
    $tmp = parse_url($url);
    $stream = @fopen($url, 'rb'); // открываем сайт
    if(!$stream){
        return "Сайт не отвечает!";
    }
    $array = stream_get_meta_data($stream); // получаем заголовки
    return $array;
}

$var = getPoweredBy('https://linguistics.mgimo.ru/');
print_r ($var);
?>
