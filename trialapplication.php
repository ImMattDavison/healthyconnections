<?php require('includes/config.php'); 

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

$url = 'https://spectrebot.api.stdlib.com/texthealth@dev/trialtext/';

$trialname = $gatheredContent['trialName'];
$firstname = $userdata['firstName'];
$lastname = $userdata['lastName'];
$email = $userdata['email'];
$phone = $userdata['phoneNumber'];
$text = $gatheredContent['phoneNumber'];
$textTitle = $gatheredContent['username'];

$_ZAP_ARRAY = array(
        'type' => 0,
	    'trialname' => $trialname,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'phone' => $phone,
        'text' => $text,
        'name' => $textTitle
);

// stuff it into a query
$_ZAP_ARRAY = http_build_query($_ZAP_ARRAY );

// get my zap URL

// curl my data into the zap
$ch = curl_init( $url);
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $_ZAP_ARRAY);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );

header('Location: job.php?'.$gatheredContent['postid'].'&id='.$postid.'');

?>