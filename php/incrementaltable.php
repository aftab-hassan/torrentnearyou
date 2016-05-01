<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<script>
    function myFunction()
    {
        document.getElementById("mytable").deleteRow(0);
    }
</script>

<body>
    <button onclick="myFunction()">Click me</button>
</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 4/30/2016
 * Time: 6:04 PM
 */
echo "<html>";
echo "<body>";
echo "<table id=\"mytable\">";
echo "<tr><td>1</td><td>2</td><td>3</td></tr>";
echo "<tr><td>4</td><td>5</td><td>6</td></tr>";
echo "<tr><td>7</td><td>8</td><td>9</td></tr>";
echo "<tr><td>10</td><td>11</td><td>12</td></tr>";
echo "<tr><td>13</td><td>14</td><td>15</td></tr>";
echo "</table>";
echo "</body>";
echo "</html>";
?>

<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title></title>-->
<!--</head>-->
<!--<body>-->
<!---->
<!--</body>-->
<!--</html>-->
