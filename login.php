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
<body style="background: linear-gradient(0deg, rgba(247,170,170,1) 0%, rgba(255,82,80,1) 35%); background-size: cover; background-position: bottom; backdrop-filter: blur(5px);">

<div style="display: flex; flex-flow: column; height: 100vh; width: 100vw; justify-content: center; align-items: center; backdrop-filter: blur(5px)" class="container">

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
	<div style="padding: 3em 5em; border-radius: 1em; background-color: #fff; backdrop-filter: blur(10px); min-width: 50vw;"> 
		<h1 style="text-align: center; margin-top: 0; margin-bottom: .75em; font-size: 1.75em;">Login</h1>
		<form style="text-align:center;" action="" method="post">
			<p><label style="font-size: 1.2em; margin-bottom: .7em;">Username</label><br><input style="border: none; border-bottom: 1px solid #ff5250; min-width: 100%; background: #ff525032; text-align: center;" type="text" name="username" value=""  /></p>
			<p><label style="font-size: 1.2em; margin-bottom: .7em;">Password</label><br><input style="border: none; border-bottom: 1px solid #ff5250; min-width: 100%; background: #ff525032; text-align: center;" type="password" name="password" value=""  /></p>
			<p><label></label><input style="margin-top: .75em; background-color: #ff5250; border: none; border-radius: 1em; color: #fff; padding: .75em 3em;" type="submit" name="submit" value="Login"  /></p>
		</form>
	</div>

</div>
</body>
</html>
