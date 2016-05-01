<html>
<head>
    <title>This is the title of the page</title>
</head>
<body>
    <label id="remainingMovieCountLbl">Default label</label>
</body>
<script>
    function updateLabelText(remainingMovieCount)
    {
        console.log("came inside updateLabelText with the value : "+remainingMovieCount);
        alert("break...");
        document.getElementById("remainingMovieCountLbl").innerHTML = "Please do not refresh the page ! Finding torrents for " + remainingMovieCount + " more movies. Check back in a couple of minutes !";
    }

//    for(var i = 0;i<10;i++)
//    {
//        updateLabelText(i);
//    }
</script>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 5/1/2016
 * Time: 3:07 PM
 */

for($i = 0;$i < 10;$i++)
{
//    echo "<script type=\"text/javascript\">"."updateLabelText"."(".$i.");"."</script>";
    echo "<script type=\"text/javascript\">"."updateLabelText"."(".$i.");"."</script>";
}

?>