<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 5/14/2016
 * Time: 1:56 PM
 */

function updateScheduledUpdatedInfo()
{
    $myfile = fopen("/var/www/data/scheduledUpdate.txt", "w") or die("Unable to open file!");

    $txt = "Library last updated on : ".date("l-Y-m-d")." , ";
    fwrite($myfile, $txt);

    $txt = "Next scheduled update on : ".date('l-Y-m-d', strtotime(date("l").",".date("Y-m-d"). ' + 14 days'));
    fwrite($myfile, $txt);

    fclose($myfile);
}

updateScheduledUpdatedInfo();
?>