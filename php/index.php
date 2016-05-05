<html>

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
    </select>
    <!--    </br>-->

    <select name="yeardropdown" id="yeardropdown">
    </select>

    <input type="hidden" name="randomNumber" id="randomNumber" value="<?php echo mt_rand(); ?>" />

    <input type="submit" name="submit" id="submit" value="submit">

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
    $("#").remove("myTable");
    var clearTimeoutID = 0;
    var randomNumber = document.getElementById('randomNumber').value;
    console.log("randomNumber value == "+randomNumber);
    var ajaxFunction = function() {
        $.get(
            "iretriever.php",
            {randomNumber : randomNumber},
            function(data) {
                console.log("retrieved data from iretriever.php == "+data);
                $('#mylabel').html(data);

                if(data == "end of data")
                    clearTimeout(clearTimeoutID);
                else
                    clearTimeoutID = setTimeout(ajaxFunction,1000);
            }
        );
    }

    $(document).ready(ajaxFunction());
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
function GetBetween($var1="",$var2="",$pool){
    $temp1 = strpos($pool,$var1)+strlen($var1);
    $result = substr($pool,$temp1,strlen($pool));
    $dd=strpos($result,$var2);
    if($dd == 0){
        $dd = strlen($result);
    }

    return substr($result,0,$dd);
}

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
            $base = "https://en.wikipedia.org/wiki/";
            $url = $base.$_GET['yeardropdown']."_in_film";
            break;
        case "tamil":
            $base = "https://en.wikipedia.org/wiki/List_of_Tamil_films_of_";
            $url = $base.$_GET['yeardropdown'];
            break;
        case "tagalog":
            $base = "https://en.wikipedia.org/wiki/List_of_Philippine_films_of_";
            $url = $base.$_GET['year'];
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
                $data = GetBetween("title","</a></i></td>",$line);
                $moviename = substr($data, strpos($data, ">") + 1);
                array_push($movienamearray, $moviename);

                $moviecount++;;
                $i++;
            }

            // process the line read.
            if ( ($moviecount > 0) && (strpos($line, $pattern_ending) !== false) )
            {
                break;
            }
        }
    }
    else
    {
        // error opening the file.
        echo "could not open the wikipedia URL!";
    }
    fclose($handle);
    //print_r($movienamearray);

    /* kat.cr : https://kat.cr/usearch/Monsoon%20Mangoes%20malayalam/ */
    $base = "https://kat.cr/usearch/";
    $pattern_torrent_notpresent = "Nothing found!";
    $torrentlinkarray = array();

    for($i = 0;$i < count($movienamearray);$i++)
    {
        $myfile = fopen("/var/www/data/fileonserver".$_GET['randomNumber']."txt", "w") or die("Unable to open file!");
        $txt = "Finding torrent for movie ".$i." of ".count($movienamearray).". \n";
        $txt = $txt."Please do not refresh the page, check back in a couple of minutes!";
        fwrite($myfile, $txt);
        fclose($myfile);

        $url = $base.str_replace(" ","%20",$movienamearray[$i])."%20".$_GET['yeardropdown']."%20".$_GET['languagedropdown'];

        $handle = fopen($url, "r");
        if ($handle)
        {
            array_push($torrentlinkarray,$url);
        }
        else
        {
            // error opening the file.
            array_push($torrentlinkarray,"404");
        }
        fclose($handle);
    }
    $myfile = fopen("/var/www/data/fileonserver".$_GET['randomNumber']."txt", "w") or die("Unable to open file!");
    $txt = "end of data";
    fwrite($myfile, $txt);
    fclose($myfile);
    //print_r($torrentlinkarray);

    /* putting it in a table */
    echo "<table name=\"myTable\" id=\"myTable\" width=100% border=1 cellspacing=0 cellpadding=0>";
    echo "<tr><th>Serial</th><th>Movie</th><th>Download Torrent?</th></tr>";
    for($i = 0;$i < count($torrentlinkarray);$i++)
    {
        if($torrentlinkarray[$i] == "404")
            echo "<tr>"."<td>".($i+1)."</td>"."<td>".$movienamearray[$i]."</td>"."<td>"."torrent not present"."</td>"."</tr>";

        else
        {
            $link=$torrentlinkarray[$i];
            echo "<tr>"."<td>".($i+1)."</td>"."<td>".$movienamearray[$i]."</td>"."<td>"."<a href = \"" . $link . "\">Click here to visit the torrent page.</a>"."</td>"."</tr>";
        }
    }
    echo "</table>";
}
?>
