<?php
$url='https://en.wikipedia.org/wiki/List_of_Malayalam_films_of_2016';
// using file() function to get content
$lines_array=file($url);
echo $lines_array[1];
echo $lines_array[2];
echo $lines_array[3];

// turn array into one variable
$lines_string=implode('',$lines_array);
echo $lines_string[1];

//output, you can also save it locally on the server
echo $lines_string;
?>