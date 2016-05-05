<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 5/5/2016
 * Time: 12:15 PM
 */

$fileName = "/var/www/data/fileonserver".$_GET['randomNumber']."txt";
echo $fileName;
//$fileName = '/var/www/data/fileonserver2111308781txt';
//$fileContents = file_get_contents($fileName, "w", true);

$fileHandle = fopen($fileName, "r") or die("Unable to open file!");
$fileContents = fread($fileHandle,filesize($fileName));
fclose($fileHandle);

//echo $fileName."_".$fileContents;
//echo $fileContents;
?>