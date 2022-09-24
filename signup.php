<?php //include config
require_once('includes/config.php');

//if not logged in redirect to login page
if($user->is_logged_in()){ header('Location: index.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <meta charset="utf-8">
  <title>Signup | Healthy Connections</title>
  <link rel="stylesheet" href="style/main.css">
  <link rel="stylesheet" href="style/login.css">
</head>
<body>

<div class="container">

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);

		$sdrn = random_int(100000, 999999);
		$uid = time().$sdrn;

		//very basic validation
		if($firstName ==''){
			$error[] = 'Please enter your firstname.';
		}

		if($lastName ==''){
			$error[] = 'Please enter your lastname.';
		}

		if($username ==''){
			$error[] = 'Please enter a username.';
		}

		$usernameCheck = $db->prepare('SELECT username FROM site_users WHERE username = :username');
		$usernameCheck->execute(array(':username' => $username));
		$result = $usernameCheck->fetch();
		if(!$result['username'] == ''){
			$error[] = 'Username already exists.';
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

		$emailCheck = $db->prepare('SELECT username FROM site_users WHERE email = :email');
		$emailCheck->execute(array(':email' => $email));
		$eresult = $emailCheck->fetch();
		if(!$eresult['email'] == ''){
		 	$error[] = 'Email already registered.';
		}

		if($phoneNumber ==''){
			$error[] = 'Please enter your phone number.';
		}

		$phoneCheck = $db->prepare('SELECT username FROM site_users WHERE phoneNumber = :phoneNumber');
		$phoneCheck->execute(array(':phoneNumber' => $phoneNumber));
		$presult = $phoneCheck->fetch();
		if(!$presult['phoneNumber'] == ''){
		 	$error[] = 'Phone Number already registered.';
		}

		if(!isset($error)){

			$hashedpassword = password_hash($password, PASSWORD_BCRYPT);
			$loginTime = time();

			try {

				//insert into database
				$stmt = $db->prepare('INSERT INTO site_users (userid,username,password,email,phoneNumber) VALUES (:userid, :username, :password, :email, :phoneNumber)') ;
				$stmt->execute(array(#
					':userid' => $uid,
					':username' => $username,
					':password' => $hashedpassword,
					':email' => $email,
					':phoneNumber' => $phoneNumber,
				));

				//redirect to login page
				header('Location: login.php');
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
	<div class="form-body">
	<h1>Signup</h1>
	<form action='' method='post'>
		<p><label>First Name</label><br />
		<input required type='text' name='firstName' placeholder="Jane" value='<?php if(isset($error)){ echo $_POST['username'];}?>'></p>
		
		<p><label>Last Name</label><br />
		<input required type='text' name='lastName' placeholder="Doe" value='<?php if(isset($error)){ echo $_POST['username'];}?>'></p>

		<p><label>Username</label><br>
		<input required type='text' name='username' placeholder="username" pattern="^[A-Za-z][A-Za-z0-9_]{2,29}$" value='<?php if(isset($error)){ echo $_POST['username'];}?>'></p>

		<p><label>Email</label><br />
		<input required type='email' name='email' placeholder="jane@doe.com" value='<?php if(isset($error)){ echo $_POST['email'];}?>'></p>

		<p><label>Phone Number</label><br />
		<input required id="phone" type='tel' name='phoneNumber' placeholder="+447123456789" pattern="^\+[1-9]\d{1,14}$" value='<?php if(isset($error)){ echo $_POST['phoneNumber'];}?>'></p>

		<p><label>Password</label><br />
		<input required type='password' name='password' placeholder="password" value='<?php if(isset($error)){ echo $_POST['password'];}?>'></p>

		<p><label>Confirm Password</label><br />
		<input required type='password' name='passwordConfirm' placeholder="password" value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'></p>
		
		<p><input class="login" type='submit' name='submit' value='Sign Up'></p>

	</form>
	</div>	

</div>
</body>
 </html>