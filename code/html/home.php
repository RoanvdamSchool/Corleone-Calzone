<?php
include("headerMain.php");
if (!isset($_SESSION['cart']) ) {
    $_SESSION['cart'] = [];
}
if ($_SESSION['user'] == null) header('Location: index.php');

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