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
    </nav>
    <img id="websiteLogo" src="../images/carleone%20calzone_LOGO.png" alt="websiteLogo">
</header>

<main>
    <div class="container_admin">
        <div class="cart_admin">
            <img id="ananas_stukjes_img" src="../images/ananasStukjes.jpg" alt="ananasStukjes">
            <p class="naam">ananas stukjes</p>
            <p class="pst">p.st:€0,50</p>
            <div class="Info">
                <p>yammie yammie,overheerlijke stukjes ananas voor op jouw...</p>
            </div>
            <a class="pas_aan" href="alterIngredient.php">pas aan</a>
            <a class="verwijder" href="#">verwijder</a>
            <p class="aantal">aantal</p>
        </div>
        <div class="cart_admin">
            <img id="hawaii_img" src="../images/pizzaHawaii.jpg" alt="hawaii">
            <p class="naam">hawaii</p>
            <div class="Info">
                <p>overheerlijke pizza met ananas!! zoals het hoort..</p>
            </div>
            <a class="pas_aan" href="alterProduct.php">pas aan</a>
            <a class="verwijder" href="#">verwijder</a>
            <p class="aantal">aantal</p>
        </div>
        <div class="cart_admin">
            <img id="ananas_stukjes_img" src="../images/ananasStukjes.jpg" alt="ananasStukjes">
            <p class="naam">ananas stukjes</p>
            <p class="pst">p.st:€0,50</p>
            <div class="Info">
                <p>yammie yammie,overheerlijke stukjes ananas voor op jouw...</p>
            </div>
            <a class="pas_aan" href="alterIngredient.php">pas aan</a>
            <a class="verwijder" href="#">verwijder</a>
            <p class="aantal">aantal</p>       
        </div>
        <div class="cart_admin">
            <img id="hawaii_img" src="../images/pizzaHawaii.jpg" alt="hawaii">
            <p class="naam">hawaii</p>
            <div class="Info">
                <p>overheerlijke pizza met ananas!! zoals het hoort..</p>
            </div>
            <a class="pas_aan" href="alterProduct.php">pas aan</a>
            <a class="verwijder" href="#">verwijder</a>
            <p class="aantal">aantal</p>               
        </div>
    </div>
</main>