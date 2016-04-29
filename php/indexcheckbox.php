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
<form method="get" action="indexcheckbox.php">
    <select name="language">
<!--        <option value = "tagalog">Tagalog</option>-->
        <option value = "malayalam">Malayalam</option>
        <option value = "tamil">Tamil</option>
        <option value = "hindi">Hindi</option>
        <option value = "english">English</option>
        <option value = "tagalog">Tagalog</option>
    </select>
    </br>

    <select name="year">
        <option value="2010">2010</option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2020">2021</option>
        <option value="2020">2022</option>
    </select>

    <input type="submit" value="submit">
</form>
</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 4/28/2016
 * Time: 12:07 PM
 */
include('simple_html_dom.php');

function GetBetween($var1="",$var2="",$pool){
    $temp1 = strpos($pool,$var1)+strlen($var1);
    $result = substr($pool,$temp1,strlen($pool));
    $dd=strpos($result,$var2);
    if($dd == 0){
        $dd = strlen($result);
    }

    return substr($result,0,$dd);
}

if(isset($_GET['language']) && isset($_GET['year']))
{
    /* wikipedia */
    switch ($_GET['language'])
    {
        case "malayalam":
            $base = "https://en.wikipedia.org/wiki/List_of_Malayalam_films_of_";
            $url = $base.$_GET['year'];
            break;
        case "hindi":
            $base = "https://en.wikipedia.org/wiki/List_of_Bollywood_films_of_";
            $url = $base.$_GET['year'];
            break;
        case "english":
            $base = "https://en.wikipedia.org/wiki/";
            $url = $base.$_GET['year']."_in_film";
            break;
        case "tamil":
            $base = "https://en.wikipedia.org/wiki/List_of_Tamil_films_of_";
            $url = $base.$_GET['year'];
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
    print_r($movienamearray);
    echo "</br>";

    /* kat.cr : https://kat.cr/usearch/Monsoon%20Mangoes%20malayalam/ */
    $base = "compress.zlib://https://kat.cr/usearch/";
    $pattern_torrent_notpresent = "Nothing found!";
    $torrentlinkarray = array();

//    for($i = 0;$i < count($movienamearray);$i++)
//    {
//        $url = $base.str_replace(" ","%20",$movienamearray[$i])."%20".$_GET['year']."%20".$_GET['language'];
        $url = $base.str_replace(" ","%20","monsoon mangoes")."%20".$_GET['year']."%20".$_GET['language'];

        $handle = fopen($url, "r");
        if ($handle)
        {
            /* arrays for storing links and sizes */
            $torcachelinksarray = array();
            $sizeMBarray = array();

//            // Find all links
//            $html = file_get_html($url);
//            foreach($html->find('a') as $element)
//            {
//                if (strpos($element->href, "torcache.net/torrent") !== false)
//                {
//                    array_push($torcachelinksarray,$element->href);
//                }
//            }

            /* iterating to find the sizes of the torrents */
            while (($line = fgets($handle)) !== false)
            {
                if (strpos($line, "torcache.net/torrent") !== false)
                {
                    array_push($torcachelinksarray,$line);
                }

                // process the line read.
                //<td class="nobr center">797.92 <span>MB</span></td>
                if (strpos($line, "<span>MB</span>") !== false)
                {
                    echo $line;
//                    array_push($sizeMBarray, substr(0,-2,$line));
                }

                if (strpos($line, "<span>GB</span>") !== false)
                {
                    echo $line*1000;
//                    array_push($sizeMBarray, substr(0,-2,$line*1000));
                }
            }
        }
        else
        {
            // error opening the file.
            array_push($torrentlinkarray,"404");
        }
        fclose($handle);
        print_r($torcachelinksarray);echo "</br>";
        print_r($sizeMBarray);echo "</br>";
//    }

//    /* putting it in a table */
//    echo "<table width=100% border=1 cellspacing=0 cellpadding=0>";
//    echo "<tr><th>Serial</th><th>Movie</th><th>Download Torrent?</th></tr>";
//    for($i = 0;$i < count($torrentlinkarray);$i++)
//    {
//        if($torrentlinkarray[$i] == "404")
//            echo "<tr>"."<td>".$i."</td>"."<td>".$movienamearray[$i]."</td>"."<td>"."torrent not present"."</td>"."</tr>";
//
//        else
//        {
//            $link=$torrentlinkarray[$i];
//            echo "<tr>"."<td>".$i."</td>"."<td>".$movienamearray[$i]."</td>"."<td>"."<a href = \"" . $link . "\">Click here to visit the torrent page.</a>"."</td>"."</tr>";
//        }
//    }
//    echo "</table>";
}
?>
