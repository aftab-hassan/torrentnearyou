<?php
//$url = "https://kat.cr/usearch/kali%202016%20malayalam/";
$url = "http://www.cricinfo.com";

//step1 
$cSession = curl_init();
//step2
curl_setopt($cSession,CURLOPT_URL,$url);
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);
//step3 
$result=curl_exec($cSession);
//step4 
curl_close($cSession);
//step5 
echo $result;
?>