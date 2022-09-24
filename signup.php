<?php 

include 'includes/config.php';

// error_reporting(0);
session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

$sdrn = random_int(100000, 999999);
$uid = time().$sdrn;

if (isset($_POST['submit'])) {
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$username = $_POST['username'];
	$email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM site_users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "SELECT * FROM site_users WHERE username='$username'";
			$result = mysqli_query($conn, $sql);
			if (!$result->num_rows > 0) {
				$sql = "INSERT INTO site_users (userid, firstName, lastName, username, email, phoneNumber, password) VALUES ('$uid','$firstName', '$lastName', '$username', '$email', '$phoneNumber', '$password')";
				$result = mysqli_query($conn, $sql);
				if ($result) {
					header ("Location: login.php");
				} else {
					// Something went wrong
                    echo "<script>alert('Something went wrong - if this error persists please contact us.')</script>";
				}
			} else {
				// This username is already taken. (Modal) 
				echo "<script>alert('!USERNAME!')</script>";
			}
		} else {
			// A user with this email is already registered. (Modal)
		}
		
	} else {
		// Passwords do not match. (Modal)
	}
	// Send email to user with verification link.
} else {
	// Something went wrong - if this error persists please contact us at
}

?>

<!DOCTYPE html>
<html>
<head>
	<!-- REQUIRED META -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- STYLE -->
	<link rel="stylesheet" type="text/css" href="style/login.css">
	<link rel="stylesheet" type="text/css" href="style/main.css">

	<!-- SEO -->
	<title>Signup | Healthy Connections</title>
</head>
<body>
	<div class="container">
		<div class="form-body">
        <h1 class="login-text">SignUp</h1>
			<form action="" method="POST">
				<div class="input-group">
					<input type="text" placeholder="Firstname" name="firstName" required>
					<input type="text" placeholder="Lastname" name="lastName" required>
				</div>
				<div class="input-group">
					<input type="text" pattern="^[A-Za-z][A-Za-z0-9_]{2,29}$" placeholder="Username" name="username" required>
				</div>
				<div class="input-group">
					<input type="email" placeholder="Email" name="email" required>
				</div>
                <div class="input-group">
					<input pattern="^\+[1-9]\d{1,14}$" type="tel" placeholder="+447123456789" name="phoneNumber" required>
				</div>
				<div class="input-group">
					<input type="password" placeholder="Password" name="password" required>
				</div>
				<div class="input-group">
					<input type="password" placeholder="Confirm Password" name="cpassword" required>
				</div>
				<div class="input-group">
                    <input class="login" type='submit' name='submit' value='Sign Up'>
				</div>
				<p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
			</form>
		</div>
	</div>
</body>
</html>