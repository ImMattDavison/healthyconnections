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

if($gatheredContent['postType'] = 2){
   header('Location: job.php?'.$gatheredContent['postid'].'id='.$postid.'');
}
 

echo "<div class='post-cell'>
                                        <div class='post-block'>
                                            <small class='listed-by'> Listing by: " .$gatheredContent['username']."</small>
                                            <h4>" . $gatheredContent['trialName'] . "</h4>
                                            <p>" . $gatheredContent['trialDesc'] . "</p>
                                            <a class='post-button' href='job.php?id=" . $gatheredContent['postid'] . "'>View Ad</a>
                                        </div>
                                    </div>";
