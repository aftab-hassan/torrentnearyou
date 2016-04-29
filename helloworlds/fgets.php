<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 4/28/2016
 * Time: 4:21 PM
 */

//$handle = fopen("inputfile.txt", "r");
$handle = fopen("https://en.wikipedia.org/wiki/List_of_Malayalam_films_of_2016", "r");
$i = 0;
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $i++;
        echo "printing line ".$i." == ".strlen($line)."</br>";
    }

    fclose($handle);
} else {
    // error opening the file.
}

?>