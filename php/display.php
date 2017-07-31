<?php

$dsn = getenv("MYSQL_DSN");
$user = getenv("MYSQL_USER");
$password = getenv("MYSQL_PASSWORD");
if (!isset($dsn, $user) || false == $password) {
	throw new Exception('not set');
}

$db = new PDO($dsn, $user, $password);

$statement = $db->prepare("select * from videos");
$statement->execute();
$all = $statement->fetchAll();

echo "<table>";
echo "<tr><td>title</td><td>date</td><td>description</td><td>channel</td><td>tags</td><td>duration</td><td>topicDetails</td></tr>"; 

foreach ($all as $data) {
	echo "<tr><td>" . $row['title'] . "</td><td>" . $row['date'] . "</td><td>" . $row['description'] . "</td><td>" . $row['channel'] . "</td><td>" . $row['tags'] . "</td><td>" . $row['duration'] . "</td><td>" . $row['topicDetails'] . "</td></tr>"; 
}

echo "</table>"; 
?>