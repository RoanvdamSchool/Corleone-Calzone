<?php
include("headerMain.php");
if (!isset($_SESSION['cart']) ) {
    $_SESSION['cart'] = [];
}
?>
<div id="buyProductBox" class="col-10 offset-1">
    <?php
    showProduct();
    ?>
</div>
<?php
include("footer.php");
shoppingCart();
?>