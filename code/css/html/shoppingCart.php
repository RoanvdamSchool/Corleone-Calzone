<?php
include("headerMain.php");
?>
<div class="pizzaBackground">
    <div id="shoppingCartContainer" class="col-10 offset-1">
        <?php  printShoppingCart();
        checkForPepperoniPizza();
        ?>
    </div>
</div>
<?php
include("footer.php");
?>