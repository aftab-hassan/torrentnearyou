<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

</body>
</html>

<?php
    $url = "compress.zlib://https://kat.cr/usearch/Monsoon%20Mangoes%20malayalam/";
    $handle = fopen($url, "r");
    if($handle)
    {
        /* iterating to find the sizes of the torrents */
        while (($line = fgets($handle)) !== false)
        {
            echo $line;
        }
    }
?>