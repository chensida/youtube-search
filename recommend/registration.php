
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="/recommend/css/style.css" />
</head>
<body>
<?php
	require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
		$username1 = stripslashes($_REQUEST['username']);
		$email = stripslashes($_REQUEST['email']);
		$password1 = stripslashes($_REQUEST['password']);

		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `user` (username, password, email, trn_date, weight) VALUES ('$username1', '".md5($password1)."', '$email', '$trn_date', '')";
        $result = $conn->exec($query);
        if($result){
            echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        } else {
        	echo "<div class='form'><h3>registeration failed.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
<br /><br />
</div>
<?php } ?>
</body>
</html>
