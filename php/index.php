<html>

<head>

</head>
<script>
    function deleteTable()
    {
        var tbl = document.getElementById('myTable');
        if(tbl) tbl.parentNode.removeChild(tbl);
    }
</script>

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
    $torrentlinkarray = array();
    $sizeMBarray = array();

//    $url = $base.str_replace(" ","%20",$movienamearray[$i])."%20".$_GET['yeardropdown']."%20".$_GET['languagedropdown'];
//        $url = $base.str_replace(" ","%20","monsoon mangoes")."%20".$_GET['year']."%20".$_GET['language'];
//        $url = "compress.zlib://https://kat.cr/usearch/kali%202016%20malayalam/";
//        $url = "https://kat.cr/usearch/kali%202016%20malayalam/";
//        $url = "compress.zlib://http://oztorrent.com/search/kali%202016%20malayalam/";
//        http://oztorrent.com/search/malayalam%20kali%20movie/
        $url = "https://en.wikipedia.org/wiki/2015_in_film";

    $handle = fopen($url, "r");
    if ($handle)
    {
        // error opening the file.
        array_push($torrentlinkarray,"405");
        array_push($sizeMBarray,-2);
    }
    else
    {
        // error opening the file.
        array_push($torrentlinkarray,"404");
        array_push($sizeMBarray,-1);
    }
    fclose($handle);

    print_r($torrentlinkarray);
    print_r($sizeMBarray);
}
?>
