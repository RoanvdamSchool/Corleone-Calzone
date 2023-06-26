<?php
include("headerMain.php");
checkForIngredient();
?>

<div id="gridProduct">
    <?php
    printIngredients();
    ?>
</div>
<?php
include("footer.php");
?>