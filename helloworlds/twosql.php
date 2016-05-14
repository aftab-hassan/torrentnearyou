<?php
/**
 * Created by PhpStorm.
 * User: aftab
 * Date: 5/14/2016
 * Time: 9:09 AM
 */

function renameTable()
{
    echo "came inside the renameTable() function";

    $txt = "came inside the renameTable() function";
    addDebug($txt);

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

    //rename table
    $sql = "drop table movieTbl;RENAME TABLE  maintenancemovieTbl TO movieTbl";
//        echo $sql;
    if ($conn->query($sql) === TRUE)
    {
        echo "maintenancemovieTbl renamed to movieTbl successfully";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $txt = "maintenancemovieTbl renamed to movieTbl successfully";
    addDebug($txt);

    // closing the connection
    $conn->close();
}

renameTable();

?>