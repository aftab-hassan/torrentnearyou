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

// sql to create table
$sql = "CREATE TABLE movieTbl (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
movieName VARCHAR(100) NOT NULL,
movieLanguage VARCHAR(100) NOT NULL,
movieYear int NOT NULL,
pageLink VARCHAR(500) NOT NULL,
directLink VARCHAR(500) NOT NULL,
updateDate VARCHAR(500) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table movieTbl created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
