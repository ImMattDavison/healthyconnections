<?php 

include 'includes/config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM site_users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
        $_SESSION['loggedin'] = true;
		header("Location: welcome.php");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
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
	<title>Login | Healthy Connections</title>
</head>
<body>
	<div class="container">
		<div class="form-body">
        <h1 class="login-text">Login</h1>
			<form action="" method="POST" class="login-email">
				<div class="input-group">
                    <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
				</div>
				<div class="input-group">
					<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
				</div>
				<div class="input-group">
                    <input class="login" type='submit' name='submit' value='Login'>
				</div>
				<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
			</form>
		</div>
	</div>
</body>
</html>