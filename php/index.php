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

<!--    <br><label id="mylabel" name="mylabel"></label>-->
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

//    function updateLabelText(remainingMovieCount)
//    {
//        console.log("came inside updateLabelText with the value : "+remainingMovieCount);
//        alert("hello");
//
//        if(remainingMovieCount > 0)
//        {
//            if(remainingMovieCount  == 1)
//                document.getElementById("remainingMovieCountLbl").innerHTML = "Please do not refresh the page ! Finding torrents for " + remainingMovieCount + " more movie. Check back shortly !";
//            else
//                document.getElementById("remainingMovieCountLbl").innerHTML = "Please do not refresh the page ! Finding torrents for " + remainingMovieCount + " more movies. Check back in a couple of minutes !";
//        }
//        else
//            document.getElementById("remainingMovieCountLbl").innerHTML = "";
//    }
</script>

<!--<script type="text/javascript" src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
<!--<script type="text/javascript">-->
<!--    var clearTimeoutID = 0;-->
<!--    var randomNumber = document.getElementById('randomNumber').value;-->
<!--    console.log("randomNumber value == "+randomNumber);-->
<!--    var ajaxFunction = function() {-->
<!--        $.get(-->
<!--            "iretriever.php",-->
<!--            {randomNumber : randomNumber},-->
<!--            function(data)-->
<!--            {-->
<!--                console.log("retrieved data from iretriever.php == "+data+", length=="+data.length);-->
<!---->
<!--                if(data.length > 0)-->
<!--                {-->
<!--                    document.getElementById("languagedropdown").disabled=true;-->
<!--                    document.getElementById("yeardropdown").disabled=true;-->
<!--                    document.getElementById("submit").disabled=true;-->
<!---->
<!--                    document.getElementById("languagedropdown").style="background-color:#d3d3d3";-->
<!--                    document.getElementById("yeardropdown").style="background-color:#d3d3d3";-->
<!--                }-->
<!---->
<!--                $('#mylabel').html(data);-->
<!---->
<!--                if(data == "end of data")-->
<!--                {-->
<!--                    document.getElementById("languagedropdown").disabled=false;-->
<!--                    document.getElementById("yeardropdown").disabled=false;-->
<!--                    document.getElementById("submit").disabled=false;-->
<!---->
<!--                    clearTimeout(clearTimeoutID);-->
<!--                }-->
<!--                else-->
<!--                    clearTimeoutID = setTimeout(ajaxFunction,1000);-->
<!--            }-->
<!--        );-->
<!--    }-->
<!---->
<!--    $(document).ready(ajaxFunction);-->
<!--    //    $(document).ready($("submit").click(ajaxFunction));-->
<!--    //    $(document).ready($("submit").click(function(){-->
<!--    //        $.get(-->
<!--    //            "iretriever.php",-->
<!--    //            {randomNumber : randomNumber},-->
<!--    //            function(data) {-->
<!--    //                console.log("retrieved data from iretriever.php == "+data);-->
<!--    //                $('#mylabel').html(data);-->
<!--    //-->
<!--    //                if(data == "end of data")-->
<!--    //                    clearTimeout(clearTimeoutID);-->
<!--    //                else-->
<!--    //                    clearTimeoutID = setTimeout(ajaxFunction,1000);-->
<!--    //            }-->
<!--    //        );-->
<!--    //    }))-->
<!--</script>-->

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
        $directLinkarray = array();

        // output data of each row
        $row = $result->fetch_assoc();
        array_push($movienamearray,$row["movieName"]);
        array_push($pageLinkarray,$row["pageLink"]);
        array_push($directLinkarray,$row["directLink"]);
    }
//    else
//    {
//        echo "0 results";
//    }
    $conn->close();

    print_r($movienamearray); echo "</br>";
    print_r($pageLinkarray); echo "</br>";
    print_r($directLinkarray); echo "</br>";
}
?>