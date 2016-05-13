<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 4/28/2016
 * Time: 12:07 PM
 */
include('simple_html_dom.php');

/* search if torrent is already present for a given movie */
function searchDB($movieName, $movieLanguage, $movieYear)
{
//    echo "came inside searchDB()"."</br>";
//
//    $servername = "localhost";
//    $username = "root";
//    $password = "aftab";
//    $dbname = "torrentnearyoudb";
//
//    // Create connection
//    $conn = new mysqli($servername, $username, $password, $dbname);
//
//    // Check connection
//    if ($conn->connect_error) {
//        die("Connection failed: " . $conn->connect_error);
//    }
//
//    // select * from movieTbl where movieName = $movieName and $movieLanguage = $movieLanguage and $movieYear = $movieYear;
//    $sql = "select * from movieTbl where movieName = " ."'" .$movieName. "'" . " and " . "movieLanguage = " . "'" .$movieLanguage . "'" . " and " . "movieYear=" . "'" . $movieYear . "'";
//    echo "query to be executed == ".$sql."</br>";
//    $result = $conn->query($sql);
//
//    if ($result->num_rows > 0)
//    {
//        // output data of each row
//        $row = $result->fetch_assoc();
//        echo "link for ".$movieName." == [".$row["directLink"]."]" ."</br>";
//        if($row["directLink"] == "404")
//            return 0;
//
//        return 1;
//    }
//    else
//    {
//        return 0;
//    }
//
//    $conn->close();

    return 0;
}

//function backup_drop_create_movieTbl()
//{
//    $servername = "localhost";
//    $username = "root";
//    $password = "aftab";
//    $dbname = "torrentnearyoudb";
//
//// Create connection
//    $conn = new mysqli($servername, $username, $password, $dbname);
//// Check connection
//    if ($conn->connect_error) {
//        die("Connection failed: " . $conn->connect_error);
//    }
//
//    // take backup
//    $sql = "SHOW TABLES LIKE 'movieTbl'";
//    if(mysql_num_rows($conn->query($sql))==1)
//    {
//        echo "came inside the backup part";
//
//        // drop backupmovieTbl
//        $sql = "SHOW TABLES LIKE 'backupmovieTbl'";
//        $result = $conn->query($sql);
//        $tableExists = mysql_num_rows($result) > 0;
//        if($tableExists == true)
//        {
//            $sql = "drop table backupmovieTbl";
//            if ($conn->query($sql) === TRUE) {
//                echo "Table movieTbl dropped successfully";
//            } else {
//                echo "Error while trying to drop table: " . $conn->error;
//            }
//        }
//
//        //copy movieTbl to backupmovieTbl
//        $sql = "CREATE TABLE backupmovieTbl LIKE movieTbl";
//        if ($conn->query($sql) === TRUE) {
//            echo "Table backupmovieTbl schema created successfully";
//        } else {
//            echo "Error while trying to create schema for backupmovieTbl: " . $conn->error;
//        }
//        $sql = "INSERT INTO backupmovieTbl SELECT * FROM movieTbl";
//        if ($conn->query($sql) === TRUE) {
//            echo "Contents transferred from backupmovieTbl to movieTbl successfully!";
//        } else {
//            echo "Error while trying to copy contents from movieTbl to backupmovieTbl: " . $conn->error;
//        }
//
//        // drop movieTbl
//        $sql = "drop table movieTbl";
//        if ($conn->query($sql) === TRUE) {
//            echo "Table movieTbl dropped successfully";
//        } else {
//            echo "Error while trying to drop table: " . $conn->error;
//        }
//    }
//    else
//    {
//        echo "did not came inside the backup part";
//    }
//
//    // sql to create table
//        $sql = "CREATE TABLE movieTbl (
//    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//    movieName VARCHAR(100) NOT NULL,
//    movieLanguage VARCHAR(100) NOT NULL,
//    movieYear int NOT NULL,
//    pageLink VARCHAR(500) NOT NULL,
//    directLink VARCHAR(500) NOT NULL,
//    updateDate VARCHAR(500) NOT NULL
//    )";
//
//    if ($conn->query($sql) === TRUE) {
//        echo "Table movieTbl created successfully";
//    } else {
//        echo "Error creating table: " . $conn->error;
//    }
//
//    $conn->close();
//
//}

function dropAndCreateTable()
{
    echo "came inside the dropAndCreateTable() function";

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

    //drop table
    $sql = "drop table movieTbl";
//        echo $sql;
    if ($conn->query($sql) === TRUE)
    {
        echo "movieTbl dropped successfully";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //create movieTbl;
    // sql to create table
    $sql = "CREATE TABLE movieTbl (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    movieName VARCHAR(100) NOT NULL,
    movieLanguage VARCHAR(100) NOT NULL,
    movieYear int NOT NULL,
    pageLink VARCHAR(500) NOT NULL,
    directLink VARCHAR(500) NOT NULL,
    updateDate VARCHAR(500) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table movieTbl created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

/* inserting a new movie into the database
   - delete previous records for that movie and insert into database */
function populateDB($language, $year, $movienamearray, $directLinkArray)
{
    echo "called populateDB with language==".$language.",year==".$year;
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

    // insert operation
    $updateDate = date("l").",".date("Y-m-d");
    for($i = 0;$i < count($movienamearray);$i++)
    {
        // insert new record/movie details into database
        $pageLink = "https://kat.cr/usearch/".str_replace(" ","%20",$movienamearray[$i])."%20".$year."%20".$language;
        $sql = "INSERT INTO movieTbl (movieName, movieLanguage, movieYear, pageLink, directLink, updateDate) VALUES ('".  $movienamearray[$i] . "','".  $language . "','".  $year . "','".  $pageLink . "','" . $directLinkArray[$i] . "','" . $updateDate . "')";
        if ($conn->query($sql) === TRUE)
        {

        }
        else
        {

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

//drop and create movieTbl
dropAndCreateTable();

/* Remmeber, the whole point of this is to generate the table code */
$languagearray = array('malayalam','hindi','english','tamil','telugu','kannada','tagalog');
//$languagearray = array('english');
for($lang = 0;$lang < count($languagearray);$lang++)
{
    $language = $languagearray[$lang];
    for($year = 2010;$year <= date("Y");$year++)
//    for($year = 2014;$year <= 2016;$year++)
    {
        echo "Processing...".$language."_".$year."</br>";

        /* wikipedia */
        switch ($language)
        {
            case "malayalam":
                $base = "https://en.wikipedia.org/wiki/List_of_Malayalam_films_of_";
                $url = $base.$year;
                break;
            case "hindi":
                $base = "https://en.wikipedia.org/wiki/List_of_Bollywood_films_of_";
                $url = $base.$year;
                break;
            case "english":
                $base = "https://en.wikipedia.org/wiki/List_of_American_films_of_";
                $url = $base.$year;
                break;
            case "tamil":
                $base = "https://en.wikipedia.org/wiki/List_of_Tamil_films_of_";
                $url = $base.$year;
                break;
            case "tagalog":
                $base = "https://en.wikipedia.org/wiki/List_of_Philippine_films_of_";
                $url = $base.$year;
                break;
            case "telugu":
                $base = "https://en.wikipedia.org/wiki/List_of_Telugu_films_of_";
                $url = $base.$year;
                break;
            case "kannada":
                $base = "https://en.wikipedia.org/wiki/List_of_Kannada_films_of_";
                $url = $base.$year;
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
                if ( ($language == "malayalam") && ($moviecount > 0) && (strpos($line, $pattern_ending) !== false) )
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
            echo "could not find any ". $language." movies for the year ".$year." !";
//            exit;
        }
        fclose($handle);
        for($i = 0;$i < count($movienamearray);$i++)
        {
            $movienamearray[$i] = str_replace("</a></i><br />","",$movienamearray[$i]);
            $movienamearray[$i] = preg_replace('/\n$/','',$movienamearray[$i]);
        }

        /* kat.cr : https://kat.cr/usearch/Monsoon%20Mangoes%20malayalam/ */
        $base = "compress.zlib://https://kat.cr/usearch/";
        $pattern_torrent_notpresent = "Nothing found!";
        $torrentlinkarray = array();
        $sizeMBarray = array();

        echo "printing searchStatus"."</br>";
        for($i = 0;$i < count($movienamearray);$i++)
        {
            $searchStatus = searchDB($movienamearray[$i],$language,$year);
            echo $searchStatus;

            /* if movie was never searched(notfound) or was searched but torrent was not found(404), then hit kat.cr again */
            if($searchStatus == 0)
            {
                $url = $base.str_replace(" ","%20",$movienamearray[$i])."%20".$year."%20".$language;

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
                            array_push($torcachelinksarray_pertorrent,$data);
                        }

                        // process the line read.
                        /* <td class="nobr center">800.89 <span>MB</span></td> */
                        if (strpos($line, "<span>MB</span>") !== false)
                        {
                            $data = GetBetween("<td class=\"nobr center\">"," <span>MB</span></td>",$line);
                            array_push($sizeMBarray_pertorrent,$data);
                        }

                        /* <td class="nobr center">1.6 <span>GB</span></td> */
                        if (strpos($line, "<span>GB</span>") !== false)
                        {
                            $data = GetBetween("<td class=\"nobr center\">"," <span>GB</span></td>",$line);
                            array_push($sizeMBarray_pertorrent,$data*1000);
                        }
                    }//finished iterating across all torrents

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
                        array_push($torrentlinkarray,"https:".$torcachelinksarray_pertorrent[$largestsizeindex]);
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
            }
        }//end of for loop across all movies

        /* populating table */
        populateDB($language,$year,$movienamearray,$torrentlinkarray);
    }
}
?>
