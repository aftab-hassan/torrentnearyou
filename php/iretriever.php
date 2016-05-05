<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 5/5/2016
 * Time: 12:15 PM
 */

$fileName = "/var/www/data/fileonserver".$_GET['randomNumber']."txt";
//$fileContents = file_get_contents("/var/www/data/fileonserver".$_GET['randomNumber']."txt", "w", true);
//$fileContents = file_get_contents($fileName, "w", true);
echo $fileName;
//echo $fileContents;
?>