<!DOCTYPE html>
<html lang="en">
    <?php
    error_reporting(0);

    require_once('includes/config.php');

    if($user->is_logged_in()){?>
        <!-- IF LOGGED IN THIS WILL SHOW -->
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta charset="utf-8">
            <title>Home | Healthy Connections</title>
            <link rel="stylesheet" href="style/main.css">
            <link rel="stylesheet" href="style/dashboard.css">
        </head>
        <?php include('globals/navbar.php') ?>

        <h1>Dashboard</h1>
    <?php } else { ?>
        <!-- IF NOT LOGGED IN THIS WILL SHOW -->
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta charset="utf-8">
            <title>Healthy Connections | Connect with Doctors, Find Medical Trials and More.</title>
            <link rel="stylesheet" href="style/main.css">
        </head>
        <?php include('globals/navbar.php') ?>
    <?php } ?>
</html>