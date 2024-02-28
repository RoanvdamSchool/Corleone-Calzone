<?php
include('headerAdmin.php');
?>
    <div class="container_add_ingredient">
        <form method="post" enctype="multipart/form-data">
        <h2>Voeg Product toe</h2>    
            <div class="form-group_add_ingredient">
                <label for="image">Afbeelding:</label>
                <input type="file" name="image" accept="image/*" id="image_add_ingredient" required onchange="previewImage(event)">
            </div>
            <div class="form-group image-preview" id="image-preview_add_ingredient">
                <!-- Preview image will be displayed here -->
            </div>
            <div class="form-group_add_ingredient">
                <label for="name">Naam:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group_add_ingredient">
                <textarea placeholder="Omschrijving" name="description" id="description" rows="4" required></textarea>
            </div>
            <div class="form-group_add_ingredient">
                <input placeholder="prijs" type="text" name="price" id="price" required>
            </div>
            <div class="form-group_add_ingredient">
                <input type="submit" name="submit" value="toevoegen">
            </div>
        </form>
    </div>
</main>
    <?php
    addProduct();
    ?>

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