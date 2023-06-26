<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styleAnouk.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <title>Add Ingredient</title>
</head>
<body>
<header>
    <h1 id="websiteName">Add Ingredient</h1>
    <nav>
        <a class="a_addIngredient" href="admin.php">home</a>
        <a class="a_addIngredient" href="orders.php">bestellingen</a>
    </nav>
    <img id="websiteLogo" src="../images/carleone%20calzone_LOGO.png" alt="websiteLogo">
</header>
<main>
    <div class="container_add_ingredient">
        <h2>Add Ingredient</h2>
        <form action="add_ingredient.php" method="POST" enctype="multipart/form-data">
            <div class="form-group_add_ingredient">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group_add_ingredient">
                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="4" required></textarea>
            </div>
            <div class="form-group_add_ingredient">
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" required>
            </div>
            <div class="form-group_add_ingredient">
                <label for="stock">Stock:</label>
                <input type="text" name="stock" id="stock" required>
            </div>
            <div class="form-group_add_ingredient">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image_add_ingredient" required onchange="previewImage(event)">
            </div>
            <div class="form-group image-preview" id="image-preview_add_ingredient">
                <!-- Preview image will be displayed here -->
            </div>
            <div class="form-group_add_ingredient">
                <input type="submit" value="Add Ingredient">
            </div>
        </form>
    </div>
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