<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 5/7/2016
 * Time: 8:48 AM
 */

$statusArray = array();
$allURLs = array("https://kat.cr/usearch/life%20of%20pi/","https://en.wikipedia.org/wiki/Basketball","https://kat.cr/usearch/life%20of%20pi/","https://en.wikipedia.org/wiki/Basketball");
//$allURLs = array("https://en.wikipedia.org/wiki/Basketball");
//$allURLs = array("compress.zlip://https://kat.cr/usearch/life%20of%20pi/");

for($i = 0;$i < count($allURLs) ; $i++)
{
    $handle = fopen($allURLs[$i], "r");
    if ($handle)
    {
        // error opening the file.
        array_push($statusArray,"able to open the page!");
    }
    else
    {
        // error opening the file.
        array_push($statusArray,"404");
    }

    /* printing page now */
    $line = fgets($handle);
    echo $line;

    fclose($handle);
}

print_r($statusArray);
?>