<!DOCTYPE html>
<html lang="en">
    <?php
    error_reporting(0);
    require_once('includes/config.php');
    session_start();
    if(!isset($_SESSION['username'])){?>
        <!-- IF LOGGED IN THIS WILL SHOW -->
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta charset="utf-8">
            <title>Healthy Connections | Connect with Doctors, Find Medical Trials and More.</title>
            <link rel="stylesheet" href="style/main.css">
        </head>
        <body>
            <?php include('globals/navbar.php') ?>
            
        </body>
    <?php } else if(isset($_SESSION['username'])) {
                    $getuser = mysqli_query($conn, "SELECT * FROM site_users WHERE username='".$_SESSION['username']."'");
                    $userdata = mysqli_fetch_assoc($getuser);
        ?>
        <!-- IF NOT LOGGED IN THIS WILL SHOW -->
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta charset="utf-8">
            <title>Dashboard | Healthy Connections</title>
            <link rel="stylesheet" href="style/main.css">
            <link rel="stylesheet" href="style/dashboard.css">
        </head>
        <body>
            <?php include('globals/navbar.php') ?>
            <div class="container">
                <h1>Dashboard</h1>
                <hr>
                <?php echo "<h2>Welcome " . $userdata['firstName'] . ", it's the " .date('jS \of F Y'). "</h2>"; ?>
                <?php if($userdata['isDoctor'] = 1) { ?>
                    <div>
                        <h3>Doctor's Tools</h3>
                        <hr>
                        <div class="row">
                            <div class="tool-block">
                                <a class="tool-button" href="create-trial.php">Create an ad for a Medical Trial</a>
                            </div>
                            <div class="tool-block">
                                <a class="tool-button" href="create-job.php">Create a job ad for a Doctor</a>
                            </div>
                            <div class="tool-block">
                                <a class="tool-button" href="prescription.php">Alert a prescription as ready</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div>
            </div>
        </body>
    <?php } ?>
</html>