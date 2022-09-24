<?php
    // error_reporting(0);
    session_start();

    require_once('includes/config.php');

    if(!isset($_SESSION['username'])) {
        header("Location: index.php");
    };

    $getuser = mysqli_query($conn, "SELECT * FROM site_users WHERE username='".$_SESSION['username']."'");
    $userdata = mysqli_fetch_assoc($getuser);

    if($userdata['isDoctor'] != 1) {
        header("Location: index.php");
    };


    $sprn = random_int(100000, 999999);
    $ssrn = random_int(100000, 999999);
    $upid = $sprn.'-'.time().'-'.$ssrn;

    if(isset($_POST['submit'])) {
        $trialName = $_POST['trialName'].' | Medical Trial';
        $trialDescription = $_POST['trialDesc'];
        $trialPostDate = date('Y-m-d H:i:s');
        $username = $_SESSION['username'];
        $email = $userdata['email'];
        $phoneNumber = $userdata['phoneNumber'];
        $sql = "INSERT INTO posts (postid, trialName, trialDesc, trialPostDate, username, email, phoneNumber, postType) VALUES ('$upid','$trialName', '$trialDescription', '$trialPostDate', '$username', '$email', '$phoneNumber', 2)";
				$result = mysqli_query($conn, $sql);
				if ($result) {
					echo '<script>alert("Your Medical Trial ad has been created successfully.")</script>';
				};
    };
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Post a Trial | Healthy Connections</title>
        <link rel="stylesheet" href="style/main.css">
        <link rel="stylesheet" href="style/adcreate.css">
    </head>
    <body>
        <?php include('globals/navbar.php') ?>
        <div class="container">
            <h1>Post an ad for a Job as a Doctor</h1>
            <form action='' method='post'>
                <p class="form-item"><label>Job Title</label><br />
                <input required style="width: 100%" type='text' name='trialName'></p>

                <p class="form-item"><label>Job Description</label><br />
		        <textarea required name='trialDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

                <p><input class="submit" type='submit' name='submit' value='Post Medical Trial Ad'></p>
            </form>
        </div>
    </body>
</html>