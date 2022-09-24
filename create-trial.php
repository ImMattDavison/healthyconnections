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
    $uid = $sdrn.time().$sdrn;

    if(isset($_POST['submit'])) {
        $trialName = $_POST['trialName'];
        $trialDescription = $_POST['trialDescription'];
        $username = $_SESSION['username'];
        $email = $_POST['email'];
    }
    ?>

<!DOCTYPE html>