<?php
include("headerMain.php");
if (!isset($_SESSION['cart']) ) {
    $_SESSION['cart'] = [];
}

?>

<div id="gridProduct">
    <?php
    printProduct();
    ?>
</div>
<?php
include("footer.php");
shoppingCart();
?>