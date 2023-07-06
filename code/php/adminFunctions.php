<?php
function pdoObjectAdmin($dbname) {
    $servername = "localhost";
    $user = "root";
    $pass = "";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    return($conn);
}

function printAdminProduct() {
    $pdo = pdoObjectAdmin("corcalzpizza");
    
    $sql = "SELECT * FROM products";
    $products = $pdo->prepare($sql);
    try {
        $products->execute(array());
        foreach($products as $product) {
            $product_id = "${product['product_id']}";
            ?>
            <div class="pro_ing_item">
                <img class="pro_ing_image" src="../images/<?=$product['product_image']?>">
                <p class="pro_ing_name"><?=$product['product_name']?></p>
                <p class="price_per_pro_ing">p.st:<br>medium: €<?=$product['price']?><br>groot: €<?=$product['price']+1?><br>Calzone: €<?=$product['price']+2?></p>
                <div class="description">
                    <p><?=$product['description']?></p>
                </div>
                <a class="adjust" href="alterProduct.php?id=<?=$product_id?>">pas aan</a>
                <form method="post">
                    <input type="hidden" name="id" value="<?=$product_id?>">
                    <input type="submit" name="delete" class="delete" value="verwijder">
                </form>
            </div>
            <?php
        }
        $execute = true;
        if ($execute) {
            if (isset($_POST["delete"]) ) {
                $execute = false;
                deleteProduct($_POST['id']);
            }
        }
    }
    catch(PDOException $e) {
        echo "<br>$e";
    };
    
};

function printAdminIngredient() {
    $pdo = pdoObjectAdmin("corcalzpizza");
    
    $sql = "SELECT * FROM ingredients";
    $ingredients = $pdo->prepare($sql);
    try {
        $ingredients->execute(array());
        foreach($ingredients as $ingr) {
            $ingredient_id = "${ingr['ingredient_id']}";
            ?>
            <div class="pro_ing_item">
                <img class="pro_ing_image" src="../images/<?=$ingr['ingredient_image']?>">
                <p class="pro_ing_name"><?=$ingr['ingredient_name']?></p>
                <p class="price_per_pro_ing">p.st: €<?=$ingr['price']?></p>
                <div class="description">
                    <p><?=$ingr['description']?></p>
                </div>
                <a class="adjust" href="alterIngredient.php?id=<?=$ingredient_id?>">pas aan</a>
                <form method="post">
                    <input type="hidden" name="id" value="<?=$ingredient_id?>">
                    <input type="submit" name="delete" class="delete" value="verwijder">
                </form>
            </div>
            <?php
            
        }
        $execute = true;
        if ($execute) {
            if (isset($_POST["delete"]) ) {
                $execute = false;
                deleteIngredient($_POST['id']);
            }
        }
    }
    catch(PDOException $e) {
        echo "<br>$e";
    };
};

function addProduct() {
    $targetImage_dir = "../images/";
    
    if (isset($_FILES["image"]["name"]) ) {
        $targetImage_file = $targetImage_dir . basename($_FILES["image"]["name"]);
    }

    if(isset($_POST["submit"])) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetImage_file)) {
            echo "<script>alert('added product')</script>";
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
        }
        
        $product_name = $_POST['name'];
        $product_image = $_FILES["image"]["name"];
        $description = $_POST["description"];
        $price = $_POST['price'];
        
        $pdo = pdoObjectAdmin("corcalzpizza"); 
        
        $sql = "INSERT INTO products (product_name, product_image, description, price)
                VALUES (:product_name, :product_image, :description, :price)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(
            array(
                'product_name' => $product_name,
                'product_image' => $product_image,
                'description' => $description,
                'price' => $price
            )
        );
    };
};

function deleteProduct($id) {
    $pdo = pdoObjectAdmin("corcalzpizza");
    $sql = "DELETE FROM products WHERE product_id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            'product_id' => $id
        )
    );
}

function deleteIngredient($id) {
    $pdo = pdoObjectAdmin("corcalzpizza");
    $sql = "DELETE FROM ingredients WHERE ingredient_id = :ingredient_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            'ingredient_id' => $id
        )
    );
}

/*
function deleteMovie($id) {
    $conn = connectDatabase("netfish");
    
    try {
        $pdo = "DELETE FROM movie WHERE movie_id = :id";
        $stm = $conn->prepare($pdo);
        $data = [":id" => $id];
        $stm->execute($data);
        header("location: deleteSuccesful.php");
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}
*/

function addingredient() {
    $targetImage_dir = "../images/";
    
    if (isset($_FILES["image"]["name"]) ) {
        $targetImage_file = $targetImage_dir . basename($_FILES["image"]["name"]);
    }

    if(isset($_POST["submit"])) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetImage_file)) {
            echo "<script>alert('added ingredient')</script>";
        } else {
            echo "<script>alert('Sorry, there was an error uploading the ingredient.')</script>";
        }
        
        $ingredient_name = $_POST['name'];
        $ingredient_image = $_FILES["image"]["name"];
        $description = $_POST["description"];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        
        $pdo = pdoObjectAdmin("corcalzpizza");  
        
        $sql = "INSERT INTO ingredients (ingredient_name, ingredient_image, description, price, stock)
                VALUES (:ingredient_name, :ingredient_image, :description, :price, :stock)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(
            array(
                'ingredient_name' => $ingredient_name,
                'ingredient_image' => $ingredient_image,
                'description' => $description,
                'price' => $price,
                'stock' => $stock
            )
        );
    };
};

function updateProduct() {
    $pdo = pdoObjectAdmin("corcalzpizza");
    $sql = "UPDATE products
    SET product_name = :product_name, product_image = :product_image, description = :description, price = :price
    WHERE product_id = :product_id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            'product_name' => $_POST['name'],
            'product_image' => $_FILES["image"]["name"],
            'description' => $_POST["description"],
            'price' => $_POST['price'],
            'product_id' => $_GET['id']
        )
    );
}

function showProductForUpdate() {
    $pdo = pdoObjectAdmin("corcalzpizza");
    $product_data = $_GET['id'];
    $datafile = getProductId($product_data);
    
    foreach($datafile as $product) {
        ?>
        <div class="container_add_ingredient">
        <form method="post" enctype="multipart/form-data">
        <h2>verander product</h2>    
            <div class="form-group_add_ingredient">
                <label for="image">Afbeelding:</label>
                <input type="file" name="image" accept="image/*" id="image_add_ingredient" required onchange="previewImage(event)">
            </div>
            <div class="form-group image-preview" id="image-preview_add_ingredient">
                <!-- Preview image will be displayed here -->
            </div>
            <div class="form-group_add_ingredient">
                <label for="name">Naam:</label>
                <input type="text" name="name" id="name" value="<?=$product['product_name']?>" required>
            </div>
            <div class="form-group_add_ingredient">
                <textarea placeholder="Omschrijving" name="description" id="description" rows="4" required><?=$product['description']?></textarea>
            </div>
            <div class="form-group_add_ingredient">
                <input placeholder="prijs" type="text" name="price" id="price" value="<?=$product['price']?>" required>
            </div>
            <div class="form-group_add_ingredient">
                <input type="submit" name="submit" value="verander">
            </div>
        </form>
    </div>
        <?php
    }
    if (isset($_POST['submit']) ) {
        updateProduct();
        header("location:admin.php");
    }
}

function updateIngredient() {
    $pdo = pdoObjectAdmin("corcalzpizza");
    $sql = "UPDATE ingredients
    SET ingredient_name = :ingredient_name, ingredient_image = :ingredient_image, description = :description, price = :price, stock = :stock
    WHERE ingredient_id = :ingredient_id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            'ingredient_name' => $_POST['name'],
            'ingredient_image' => $_FILES["image"]["name"],
            'description' => $_POST["description"],
            'price' => $_POST['price'],
            'stock' => $_POST['stock'],
            'ingredient_id' => $_GET['id']
        )
    );
}

function showIngredientForUpdate() {
    $pdo = pdoObjectAdmin("corcalzpizza");
    $ingredient_data = $_GET['id'];
    $datafile = getIngredientId($ingredient_data);
    
    foreach($datafile as $ingr) {
        ?>
        <div class="container_add_ingredient">
        <form method="post" enctype="multipart/form-data">
        <h2>verander ingrediënt</h2>    
            <div class="form-group_add_ingredient">
                <label for="image">Afbeelding:</label>
                <input type="file" name="image" accept="image/*" id="image_add_ingredient" required onchange="previewImage(event)">
            </div>
            <div class="form-group image-preview" id="image-preview_add_ingredient">
                <!-- Preview image will be displayed here -->
            </div>
            <div class="form-group_add_ingredient">
                <label for="name">Naam:</label>
                <input type="text" name="name" id="name" value="<?=$ingr['ingredient_name']?>" required>
            </div>
            <div class="form-group_add_ingredient">
                <textarea placeholder="Omschrijving" name="description" id="description" rows="4" required><?=$ingr['description']?></textarea>
            </div>
            <div class="form-group_add_ingredient">
                <label for="price">prijs:</label>
                <input placeholder="prijs" type="text" name="price" id="price" value="<?=$ingr['price']?>" required>
            </div>
            <div class="form-group_add_ingredient">
                <label for="srock">voorraad:</label>
                <input placeholder="voorraad" type="text" name="stock" id="stock" value="<?=$ingr['stock']?>" required>
            </div>
            <div class="form-group_add_ingredient">
                <input type="submit" name="submit" value="verander">
            </div>
        </form>
    </div>
        <?php
    }
    if (isset($_POST['submit']) ) {
        updateIngredient();
        header("location:admin.php");
    }
}
?>