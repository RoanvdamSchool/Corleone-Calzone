<?php
include('headerAdmin.php');
?>
    <?php
    showIngredientForUpdate();
    ?>
</main>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            var imagePreview = document.getElementById('image-preview_add_ingredient');

            reader.onload = function(){
                var img = document.createElement('img');
                img.src = reader.result;
                imagePreview.innerHTML = '';
                imagePreview.appendChild(img);
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>