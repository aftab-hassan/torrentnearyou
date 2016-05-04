<html>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<h1 align="center">Articles You</></h1>
<p align="center">See which articles are near you ...</p>

<body>
<form method="get" action="indexFileWritingProblems8.php">
    <select name="language">
        <option value = "english">English</option>
        <option value = "tagalog">Tagalog</option>
    </select>
    </br>

    <select name="year">
        <option value="2010">2010</option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
    </select>

    <label id="mylabel" name="mylabel">-1</label>
    <input type="submit" value="submit">
</form>
</body>

<script type="text/javascript" src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    var clearTimeoutID = 0;
    var ajaxFunction = function() {
        $.get(
            "fileonserver.txt",
            function(data) {
                console.log("inside the get with data == ..."+data);
                $('#mylabel').html(data);

                if(data == "end of data")
                    clearTimeout(clearTimeoutID);
                else
                    clearTimeoutID = setTimeout(ajaxFunction,1000);
            }
        );
    }
    $(document).ready(ajaxFunction());
</script>


</html>

<?php
if(!(isset($_GET['language']) && isset($_GET['year'])))
{
    echo "came inside the if condition!";
    for($i = 0;$i < 30;$i++)
    {
        echo "i==".$i;

        $myfile = fopen("fileonserver.txt", "w") or die("Unable to open file!");
        $txt = "now at movie no.".$i;
        fwrite($myfile, $txt);
        fclose($myfile);

//        sleep(1);

        for($k = 0;$k < 250;$k++)
        {
            for($j = -30000;$j < 30000; $j++){}
            for($j = -30000;$j < 30000; $j++){}
        }
    }
}
else
{
    echo "did not come inside the if condition!";
}
?>
