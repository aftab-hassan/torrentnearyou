<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 5/7/2016
 * Time: 8:48 AM
 */

$statusArray = array();
$allURLs = array("https://kat.cr/usearch/life%20of%20pi/","https://en.wikipedia.org/wiki/Basketball","https://kat.cr/usearch/life%20of%20pi/","https://en.wikipedia.org/wiki/Basketball");

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
    echo $line."\n";

    fclose($handle);
}

print_r($statusArray);
?>