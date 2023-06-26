<?php
include("../php/functions.php");
session_start();
echo "<script>console.log(" . json_encode(json_encode($_SESSION, JSON_PRETTY_PRINT)) . ");</script>";
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>corleone calzone pizza</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
        <link href="../css/style.css" rel="stylesheet">
        <!-- <link href="../css/styleAnouk.css" rel="stylesheet"> -->
        <link href="../css/styleMax.css" rel="stylesheet">
        <link href="../css/styleRoan.css" rel="stylesheet">
    </head>
    <body>
        <header id="headerMain">
            <h1 id="websiteName">Corleone Calzone Pizza</h1>
            <img id="websiteLogo" src="../images/carleone%20calzone_LOGO.png" alt="websiteLogo">

            <a href="home.php">home</a>
            <a href="shoppingCart.php">winkelwagen</a>
            <a href="profile.php">profiel</a>
            <a href="../php/logout.php">logout</a>
        </header>