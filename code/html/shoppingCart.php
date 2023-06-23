<?php
include("headerMain.php");
?>
<div class="pizzaBackground">
    <div id="shoppingCartContainer" class="col-10 offset-1">
        <?php  printShoppingCart()?>
        
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