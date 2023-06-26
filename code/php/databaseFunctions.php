<?php

// sets the pdo object. use for each function that has to do with database 
function pdoObject($dbname) {
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

// prints all the product from database to home.php page
function printProduct() {
    $pdo = pdoObject("corcalzpizza");
    
    $sql = "SELECT * FROM products";
    $products = $pdo->prepare($sql);
    try {
        $products->execute(array());
        foreach($products as $product) {
            $product_id = "${product['product_id']}";
            ?>
            <a href="product.php?product_id=<?=$product["product_id"]?>" class="linkToBuy">
                <div class="productBox">
                    <img src="../images/<?=$product['product_image']?>" class="pizzaImage">
                    <h3 class="pizzaName">pizza <?=$product['product_name']?></h3>
                    <div class="productDescriptionBox">
                        <p class="productDescription"><?=$product['description']?></p>
                        <p>prices:<br>medium: €<?=$product['price']?><br>groot: €<?=$product['price']+1?><br>Calzone: €<?=$product['price']+2?></p>
                    </div>
                </div>
            </a>
            <?php
            
        }
    }
    catch(PDOException $e) {
        echo "<br>$e";
    };
};

// prints all ingredients form database to ingredient.php page
function printIngredients() {
    $pdo = pdoObject("corcalzpizza");
    
    $sql = "SELECT * FROM ingredients";
    $ingredients = $pdo->prepare($sql);
    try {
        $ingredients->execute(array());
        foreach($ingredients as $ingredient) {
            $ingredient_id = "${ingredient['ingredient_id']}";
            ?>
            <div class="productBox">
                <img src="../images/<?=$ingredient['ingredient_image']?>" class="pizzaImage">
                <h3 class="pizzaName">pizza <?=$ingredient['ingredient_name']?></h3>
                <div class="productDescriptionBox">
                    <p class="productDescription"><?=$ingredient['description']?></p>
                    <p>prijs €<?=$ingredient['price']?></p>
                </div>
            </div>
            <?php
            
        }
    }
    catch(PDOException $e) {
        echo "<br>$e";
    };
};

//sql statement to get the product based on product id
function getProductId($product_id) {
    $pdo = pdoObject("corcalzpizza");
    $sql = "SELECT * FROM products WHERE product_id= :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':product_id', $product_id);
    
    $stmt->execute();
    return $stmt;
}

//shows the product that came out of getProductId()
function showProduct() {
    $pdo = pdoObject('corcalzpizza');
    $productData = $_GET['product_id'];
    $dataFile = getProductId($productData);
    
    foreach($dataFile as $product) {
        $product_price = $product['price'];
        ?>
        <section id="buyProductImage">
            <img src="../images/<?=$product['product_image']?>" class="buyProductImage">
        </section>
        <section class="buyProductInfo">
            <h2 class="buyPizzaName">pizza <?=$product['product_name']?></h2>
                <form action="home.php" method="post">
                    <input type="hidden" name="id" value="<?=$product['product_id']?>">
                    <section id="chooseSize">
                        <h4>kies grootte</h4>
                        <input type="radio" name="size" id="medium" value="medium" checked='checked'>
                        <label for="medium">medium</label><br>
                        <input type="radio" name="size" id="large" value="large">
                        <label for="large">large</label><br>
                        <input type="radio" name="size" id="calzone" value="calzone">
                        <label for="calzone">calzone</label>
                    </section>
                    <section id="amount">
                        <label for="amount">hoeveelheid</label><br>
                        <input type="number" id="amountInputField" name="amount" class="inputField" oninput="getValue()" value="1">
                    </section>
                    <input type="hidden" name="action" value="setInCart">
                    <h2 class="totaal" id="totaalText">prijs per stuk: €<?=$product_price?></h2>
                    <input type="submit" name="setInCart" value="zet in winkelwagen" id="submitButton">
                </form>
        </section>

<!-- script function to change the h2 class=totaal tag to correct pricing-->
    	<script>
            const totaalText = document.getElementById('totaalText');
            const radioButtons = document.querySelectorAll('input[type="radio"][name="size"]');
            let selectedValue = null;
            var amountValue = 1;
            var php = <?php echo $product_price; ?>;
            
            radioButtons.forEach((radioButton) => {
                radioButton.addEventListener('change', (event) => {
                    if (radioButton.checked) {
                        selectedValue = radioButton.value;
                        console.log('Selected value:', selectedValue);

                        if (selectedValue == "medium") {
                            <?php
                            $product_price = $product['price']; 
                            $product_price += 0;
                            ?>;
                            totaalText.innerHTML = "prijs per stuk: €<?=$product_price?>";
                        }
                        if (selectedValue == "large") {
                            <?php 
                            $product_price = $product['price'];     
                            $product_price += 1;
                            ?>;
                            totaalText.innerHTML = "prijs per stuk: €<?=$product_price?>";
                            console.log(<?=$product_price?>);
                        }
                        if (selectedValue == "calzone") {
                            <?php 
                            $product_price = $product['price'];    
                            $product_price += 2;
                            ?>;
                            totaalText.innerHTML = "prijs per stuk: €<?=$product_price?>";
                            console.log(<?=$product_price?>);
                        }
                        if (selectedValue == null) {
                            <?php
                                $product_price = $product['price'];
                            ?>;
                        }
                    }
                });
            });
        </script>

        <?php
    }
}


?>