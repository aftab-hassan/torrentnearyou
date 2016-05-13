<html>

<head>
</head>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<div class="container">
    <div class="jumbotron">
        <h1 align="center" style="font-family:Comic Sans MS">Torrent Near You</></h1>
        <p align="center" style="font-family:Comic Sans MS">See which movies have released at a torrent near you ...</p>
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

    <select name="yeardropdown" id="yeardropdown">
    </select>

    <input type="hidden" name="randomNumber" id="randomNumber" value="<?php echo mt_rand(); ?>" />

    <input type="submit" name="submit" id="submit" value="submit" onclick="deleteTable()">

</form>
</body>
<script>
    for(var i = 2010; i <= new Date().getFullYear();i++)
    {
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

/* Remmeber, the whole point of this is to generate the table code */
if(isset($_GET['languagedropdown']) && isset($_GET['yeardropdown']))
{
    $servername = "localhost";
    $username = "root";
    $password = "aftab";
    $dbname = "torrentnearyoudb";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

//    $sql = "SELECT * FROM movieTbl where movieName='"."Bodyguard"."'";
    $sql = "select * from movieTbl where movieLanguage = " . "'" .$_GET['languagedropdown'] . "'" . " and " . "movieYear=" . "'" . $_GET['yeardropdown'] . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        /* arrays for pushing */
        $movienamearray = array();
        $pageLinkarray = array();
        $torrentlinkarray = array();

        // output data of each row
        while($row = $result->fetch_assoc())
        {
            array_push($movienamearray,$row["movieName"]);
            array_push($pageLinkarray,$row["pageLink"]);
            array_push($torrentlinkarray,$row["directLink"]);
        }
    }
    $conn->close();

//    print_r($movienamearray); echo "</br>";
//    print_r($pageLinkarray); echo "</br>";
//    print_r($torrentlinkarray); echo "</br>";

    /* putting it in a table */
    echo "<table name=\"myTable\" id=\"myTable\" width=100% border=1 cellspacing=0 cellpadding=0>";
    echo "<tr><th>Serial</th><th>Movie</th><th>Torrent page link</th><th>Direct link (click to download)</th></tr>";
    for($i = 0;$i < count($torrentlinkarray);$i++)
    {
        $serial = $i + 1;

        if($torrentlinkarray[$i] == "404")
            echo "<tr>"."<td>".$serial."</td>"."<td>".$movienamearray[$i]."</td>"."<td>"."torrent not present"."</td>"."<td>"."torrent not present"."</td>"."</tr>";

        else
        {
            $link = "https://kat.cr/usearch/".str_replace(" ","%20",$movienamearray[$i])."%20".$_GET['yeardropdown']."%20".$_GET['languagedropdown'];

            //using ahref : <a href="https://torcache.net/torrent/6430CFD62C88F994AC6F158AB3CD903A09EE87D7.torrent?title=[kat.cr]monsoon.mangoes.2016.malayalam.dvdrip.x264.800mb.esubs.mkv" download>Click here</a>
            $ahrefcode = "<a href="."\"".$torrentlinkarray[$i]."\""." download>Click here for direct download link</a>";
            echo "<tr>"."<td>".$serial."</td>"."<td>".$movienamearray[$i]."</td>"."<td>"."<a href = \"" . $link . "\">Click here to visit the torrent page.</a>"."</td>"."<td>".$ahrefcode."</td>"."</tr>";
        }
    }
    echo "</table>";
}
?>