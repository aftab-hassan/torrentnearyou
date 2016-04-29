<?php
ob_start("ob_gzhandler");

$url='https://en.wikipedia.org/wiki/List_of_Malayalam_films_of_2016';
$url = 'http://www.livelifedrive.com/';
$url = 'https://kat.cr/usearch/Monsoon%20Mangoes%20malayalam/';
$handle = fopen($url, "r");

if ($handle)
{
    while (($line = fgets($handle)) !== false)
    {
        echo $line;
    }
}
else
{
    // error opening the file.
    echo "could not open the wikipedia URL!";
}
fclose($handle);
?>