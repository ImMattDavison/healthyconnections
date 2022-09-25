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

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div>
                    <p>Medical Trial Listing by: <?php echo $gatheredContent['username']; ?></p>
                    <small>Member of Healthy Connections since <?php echo $userdata['joinDate']; ?></small> 
                </div>
                <div>
                    Posted on <?php echo date('d/m/y H:i', strtotime($gatheredContent['trialPostDate'])) ?>
                </div>
            </div>
        </div>
    </body>
</html>