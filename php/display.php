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

echo "<table border='1'>";
echo "<tr>
		<th>url</th>
		<th>title</th>
		<th>date</th>
		<th>description</th>
		<th>channel</th>
		<th>tags</th>
		<th>duration</th>
		<th>topicDetails</th>
	</tr>"; 

foreach ($all as $data) {
	echo "<tr><td>" . $data['url'] . "</td><td>" . $data['title'] . "</td><td>" . $data['date'] . "</td><td>" . $data['description'] . "</td><td>" . $data['channel'] . "</td><td>" . $data['tags'] . "</td><td>" . $data['duration'] . "</td><td>" . $data['topicDetails'] . "</td></tr>"; 
}

echo "</table>"; 
?>