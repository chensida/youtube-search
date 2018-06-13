<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="/recommend/css/style.css" />
</head>
<body>
<?php
	require('db.php');
	session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['username'])){
		
		$username1 = stripslashes($_REQUEST['username']); // removes backslashes
		$password1 = stripslashes($_REQUEST['password']);
		
	//Checking is user existing in the database or not
		try{
	        $query = "SELECT * FROM `user` WHERE username='$username1' and password='".md5($password1)."'";
	        $statement = $conn->prepare($query);
			$statement->execute();
			$all = $statement->fetchAll();

			$query2 = "SELECT title, url, tags FROM `videos`";
	        $statement2 = $conn->prepare($query2);
			$statement2->execute();
			$all2 = $statement2->fetchAll();
		}catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
			echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
		}
		$_SESSION['username'] = $username1;
		$_SESSION['weight'] = $all[0]['weight'];
		$_SESSION['weights'] = $all2;
		header("Location: index.php"); // Redirect user to index.php
    }else{
?>
<div class="form">
<h1>Log In</h1>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<input name="submit" type="submit" value="Login" />
</form>
<p><a href='registration.php'>Register Here</a></p>

</div>
<?php } ?>


</body>
</html>
