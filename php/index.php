<html>

<head>

</head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<div class="container">
    <div class="jumbotron">
        <h1 align="center" style="font-family:Comic Sans MS">Torrent Near You</></h1>
        <p align="center" style="font-family:Comic Sans MS">See which movies have released at a torrent near you ...</p>

<!--        <h1 align="center" style="font-family:Comic Sans MS">Articles You</></h1>-->
<!--        <p align="center" style="font-family:Comic Sans MS">See which articles are near you ...</p>-->
    </div>
</div>

<body>
<form method="get" action="index.php">
    <select name="languagedropdown" id="languagedropdown">
        <!--        <option value = "tagalog">Tagalog</option>-->
        <option value = "malayalam">Malayalam</option>
        <option value = "tamil">Tamil</option>
        <option value = "hindi">Hindi</option>
        <option value = "english">English</option>
        <option value = "tagalog">Tagalog</option>
        <option value = "telugu">Telugu</option>
        <option value = "kannada">Kannada</option>
    </select>
    <!--    </br>-->

    <select name="yeardropdown" id="yeardropdown">
    </select>

    <input type="hidden" name="randomNumber" id="randomNumber" value="<?php echo mt_rand(); ?>" />

    <input type="submit" name="submit" id="submit" value="submit" onclick="deleteTable()">

    <br><label id="mylabel" name="mylabel"></label>
</form>
</body>
<script>
    for(var i = 2010; i <= new Date().getFullYear();i++)
    {
//        console.log("added "+i);
        var dropdownListID = document.getElementById("yeardropdown");
        var year = new Option(i,i);
        dropdownListID.options[i-2010] = year;
    }
</script>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 4/28/2016
 * Time: 12:07 PM
 */
include('simple_html_dom.php');

/* Remmeber, the whole point of this is to generate the table code */
if(isset($_GET['languagedropdown']) && isset($_GET['yeardropdown']))
{
    /* kat.cr : https://kat.cr/usearch/Monsoon%20Mangoes%20malayalam/ */
    $url = "compress.zlib://https://kat.cr/usearch/kali%202016%20malayalam/";

    $handle = fopen($url, "r");
    if ($handle) {
        /* iterating to find the sizes of the torrents */
        while (($line = fgets($handle)) !== false) {
            echo $line;
        }//finished iterating across all torrents

    }
}
?>
