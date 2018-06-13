<?php

$servername = "mysql:unix_socket=/cloudsql/video-search-and-save:us-central1:youtube-video-search-and-save;dbname=video";//getenv("MYSQL_DSN");
$username = "root";//getenv("MYSQL_USER");
$password = "p@ssw0rd";//getenv("MYSQL_PASSWORD");
//echo "111";
// Check connection
try {
$conn = new PDO($servername, $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "Connected successfully"; 
}
catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
?>