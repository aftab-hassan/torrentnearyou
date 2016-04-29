<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 4/29/2016
 * Time: 5:35 PM
 */

$url = "https://kat.cr/usearch/life%20of%20pi/";
//echo $data = file_get_contents($url, false, stream_context_create(array('http'=>array('header'=>"Accept-Encoding: gzip\r\n"))));

$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url
, CURLOPT_HEADER => 0
, CURLOPT_RETURNTRANSFER => 1
, CURLOPT_ENCODING => 'gzip'
));
echo curl_exec($ch);

?>