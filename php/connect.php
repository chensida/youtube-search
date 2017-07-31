<?php

	$dsn = "mysql:unix_socket=/cloudsql/video-search-and-save:us-central1:youtube-video-search-and-save;dbname=video";
	$user = "root";
	$password = "p@ssw0rd";
	if (!isset($dsn, $user) || false == $password) {
		throw new Exception('not set');
	}

	$db = new PDO($dsn, $user, $password);

	$statement = $db->prepare("select * from videos");
	$statement->execute();
	$all = $statement->fetchAll();

	foreach ($all as $data) {
		echo $data["title"]."<br>";
	}
?>