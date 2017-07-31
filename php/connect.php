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

	foreach ($all as $data) {
		echo $data["title"]."<br>";
	}
?>