<?php
include("headerMain.php");
?>
<div class="pizzaBackground">
    <div id="shoppingCartContainer" class="col-10 offset-1">
        <div class="shoppingCartItem">
            <img class="shoppingCartItemImage" src="../images/pizzaHawaii.jpg">
            <h2 class="shoppingCartItemName">hawaii groot</h2>
            <h2 class="shoppingCartItemPrice">€6.95</h2>
            <form action="home.php" method="post" class="shoppingCartItemAmount">
                <a href="shoppingCart.php?plus=1">delete</a>
                <input type="number" name="amount" class="inputField">
                <a href="shoppingCart.php?plus=1">add</a>
            </form>
        </div>
        
        <div class="shoppingCartItem">
            <img class="shoppingCartItemImage" src="../images/pizzaHawaii.jpg">
            <h2 class="shoppingCartItemName">hawaii groot</h2>
            <h2 class="shoppingCartItemPrice">€6.95</h2>
            <form action="home.php" method="post" class="shoppingCartItemAmount">
                <a href="shoppingCart.php?plus=1">delete</a>
                <input type="number" name="amount" class="inputField">
                <a href="shoppingCart.php?plus=1">add</a>
            </form>
        </div>
        
        <div class="shoppingCartItem">
            <img class="shoppingCartItemImage" src="../images/pizzaHawaii.jpg">
            <h2 class="shoppingCartItemName">hawaii groot</h2>
            <h2 class="shoppingCartItemPrice">€6.95</h2>
            <form action="home.php" method="post" class="shoppingCartItemAmount">
                <a href="shoppingCart.php?plus=1">delete</a>
                <input type="number" name="amount" class="inputField">
                <a href="shoppingCart.php?plus=1">add</a>
            </form>
        </div>
        
        <div class="shoppingCartItem">
            <img class="shoppingCartItemImage" src="../images/pizzaHawaii.jpg">
            <h2 class="shoppingCartItemName">hawaii groot</h2>
            <h2 class="shoppingCartItemPrice">€6.95</h2>
            <form action="home.php" method="post" class="shoppingCartItemAmount">
                <a href="shoppingCart.php?plus=1">delete</a>
                <input type="number" name="amount" class="inputField">
                <a href="shoppingCart.php?plus=1">add</a>
            </form>
        </div>
        
        <a href="ingredient.php">extra opties</a>
        <h1 class="shoppingCartItemPrice">totaalprijs: €100.00</h1>
        
        <form action="paymentSuccessful.php" method="post">
            <input type="submit" value="betaal">
        </form>
    </div>


</div>
<?php
include("footer.php");
?>