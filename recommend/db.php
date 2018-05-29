<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/

$servername = "130.211.236.143";
$username = "root";
$password = "p@ssw0rd";
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