<?php //include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: index.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <meta charset="utf-8">
  <title>Signup | Healthy Connections</title>
</head>
<body>

<div class="container">


	<h1>Signup</h1>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);

		//very basic validation
		if($username ==''){
			$error[] = 'Please enter the username.';
		}

		if($password ==''){
			$error[] = 'Please enter the password.';
		}

		if($passwordConfirm ==''){
			$error[] = 'Please confirm the password.';
		}

		if($password != $passwordConfirm){
			$error[] = 'Passwords do not match.';
		}

		if($email ==''){
			$error[] = 'Please enter your email address.';
		}

		if($phoneNumber ==''){
			$error[] = 'Please enter your phone number.';
		}

		if(!isset($error)){

			$hashedpassword = password_hash($password, PASSWORD_BCRYPT);

			try {

				//insert into database
				$stmt = $db->prepare('INSERT INTO site_users (username,password,email,phoneNumber) VALUES (:username, :password, :email, :phoneNumber)') ;
				$stmt->execute(array(
					':username' => $username,
					':password' => $hashedpassword,
					':email' => $email,
					':phoneNumber' => $phoneNumber
				));

				//redirect to index page
				header('Location: index.php');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>

	<form action='' method='post'>

		<p><label>Username</label><br />
		<input type='text' name='username' placeholder="username" value='<?php if(isset($error)){ echo $_POST['username'];}?>'></p>

		<p><label>Email</label><br />
		<input type='email' name='email' placeholder="jane@doe.com" value='<?php if(isset($error)){ echo $_POST['email'];}?>'></p>

		<p><label>Phone Number</label><br />
		<input id="phone" type='tel' name='phoneNumber' placeholder="+447123456789" pattern="^\+[1-9]\d{1,14}$" value='<?php if(isset($error)){ echo $_POST['phoneNumber'];}?>'></p>

		<p><label>Password</label><br />
		<input type='password' name='password' placeholder="password" value='<?php if(isset($error)){ echo $_POST['password'];}?>'></p>

		<p><label>Confirm Password</label><br />
		<input type='password' name='passwordConfirm' placeholder="password" value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'></p>
		
		<p><input class="submit" type='submit' name='submit' value='Sign Up'></p>

	</form>

</div>
</body>
 </html>