<?php
	require('db.php');
	include("auth.php");

	function splitURL($givenurl) {
		//echo $givenurl['url'];
		//echo $givenurl['tags'];
		return array("https://img.youtube.com/vi/" . explode("/",$givenurl['url'])[3] . "/0.jpg", $givenurl['title'], $givenurl['tags']);
	}

	function getVideos1() {
	    $weight1 = $_SESSION['weight'];
	    $weights1 = $_SESSION['weights'];
	    $size = sizeof($weights1);
	    if ($weight1 == "") {
	    	return array(splitURL($weights1[rand(0, $size-1)]), splitURL($weights1[rand(0, $size-1)]), splitURL($weights1[rand(0, $size-1)]), splitURL($weights1[rand(0, $size-1)]), splitURL($weights1[rand(0, $size-1)]), splitURL($weights1[rand(0, $size-1)]));
	    } else {
	    	$scorevideos = [];
	    	foreach ($weights1 as $a1) {
	    		$score = 0;
	    		$a1 = str_replace("'","",$a1);;
	    		$ts = $a1["tags"];
	    		$ts = str_replace("[","",$ts);
				$ts = str_replace("]","",$ts);
				$ts = str_replac("'","",$ts);
				$ts = str_replace('"',"",$ts);
				$tagarray = explode(",", $ts);
	    		foreach ($tagarray as $tag) {
	    			$www = (array)json_decode($weight1);
	    			//echo $weight1;
	    			//echo $www["bing"];
	    			//echo $tag;
					if (isset($www[strtolower($tag)])) {
						//echo $score;
						$score = $score + $www[strtolower($tag)];
					}
	    		}
	    		$scorevideos[json_encode($a1)] = $score;
	    	}
	    	arsort($scorevideos);
	    	$c = 0;
	    	$r = [];
	    	foreach($scorevideos as $x => $x_value) {
	    		if ($c >= 6) {
	    			break;
	    		}
	    		//echo $x;
			    $r[$c] = (array)json_decode($x);
			    $c = $c + 1;
			}
	    	return array(splitURL($r[0]), splitURL($r[1]), splitURL($r[2]), splitURL($r[3]), splitURL($r[4]), splitURL($weights1[rand(0, $size-1)]));
	    }
	}

	$tags = $_POST['tags'];
	$tags = str_replace("[","",$tags);
	$tags = str_replace("]","",$tags);
	$tags = str_replace("'","",$tags);
	$array = explode(",", $tags);

	$weight = $_SESSION['weight'];
	$weights = $_SESSION['weights'];
	$weight = (array)json_decode($weight);


	foreach ($array as $a) {
		if (isset($weight[strtolower($a)])) {
		    $weight[strtolower($a)] = $weight[strtolower($a)] + 1;
		} else {
			$weight[strtolower($a)] = 1;
		}
	}

	$weight = json_encode($weight);
	$_SESSION['weight'] = $weight;
	$username1 = $_SESSION['username'];
	//echo $weight;
	//echo $username1;

	try {
		$query = "UPDATE `user` SET weight='$weight' WHERE username='$username1'";
	    $statement = $conn->prepare($query);
		$statement->execute();

	}catch(PDOException $e)
	{
		//echo "Error: " . $e->getMessage();
		//echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
	}

	$videosexpected = getVideos1();
	foreach ($videosexpected as $v) {
		echo $v[0] . "\n";
		echo $v[1] . "\n";
		echo $v[2] . "\n";
	}


?>