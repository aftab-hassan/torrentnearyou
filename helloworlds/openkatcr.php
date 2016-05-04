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
echo $data = file_get_contents($url, false, stream_context_create(array('http'=>array('header'=>"Accept-Encoding: gzip\r\n"))));
?>