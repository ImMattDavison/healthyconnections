<?php
    error_reporting(0);
    start_session();
    if(!isset($_SESSION['username'])) {
        header("Location: index.php");
    }

    $getuser = mysqli_query($conn, "SELECT * FROM site_users WHERE username='".$_SESSION['username']."'");
    $userdata = mysqli_fetch_assoc($getuser);

    if($userdata['isDoctor'] != 1) {
        header("Location: index.php");
    }


    $sdrn = random_int(100000, 999999);
    $upid = $sdrn.'-'.time().'-'.$sdrn;

    if(isset($_POST['submit'])) {
        $trialName = $_POST['trialName'];
        $trialDescription = $_POST['trialDescription'];
        $username = $_SESSION['username'];
        $email = $userdata['email'];
        $phoneNumber = $userdata['phoneNumber'];
        $sql = "INSERT INTO posts (postid, trialName, trialDesc, username, email, phoneNumber, postType) VALUES ('$upid','$trialName', '$trialDescription', '$username', '$email', '$phoneNumber', 3)";
				$result = mysqli_query($conn, $sql);
				if ($result) {
					echo '<script>alert("Your trial ad has been created successfully.")</script>';
				}
    }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post a Trial</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/adcreate.css">