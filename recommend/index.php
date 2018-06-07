<?php

include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html lang="en">
    <head>		
        <title>Video Recommendation</title>
        <meta charset="UTF-8" />					
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Interesting videos!" />
        <style>
            body {
                font-family: "Lato", sans-serif;
            }

            .sidenav {
                height: 100%;
                width: 200px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                padding-top: 20px;
            }

            .sidenav a {
                padding: 6px 6px 6px 32px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
            }

            .sidenav a:hover {
                color: #f1f1f1;
            }

            .main {
                margin-left: 200px; /* Same as the width of the sidenav */
            }

            @media screen and (max-height: 450px) {
              .sidenav {padding-top: 15px;}
              .sidenav a {font-size: 18px;}
            }
        </style>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
    </head>
    <?php
		require('db.php');

		function splitURL($givenurl) {
			//echo $givenurl['url'];
			//echo $givenurl['tags'];
			return array("https://img.youtube.com/vi/" . explode("/",$givenurl['url'])[3] . "/0.jpg", $givenurl['title'], $givenurl['tags']);
		}

		function getVideos() {
		    $weight1 = $_SESSION['weight'];
		    $weights1 = $_SESSION['weights'];
		    $size = sizeof($weights1);
		    if ($weight1 == "") {
		    	return array(splitURL($weights1[rand(0, $size-1)]), splitURL($weights1[rand(0, $size-1)]), splitURL($weights1[rand(0, $size-1)]), splitURL($weights1[rand(0, $size-1)]), splitURL($weights1[rand(0, $size-1)]), splitURL($weights1[rand(0, $size-1)]));
		    } else {
		    	$scorevideos = [];
		    	foreach ($weights1 as $a1) {
		    		$score = 0;
		    		//$a1 = str_replace("'","",$a1);;
		    		$ts = $a1["tags"];
		    		$ts = str_replace("[","",$ts);
					$ts = str_replace("]","",$ts);
					$ts = str_replace("'","",$ts);
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
	?>
    <body>
        <header>
            <h1 class="w100 text-center"><a href="index.php">Recommend youtube videos</a></h1>
            <h3 class="w50 text-center"><a href="logout.php">Logout</a></h3>
        </header>

        <div class="sidenav">
        <?php 
        	$videos = getVideos();
        ?>
          <a class="row">
          	<p tag=<?php echo '"' . str_replace('"', "'", str_replace("'", '', $videos[0][2])) . '"'; ?>> <?php echo $videos[0][1]; ?> </p>
            <img src="<?php echo $videos[0][0]; ?>" style="width:100%">
          </a>
          <a class="row">
            <p tag=<?php echo '"' . str_replace('"', "'", str_replace("'", '', $videos[1][2])) . '"'; ?>> <?php echo $videos[1][1]; ?> </p>
            <img src="<?php echo $videos[1][0]; ?>" style="width:100%">
          </a> 
          <a class="row">
            <p tag=<?php echo '"' . str_replace('"', "'", str_replace("'", '', $videos[2][2])) . '"'; ?>> <?php echo $videos[2][1]; ?> </p>
            <img src="<?php echo $videos[2][0]; ?>" style="width:100%">
          </a>
          <a class="row">
            <p tag=<?php echo '"' . str_replace('"', "'", str_replace("'", '', $videos[3][2])) . '"'; ?>> <?php echo $videos[3][1]; ?> </p>
            <img src="<?php echo $videos[3][0]; ?>" style="width:100%">
          </a>
          <a class="row">
            <p tag=<?php echo '"' . str_replace('"', "'", str_replace("'", '', $videos[4][2])) . '"'; ?>> <?php echo $videos[4][1]; ?> </p>
            <img src="<?php echo $videos[4][0]; ?>" style="width:100%">
          </a>
          <a class="row">
            <p tag=<?php echo '"' . str_replace('"', "'", str_replace("'", '', $videos[5][2])) . '"'; ?>> <?php echo $videos[5][1]; ?> </p>
            <img src="<?php echo $videos[5][0]; ?>" style="width:100%">
          </a>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div id="results"></div>
            </div>
        </div>
        
        <!-- scripts -->
        <script language="JavaScript">

            function tplawesome(e,t){
              res=e;
              for(var n=0;n<t.length;n++){
                res=res.replace(/\{\{(.*?)\}\}/g,function(e,r){
                  return t[n][r]})
              }
              return res
            }

            function resetVideoHeight() {
                $(".video").css("height", $("#results").width() * 9/16);
            }

            function init() {
                gapi.client.setApiKey("AIzaSyAmcpGPaTlwpxtW064ud3fDb7cP6Q7w9qk");
                gapi.client.load("youtube", "v3", function() {
                    // yt api is ready
                });
            }

            $("a.row").on("click", function(e) {
              e.preventDefault();
              
              var json = {"tags" : this.children[0].getAttribute("tag")};
              //alert(this.children[0].getAttribute("tag"));
              $.ajax({
                type: "POST",
                url: "reweigh.php" ,
                data: json,
                success : function(res) { 

                    var array = res.split("\n");
                    var i;
					for (i = 0; i < 5; i++) { 
					    $("a.row > p")[i].setAttribute("tag", array[(i+1)*3].replace(new RegExp("'", 'g'), "").replace(new RegExp('"', 'g'), "'"));
					    $("a.row > img")[i].setAttribute("src", array[3*i + 1]);
					    $("a.row > p")[i].innerHTML = array[3*i + 2];
					}
                    
                    //location.reload();

                }
        	  });
        	  var link = "//www.youtube.com/embed/" + this.children[1].getAttribute("src").split("/")[4];
        	  $("#results").html("");
              $("#results").append("<iframe class='video w100' width='640' height='360' src='" + link + "' frameborder='0' allowfullscreen></iframe>");
              resetVideoHeight();
            });

        </script>
        <script src="https://apis.google.com/js/client.js?onload=init"></script>
    </body>
</html>




