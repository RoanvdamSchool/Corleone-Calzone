<?php
include("headerMain.php");
?>
<div class="pizzaBackground">
    <div id="paymentReceiptBox" class="col-6 offset-3">
        <h1 class="paymentReceiptText">uw bestelling is geplaatst</h1>
        <div class="paymentReceiptInfoBox">
            <?php
            printPayment()
            ?>
        <a href="home.php">terug naar home</a>
    </div>
</div>
<?php
payment();
include("footer.php");
?>