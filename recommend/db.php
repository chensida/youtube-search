<?php

$servername = getenv("MYSQL_DSN");
$username = getenv("MYSQL_USER");
$password = getenv("MYSQL_PASSWORD");
//alert("1111");
// Check connection
try {
$conn = new PDO("mysql:host=$servername;dbname=video", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "Connected successfully"; 
}
catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
?>
