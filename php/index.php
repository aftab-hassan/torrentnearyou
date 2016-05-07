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

/* gets the data from a URL */
function get_data($url) {
    $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;

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
    $base = "https://kat.cr/usearch/";
    $pattern_torrent_notpresent = "Nothing found!";
    $torrentlinkarray = array();
    $sizeMBarray = array();

    echo "<br/>";
    for($i = 0;$i < count($movienamearray);$i++)
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

        $returned_content = get_data($url);
        echo $url;
        echo "\n";
        echo strlen($returned_content);
        echo "\n";

    }//end of for loop across all movies
}
?>
