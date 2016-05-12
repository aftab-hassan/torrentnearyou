<?php
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

$sql = "SELECT * FROM movieTbl where movieName='"."Bodyguard"."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " movieName: " . $row["movieName"].  " movieLanguage: " . $row["movieLanguage"].  " movieYear: " . $row["movieYear"].  " pageLink: " . $row["pageLink"]. " directLink: " . $row["directLink"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>