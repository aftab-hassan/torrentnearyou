<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 5/5/2016
 * Time: 12:15 PM
 */

$fileContents = file_get_contents("/var/www/data/fileonserver".$_GET['randomNumber']."txt", "w", true);
echo $fileContents;
?>