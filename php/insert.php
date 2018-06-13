<?php
ini_set("allow_url_fopen", 1);

if (isset($_POST['submitted'])) {

	$dsn = "mysql:unix_socket=/cloudsql/video-search-and-save:us-central1:youtube-video-search-and-save;dbname=video";//getenv("MYSQL_DSN");
	$user = "root";//getenv("MYSQL_USER");
	$password = "p@ssw0rd";//getenv("MYSQL_PASSWORD");
	if (!isset($dsn, $user) || false == $password) {
		throw new Exception('not set');
	}

	$dbcon = new PDO($dsn, $user, $password);

	$fname = $_POST['videoid'];
	$json_url = "https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,player,recordingDetails,statistics,status,topicDetails&id={$fname}&key=AIzaSyAmcpGPaTlwpxtW064ud3fDb7cP6Q7w9qk";
	$json = file_get_contents($json_url);
	$obj = json_decode($json);

	$url = "https://youtu.be/{$fname}";
	$date = str_replace("'","''",$obj->items[0]->snippet->publishedAt);
	$title = str_replace("'","''",$obj->items[0]->snippet->title);
	$description = str_replace("'","''",$obj->items[0]->snippet->description);
	$channelTitle = str_replace("'","''",$obj->items[0]->snippet->channelTitle);
	$tags = str_replace("'","''",json_encode($obj->items[0]->snippet->tags));
	$duration = str_replace("'","''",$obj->items[0]->contentDetails->duration);
	$topicDetails = str_replace("'","''",json_encode($obj->items[0]->topicDetails->topicCategories));

	$sqlinsert = "INSERT INTO videos (url, title, date, channel, tags, duration, topicDetails) VALUES ('$url', '$title', '$date', '$channelTitle', '$tags', '$duration', '$topicDetails')";

	try {
		$statement = $dbcon->prepare($sqlinsert);
		$statement->execute();
	} catch(PDOException $e) {
        echo $e->getMessage();
    }
}

?>