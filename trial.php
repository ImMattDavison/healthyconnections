<?php require('includes/config.php'); 
// if not logged in redirect to login page
session_start();

if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}
$postid = $_GET['id'];
$pgContent = mysqli_query($conn, 'SELECT * FROM posts WHERE postid = $postid');
$gatheredContent = mysqli_fetch_assoc($pgContent);

if($gatheredContent['postid'] = 2){
    header('Location: job.php?id='.$postid);');
}

