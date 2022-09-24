<?php
//include config
require_once('includes/config.php');


//check if already logged in
if($user->is_logged_in() ){ header('Location: index.php'); } 
?>
<!doctype html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Login | HealthyConnections</title>
  <link rel="stylesheet" href="../style/main.css">
  <link rel="stylesheet" href="../style/login.css">
</head>
<body>

<div class="container">

	<?php

	//process login form if submitted
	if(isset($_POST['submit'])){

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		if($user->login($username,$password)){ 

			//logged in return to index page
			header('Location: index.php');
			exit;
		

		} else {
			$message = '<p class="error">ERROR: Incorrect username or password</p>';
		}

	}//end if submit

	if(isset($message)){ echo $message; }
	?>
	<div class="form-body"> 
		<h1>Login</h1>
		<form action="" method="post">
			<p><label>Username</label><br><input type="text" name="username" value=""  /></p>
			<p><label>Password</label><br><input type="password" name="password" value=""  /></p>
			<p><label></label><input type="submit" name="submit" value="Login"  /></p>
		</form>
	</div>

</div>
</body>
</html>
