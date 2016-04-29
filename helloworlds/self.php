<html>
<body>

<form action="self.php" method="get">
    Name: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
    <input type="submit" name="submit">
</form>

</body>
</html>

<?php

echo '<form action="self.php" method="get">';
if(isset($_GET['name']))
{
    $array1 = array(1, 2, 3, 4, 5);
    $a=count($array1);
    echo "<table width=100% border=1 cellspacing=0 cellpadding=0><tr><th>Array1</th><th>Array2</th><th>Checkboxes</th></tr>";

    for($i=0;$i<$a;$i++)
    {
        echo "<tr><td>".$array1[$i]."</td>";
        echo "<td>".$array1[$i]."</td>";
        echo '<td><input type="checkbox" name="checkbox[]" value="" id="checkbox"></td>';
        echo '</tr>';
    }

    echo "</table>";

    echo '<input type="submit" name="submit2">';
}
echo '</form>';

if(isset($_GET['submit2']))
{
    echo "pressed the second submit button";
}
?>
