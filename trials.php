<?php require('includes/config.php'); 
// if not logged in redirect to login page
error_reporting(0);
session_start();

if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Healthy Connections</title>
        <link rel="stylesheet" type="text/css" href="style/main.css">
        <link rel="stylesheet" type="text/css" href="style/dashboard.css">
    </head>
    <body>
        <div class="container">
            <h1 style="text-align: center;">All Medical Trials</h1>
            <div class="row">
                <?php 
                    $gettrials = mysqli_query($conn, 'SELECT * FROM posts WHERE postType = 1 ORDER BY id DESC');
                        while($trials = mysqli_fetch_assoc($gettrials)) {
                            echo "<div class='post-cell'>
                                    <div class='post-block'>
                                        <small class='listed-by'>Listing by: " .$trials['username']."</small>
                                            <h4>" . $trials['trialName'] . "</h4>
                                            <p>" . $trials['trialDesc'] . "</p>
                                            <a class='post-button' href='trial.php?" .$trials['postid']."&id=" . $trials['id'] . "'>View Trial</a>
                                        </div>
                                    </div>";
                        }
                ?>
            </div>
        </div>
    </body>
</html>