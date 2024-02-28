<?php
include("../php/functions.php");
session_start();
if ($_SESSION['user'] == null) header('Location: ../index.php');
else {
    if ($_SESSION['user']['is_admin'] != 1) {
        header('location: home.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styleAnouk.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<header>
    <h1 id="websiteName">Corleone Calzone Pizza</h1>
    <nav>
        <a class="a_admin" href="addProduct.php">voeg product toe</a>
        <a class="a_admin" href="addIngredient.php">voeg ingrediënt toe</a>
        <a class="a_admin" href="orders.php">bestellingen</a>
        <a class="a_admin" href="admin.php">home</a>
        <a class="a_admin" href="../php/logout.php">logout</a>
    </nav>
    <img id="websiteLogo" src="../images/carleone%20calzone_LOGO.png" alt="websiteLogo">
</header>

<main>