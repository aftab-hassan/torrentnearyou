<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
echo "Hello World!";

#$homepage = file_get_contents('https://en.wikipedia.org/wiki/List_of_Malayalam_films_of_2016');
#echo $homepage;

$array1 = array(1, 2, 3, 4, 5);
$a=count($array1);
echo "<table border=1><tr><th>Array1</th><th>Checkboxes</th></tr>";

for($i=0;$i<$a;$i++)
{
    echo "<tr><td>".$array1[$i]."</td>";
    echo '<td><input type="checkbox" name="checkbox[]" value="" id="checkbox"></td>';
}

echo "</table>";
?>

</body>
</html>