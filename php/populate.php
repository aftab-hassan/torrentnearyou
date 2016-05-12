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
<form method="get" action="populate.php">
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

    function updateLabelText(remainingMovieCount)
    {
        console.log("came inside updateLabelText with the value : "+remainingMovieCount);
        alert("hello");

        if(remainingMovieCount > 0)
        {
            if(remainingMovieCount  == 1)
                document.getElementById("remainingMovieCountLbl").innerHTML = "Please do not refresh the page ! Finding torrents for " + remainingMovieCount + " more movie. Check back shortly !";
            else
                document.getElementById("remainingMovieCountLbl").innerHTML = "Please do not refresh the page ! Finding torrents for " + remainingMovieCount + " more movies. Check back in a couple of minutes !";
        }
        else
            document.getElementById("remainingMovieCountLbl").innerHTML = "";
    }
</script>

<script type="text/javascript" src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    var clearTimeoutID = 0;
    var randomNumber = document.getElementById('randomNumber').value;
    console.log("randomNumber value == "+randomNumber);
    var ajaxFunction = function() {
        $.get(
            "iretriever.php",
            {randomNumber : randomNumber},
            function(data)
            {
                console.log("retrieved data from iretriever.php == "+data+", length=="+data.length);

                if(data.length > 0)
                {
                    document.getElementById("languagedropdown").disabled=true;
                    document.getElementById("yeardropdown").disabled=true;
                    document.getElementById("submit").disabled=true;

                    document.getElementById("languagedropdown").style="background-color:#d3d3d3";
                    document.getElementById("yeardropdown").style="background-color:#d3d3d3";
                }

                $('#mylabel').html(data);

                if(data == "end of data")
                {
                    document.getElementById("languagedropdown").disabled=false;
                    document.getElementById("yeardropdown").disabled=false;
                    document.getElementById("submit").disabled=false;

                    clearTimeout(clearTimeoutID);
                }
                else
                    clearTimeoutID = setTimeout(ajaxFunction,1000);
            }
        );
    }

    $(document).ready(ajaxFunction);
    //    $(document).ready($("submit").click(ajaxFunction));
    //    $(document).ready($("submit").click(function(){
    //        $.get(
    //            "iretriever.php",
    //            {randomNumber : randomNumber},
    //            function(data) {
    //                console.log("retrieved data from iretriever.php == "+data);
    //                $('#mylabel').html(data);
    //
    //                if(data == "end of data")
    //                    clearTimeout(clearTimeoutID);
    //                else
    //                    clearTimeoutID = setTimeout(ajaxFunction,1000);
    //            }
    //        );
    //    }))
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

//populateDB($_GET['yeardropdown'],$movienamearray,$torrentlinkarray);
function populateDB($year, $movienamearray, $directLinkArray)
{
    echo "came inside populateDB with year==".$year;
    for($i = 0;$i < count($movienamearray);$i++)
    {
        echo "[".$movienamearray[$i]."]"."</br>";
    }
//    print_r($movienamearray);

    $servername = "localhost";
    $username = "root";
    $password = "aftab";
    $dbname = "torrentnearyoudb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    for($i = 0;$i < count($movienamearray);$i++)
    {
//        $sql = "INSERT INTO movieTbl (year, pageLink, directLink) VALUES ('2010', 'my_pageLink', 'my_directLink')";
        $pageLink = "https://kat.cr/usearch/".str_replace(" ","%20",$movienamearray[$i])."%20".$_GET['yeardropdown']."%20".$_GET['languagedropdown'];
        $sql = "INSERT INTO movieTbl (year, pageLink, directLink) VALUES ('".  $year . "','".  $pageLink . "','" . "directLinkArray[i]" . "')";
        echo $sql;
        echo "</br>";

        if ($conn->query($sql) === TRUE)
        {
            echo "New record created successfully";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // closing the connection
    $conn->close();
}

function GetBetween($var1="",$var2="",$pool){
    $temp1 = strpos($pool,$var1)+strlen($var1);
    $result = substr($pool,$temp1,strlen($pool));
    $dd=strpos($result,$var2);
    if($dd == 0){
        $dd = strlen($result);
    }

    return substr($result,0,$dd);
}

/* Remmeber, the whole point of this is to generate the table code */
if(isset($_GET['languagedropdown']) && isset($_GET['yeardropdown']))
{
    /* wikipedia */
    switch ($_GET['languagedropdown'])
    {
        case "malayalam":
            $base = "https://en.wikipedia.org/wiki/List_of_Malayalam_films_of_";
            $url = $base.$_GET['yeardropdown'];
            break;
        case "hindi":
            $base = "https://en.wikipedia.org/wiki/List_of_Bollywood_films_of_";
            $url = $base.$_GET['yeardropdown'];
            break;
        case "english":
            $base = "https://en.wikipedia.org/wiki/List_of_American_films_of_";
            $url = $base.$_GET['yeardropdown'];
            break;
        case "tamil":
            $base = "https://en.wikipedia.org/wiki/List_of_Tamil_films_of_";
            $url = $base.$_GET['yeardropdown'];
            break;
        case "tagalog":
            $base = "https://en.wikipedia.org/wiki/List_of_Philippine_films_of_";
            $url = $base.$_GET['yeardropdown'];
            break;
        case "telugu":
            $base = "https://en.wikipedia.org/wiki/List_of_Telugu_films_of_";
            $url = $base.$_GET['yeardropdown'];
            break;
        case "kannada":
            $base = "https://en.wikipedia.org/wiki/List_of_Kannada_films_of_";
            $url = $base.$_GET['yeardropdown'];
            break;
    }

    $pattern_without_translation = "</a></i></td>";
    $pattern_with_translation = "</a></i><br />";
    $pattern_ending = "</table>";
    $moviecount = 0;
    $movienamearray = array();
    $i = 1;
    $handle = fopen($url, "r");

    if ($handle)
    {
        while (($line = fgets($handle)) !== false)
        {
            // process the line read.
            if ((strpos($line, $pattern_without_translation) !== false) || (strpos($line, $pattern_with_translation) !== false))
            {
                /* <td style="text-align:center;"><i><a href="/wiki/Marupuram_(2016_film)" title="Marupuram (2016 film)">Marupuram</a></i></td> */
                $data = GetBetween("title","</a></i></td>",$line);
                $moviename = substr($data, strpos($data, ">") + 1);

                /* otherwise the table formatting gets affected */
                if(strlen($moviename) < 50)
                    array_push($movienamearray, $moviename);

                $moviecount++;;
                $i++;
            }

            // process the line read.
            if ( ($_GET['languagedropdown'] == "malayalam") && ($moviecount > 0) && (strpos($line, $pattern_ending) !== false) )
            {
                break;
            }
        }
    }
    else
    {
        // error opening the file.
        /* to take care of what could possibly happen on Jan 1 midnight of any year, if
        a. the wikipedia guys have not updated the link
        b. someone's so jobless to be looking for movies on Jan 1 midnight when everyone's parting! */
        echo "could not find any ". $_GET['languagedropdown']." movies for the year ".$_GET['yeardropdown']." !";
        exit;
    }
    fclose($handle);
//    print_r($movienamearray);echo "</br>";echo "</br>";
//    echo "</br>";

    /* kat.cr : https://kat.cr/usearch/Monsoon%20Mangoes%20malayalam/ */
    $base = "compress.zlib://https://kat.cr/usearch/";
    $pattern_torrent_notpresent = "Nothing found!";
    $torrentlinkarray = array();
    $sizeMBarray = array();

    echo "<br/>";
//    for($i = 0;$i < count($movienamearray);$i++)
    for($i = 0;$i < 5;$i++)
    {
        /* updating the label */
        //updateLabelText
        //<script>updateLabelText(45)</script>
//        echo "<script type=\"text/javascript\">"."updateLabelText"."(".strval(count($movienamearray)-$i).");"."</script>";

        $myfile = fopen("/var/www/data/fileonserver".$_GET['randomNumber']."txt", "w") or die("Unable to open file!");
        $txt = "Finding torrent for movie ".$i." of ".count($movienamearray).". \n";
        $txt = $txt."Please do not refresh the page, check back in a couple of minutes!";
        fwrite($myfile, $txt);
        fclose($myfile);

//        echo "---------------------------------</br>";
        $url = $base.str_replace(" ","%20",$movienamearray[$i])."%20".$_GET['yeardropdown']."%20".$_GET['languagedropdown'];
//        $url = $base.str_replace(" ","%20","monsoon mangoes")."%20".$_GET['year']."%20".$_GET['language'];

        $handle = fopen($url, "r");
        if ($handle)
        {
            /* arrays for storing links and sizes */
            $torcachelinksarray_pertorrent = array();
            $sizeMBarray_pertorrent = array();

            /* Nice way to do it using file_get_html */
//            // Find all links
//            $html = file_get_html($url);
//            foreach($html->find('a') as $element)
//            {
//                if (strpos($element->href, "torcache.net/torrent") !== false)
//                {
//                    array_push($torcachelinksarray_pertorrent,$element->href);
//                }
//            }

            /* iterating to find the sizes of the torrents */
            while (($line = fgets($handle)) !== false)
            {
                /* The ones it shows under 'Showing results for' are not actual searches, so break off */
                if (strpos($line, "Showing results for") !== false)
                    break;

                /* <a data-download title="Download torrent file" href="//torcache.net/torrent/81D283993C9BEB993D567E2D8CF618A350C44FD7.torrent?title=[kat.cr]monsoon.mangoes.2016.malayalam.dvdrip.1cd.x264.aac.esubs.chaps.drc.release" class="icon16"><i class="ka ka16 ka-arrow-down"></i></a> */
                if (strpos($line, "torcache.net/torrent") !== false)
                {
                    $data = GetBetween("href=\"","\" class=\"",$line);
//                    echo $data."</br>";
                    array_push($torcachelinksarray_pertorrent,$data);
                }

                // process the line read.
                /* <td class="nobr center">800.89 <span>MB</span></td> */
                if (strpos($line, "<span>MB</span>") !== false)
                {
                    $data = GetBetween("<td class=\"nobr center\">"," <span>MB</span></td>",$line);
//                    echo $data."</br>";
                    array_push($sizeMBarray_pertorrent,$data);
                }

                /* <td class="nobr center">1.6 <span>GB</span></td> */
                if (strpos($line, "<span>GB</span>") !== false)
                {
                    $data = GetBetween("<td class=\"nobr center\">"," <span>GB</span></td>",$line);
//                    echo $data."</br>";
                    array_push($sizeMBarray_pertorrent,$data*1000);
                }
            }//finished iterating across all torrents

            //printing page summary of what's useful to me
//            print_r($torcachelinksarray_pertorrent);echo "</br>";echo "</br>";
//            print_r($sizeMBarray_pertorrent);echo "</br>";echo "</br>";

            /* iterating to find the torrent with the highest size, using only those whose minimum size is 500 MB */
            $largestsizeindex = 0;
            for($j = 0;$j < count($torcachelinksarray_pertorrent);$j++)
            {
                if($sizeMBarray_pertorrent[$j] > $sizeMBarray_pertorrent[$largestsizeindex])
                {
                    $largestsizeindex = $j;
                }
            }
            if($sizeMBarray_pertorrent[$largestsizeindex] > 500)
            {
                array_push($torrentlinkarray,$torcachelinksarray_pertorrent[$largestsizeindex]);
                array_push($sizeMBarray,$sizeMBarray_pertorrent[$largestsizeindex]);
            }
            else
            {
                array_push($torrentlinkarray,"404");
                array_push($sizeMBarray,-1);
            }
        }
        else
        {
            // error opening the file.
            array_push($torrentlinkarray,"404");
            array_push($sizeMBarray,-1);
        }
        fclose($handle);
    }//end of for loop across all movies

    //to get rid of the label
//    echo "<script type=\"text/javascript\">"."updateLabelText"."(".strval(count($movienamearray)-$i).");"."</script>";
//    print_r($torrentlinkarray);
//    print_r($sizeMBarray);

    /* populating table */
    populateDB($_GET['yeardropdown'],$movienamearray,$torrentlinkarray);

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

//            //using checkbox : <input id="cb1" type="checkbox" onchange="window.location.href='https://torcache.net/torrent/6430CFD62C88F994AC6F158AB3CD903A09EE87D7.torrent?title=[kat.cr]monsoon.mangoes.2016.malayalam.dvdrip.x264.800mb.esubs.mkv'" download>
//            $cbcode = "<label><input id=\"cb".$i."\" type=\"checkbox\" onchange=\"window.location.href='".$torrentlinkarray[$i]."'\" download>Click here for direct download</label>";
//            echo "<tr>"."<td>".$serial."</td>"."<td>".$movienamearray[$i]."</td>"."<td>"."<a href = \"" . $link . "\">Click here to visit the torrent page.</a>"."</td>"."<td>".$cbcode."</td>"."</tr>";

            //using ahref : <a href="https://torcache.net/torrent/6430CFD62C88F994AC6F158AB3CD903A09EE87D7.torrent?title=[kat.cr]monsoon.mangoes.2016.malayalam.dvdrip.x264.800mb.esubs.mkv" download>Click here</a>
            $ahrefcode = "<a href="."\""."https:".$torrentlinkarray[$i]."\""." download>Click here for direct download link</a>";
            echo "<tr>"."<td>".$serial."</td>"."<td>".$movienamearray[$i]."</td>"."<td>"."<a href = \"" . $link . "\">Click here to visit the torrent page.</a>"."</td>"."<td>".$ahrefcode."</td>"."</tr>";
        }
    }
    echo "</table>";
}
?>
