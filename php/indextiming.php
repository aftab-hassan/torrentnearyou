<html>

<body>
<form method="get" action="indextiming.php">
    <input type="text" name="myTextbox" id="myTextbox">
    <label id="myLabel"></label>
</form>
</body>
<script>
    function updateLabelText(val)
    {
        alert("came inside the javascript function with val == ..."+val);
        document.getElementById("myLabel").innerHTML = val;
    }
</script>

</html>

<?php
if(isset($_GET['myTextbox']))
{
    for($i = 10;$i > 0;$i--)
    {
        //to consume time
        for($j = 30000;$j>=-30000;$j--){console.log("hello1");}
        for($j = 30000;$j>=-30000;$j--){console.log("hello2");}

        /* updating the label */
        //<script>updateLabelText(45)</script>
        echo "<script type=\"text/javascript\">"."updateLabelText"."(".strval($i).");"."</script>";
        echo "$i";
    }
}
?>
