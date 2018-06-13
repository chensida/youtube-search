<?php

$dsn = "mysql:unix_socket=/cloudsql/video-search-and-save:us-central1:youtube-video-search-and-save;dbname=video";//getenv("MYSQL_DSN");
$user = "root";//getenv("MYSQL_USER");
$password = "p@ssw0rd";//getenv("MYSQL_PASSWORD");
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
	$url = $data['url'];
	echo "<tr><td><a href='{$url}'>" . $data['url'] . "</a></td><td>" . $data['title'] . "</td><td>" . $data['date'] . "</td><td>" . $data['description'] . "</td><td>" . $data['channel'] . "</td><td>" . $data['tags'] . "</td><td>" . $data['duration'] . "</td><td>" . $data['topicDetails'] . "</td></tr>"; 
}

echo "</table>"; 
?>