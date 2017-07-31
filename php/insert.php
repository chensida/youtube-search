<?php
ini_set("allow_url_fopen", 1);

if (isset($_POST['submitted'])) {
	$dbcon = mysqli_connect("130.211.236.143:3306", "root", "p@ssw0rd", "video");
    if (!$dbcon) {
        echo "<script type='text/javascript'>alert('not connected');</script>";
    }
    echo "<script type='text/javascript'>alert('connected');</script>";

	$fname = $_POST['videoid'];
	$json_url = "https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,player,recordingDetails,statistics,status,topicDetails&id={$fname}&key=AIzaSyAmcpGPaTlwpxtW064ud3fDb7cP6Q7w9qk";
	$json = file_get_contents($json_url);
	$obj = json_decode($json);

	$date = str_replace("'","''",$obj->items[0]->snippet->publishedAt);
	$title = str_replace("'","''",$obj->items[0]->snippet->title);
	$description = str_replace("'","''",$obj->items[0]->snippet->description);
	$channelTitle = str_replace("'","''",$obj->items[0]->snippet->channelTitle);
	$tags = str_replace("'","''",json_encode($obj->items[0]->snippet->tags));
	$duration = str_replace("'","''",$obj->items[0]->contentDetails->duration);
	$topicDetails = str_replace("'","''",json_encode($obj->items[0]->topicDetails->topicCategories));

	$sqlinsert = "INSERT INTO videos (title, date, channel, tags, duration, topicDetails) VALUES ('$title', '$date', '$channelTitle', '$tags', '$duration', '$topicDetails')";

	echo "<head>";
	print_r($sqlinsert);
	echo "</head>";

	if (!mysqli_query($dbcon, $sqlinsert)) {
		die('error inserting records');
	}
	//$newrecord = "1 record inserted";
}

?>