<?php require('includes/config.php'); 
// if not logged in redirect to login page
session_start();

if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}
$postid = $_GET['id'];
$pgContent = 'SELECT * FROM posts WHERE id = '.$postid.'';
$gather = mysqli_query($conn, $pgContent);
$gatheredContent = mysqli_fetch_assoc($gather);

$getuser = mysqli_query($conn, "SELECT * FROM site_users WHERE username='".$_SESSION['username']."'");
$userdata = mysqli_fetch_assoc($getuser);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title>Healthy Connections | Connect with Doctors, Find Medical Trials and More.</title>
        <link rel="stylesheet" href="style/main.css">
        <link rel="stylesheet" href="style/post.css">
    </head>
    <body>
        <div class="container">
            <h1>Medical Trial</h1>
            <div class="row poster-block">
                <div>
                    <p>Medical Trial Listing by: <b><?php echo $gatheredContent['username']; ?></b></p>
                    <small>Member of Healthy Connections since <?php echo date('d/m/y', strtotime($userdata['joinDate'])); ?></small> 
                </div>
                <div>
                    Posted on <?php echo date('d/m/y H:i', strtotime($gatheredContent['trialPostDate'])); ?>
                </div>
            </div>
            <div>
                <h2><?php echo $gatheredContent['trialName']; ?></h2>
            </div>
            <div>
                <p><?php echo $gatheredContent['trialDesc']; ?></p>
            </div>
        </div>
    </body>
</html>