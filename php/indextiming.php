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
<form method="get" action="indextiming.php">
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

    <input type="submit" value="submit">

    <label id="remainingMovieCountLbl"></label>
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
        alert("came inside the javascript function...");

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
    echo "<br/>";
    for($i = 10;$i > 0;$i--)
    {
        for($j = 30000;$j>=-30000;$j--){console.log("hello1");}
        for($j = 30000;$j>=-30000;$j--){console.log("hello2");}
        for($j = 30000;$j>=-30000;$j--){console.log("hello3");}

        /* updating the label */
        //<script>updateLabelText(45)</script>
        echo "<script type=\"text/javascript\">"."updateLabelText"."(".strval($i).");"."</script>";
    }//end of for loop across all movies

    //to get rid of the label
    echo "<script type=\"text/javascript\">"."updateLabelText"."(".strval($i).");"."</script>";
}
?>
