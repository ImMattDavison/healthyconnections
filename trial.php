<?php require('includes/config.php'); 
// if not logged in redirect to login page
error_reporting(0);
session_start();

if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}
$postid = $_GET['id'];
$pgContent = 'SELECT * FROM posts WHERE id = '.$postid.'';
$gather = mysqli_query($conn, $pgContent);
$gatheredContent = mysqli_fetch_assoc($gather);

if($gatheredContent['id'] == ''){
	header('Location: index.php');
	exit;
}

$getuser = mysqli_query($conn, "SELECT * FROM site_users WHERE username='".$_SESSION['username']."'");
$userdata = mysqli_fetch_assoc($getuser);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title>Medical Trial | Healthy Connections</title>
        <link rel="stylesheet" href="style/main.css">
        <link rel="stylesheet" href="style/post.css">
    </head>
    <body>
        <?php include('globals/navbar.php') ?>
        <div class="container">
            <h1>Medical Trial</h1>
            <div class="row poster-block">
                <div>
                    <p>Medical Trial Listing by: <b><?php echo $gatheredContent['username']; ?></b></p> 
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
            <a href="trialapplication.php?id=<?php echo $gatheredContent['id'];?>" class="submit">Apply for this Trial</a>
            <p class="form-info">By clicking the above button you accept for Healthy Connections to text the poster of this trial with your full name, email address and phone number.</p>
        </div>
    </body>
</html>