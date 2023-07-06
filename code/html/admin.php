<?php
include('headerAdmin.php');
?>
    <h2 class="titleAdminTable">producten</h2>
    <div class="container_admin">
        <?php
            printAdminProduct();
        ?>
    </div>

    <h2 class="titleAdminTable">ingrediënten</h2>
    <div class="container_admin">
    <?php
        printAdminIngredient();
    ?>
    </div>
</main>