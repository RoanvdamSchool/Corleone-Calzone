<?php
include("head.php");
include("header.php");
include("../php/databaseFunctions.php");
?>
<div id="buyProductBox" class="col-10 offset-1">
    <?php
    showProduct();
    ?>
</div>
<script>
    const radioButtons = document.querySelectorAll('input[type="radio"][name="size"]');
    let selectedValue = null;

    radioButtons.forEach((radioButton) => {
        radioButton.addEventListener('change', (event) => {
            if (radioButton.checked) {
                selectedValue = radioButton.value;
                console.log('Selected value:', selectedValue);
                
                if (selectedValue == "medium") {
                    console.log(5.95);
                }
            }
        });
    });
</script>
<?php
include("bottom.php");
?>