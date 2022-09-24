<!DOCTYPE html>
<html lang="en">
    <?php
    error_reporting(0);
    session_start();
    require_once('includes/config.php');

    if(isset($_SESSION['loggedin'])){?>
        <!-- IF LOGGED IN THIS WILL SHOW -->
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta charset="utf-8">
            <title>Dashboard | Healthy Connections</title>
            <link rel="stylesheet" href="style/main.css">
            <link rel="stylesheet" href="style/dashboard.css">
        </head>
        <body>
            <?php include('globals/navbar.php') ?>
            <h1>Dashboard</h1>
        </body>
    <?php } else if(!isset($_SESSION['loggedin'])) { ?>
        <!-- IF NOT LOGGED IN THIS WILL SHOW -->
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta charset="utf-8">
            <title>Healthy Connections | Connect with Doctors, Find Medical Trials and More.</title>
            <link rel="stylesheet" href="style/main.css">
        </head>
        <body>
            <?php include('globals/navbar.php') ?>
            
        </body>
    <?php } ?>
</html>