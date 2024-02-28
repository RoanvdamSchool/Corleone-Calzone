<?php
/*include("databaseFunctions.php");*/
function pdoObjectCart($dbname) {
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
//function to check if the size and id are inside the session
function checkIfItemIsInCart() {
    $isNewItem = true;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item["id"] == $_POST['id'] && $item['size'] == $_POST['size']) {
                $item['amount'] += intval($_POST['amount']);
                $isNewItem = false;
                break;
            }
        }
        if ($isNewItem && isset($_POST['id']) && isset($_POST['size']) && isset($_POST['amount']) ) {
            array_push($_SESSION["cart"], [ "id" => $_POST['id'], "size" => $_POST["size"], "amount" => intval($_POST["amount"]) ]);
            $_POST['id'] = null;
            $_POST['size'] = null;
            $_POST['amount'] = null;
            $isNewItem = false;
        }
        
}

function addIngredientToCart() {
    $isNewItem = true;
    foreach ($_SESSION['cart'] as $item) {
        if (isset($item['ingr_id']) && $item['ingr_id'] == $_POST['ingr_id']) {
            $item['amountIngr'] += intval($_POST['amountIngr']);
            $isNewItem = false;
            break;
        }    
    }
     if ($isNewItem && isset($_POST['ingr_id']) && isset($_POST['amount']) ) {
        array_push($_SESSION['cart'], ["ingr_id" => $_POST['ingr_id'], "amountIngr" => $_POST['amount'] ]);
        $_POST['ingr_id'] = null;
        $_POST['amount'] = null;
        $isNewItem = false;
        
    }
}

//function to create a session cart and uses checkifitemisincart function
function shoppingCart() {
    $pdo = pdoObjectCart("colcalzpizza");
    if (isset($_POST["setInCart"]) && $_POST["action"] == "setInCart") {
        if (!isset($_SESSION["cart"]) ) {
            $_SESSION["cart"] = [];
        }
        else {
            checkIfItemIsInCart();
        }
    }
    if (isset($_POST['buy_ingr']) && $_POST['action'] == "setInCart") {
        if (!isset($_SESSION["cart"]) ) {
            $_SESSION["cart"] = [];
        }
        else {
            addIngredientToCart();
        }
    }
}

//function to check if there are 10 or more large size hawaii so that ingredien.php can be accessed
function checkForPepperoniPizza() {
    $pdo = pdoObjectCart('corcalzpizza');
    $sql = "SELECT * FROM products WHERE product_id = :product_id";
    $stmt = $pdo->prepare($sql);

    foreach ($_SESSION['cart'] as $item) {
        $stmt->bindParam(':product_id', $item['id']);
        $stmt->execute();

        $products = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($item['size']) ) {
            if ($products['product_name'] == 'hawaii' && $item['amount'] >= 10 && $item['size'] == 'large') {
                ?>
                <script>
                    const ingredientLink = document.getElementById('linkToIngredients');
                    ingredientLink.style.display = 'block';
                </script>
                <?php
            }
        }
    }
}

// function to print every item in shopping cart
function printShoppingCart() {
    $totalPrice = 0.00;
    $pdo = pdoObjectCart('corcalzpizza');
    $sqlProducts = "SELECT * FROM products WHERE product_id = :product_id";
    $stmtProducts = $pdo->prepare($sqlProducts);

    $sqlIngredient = "SELECT * FROM ingredients WHERE ingredient_id = :ingredient_id";
    $stmtIngredients = $pdo->prepare($sqlIngredient);
    
    foreach ($_SESSION['cart'] as $item) {
        $stmtProducts->bindParam(':product_id', $item['id']);
        $stmtProducts->execute();
        $stmtIngredients->bindParam(':ingredient_id', $item['ingr_id'] );
        $stmtIngredients->execute();
        
        $ingredients = $stmtIngredients->fetch(PDO::FETCH_ASSOC);
        $products = $stmtProducts->fetch(PDO::FETCH_ASSOC);
        
        $price = 0.00;
        if (isset($item['size']) ) {
            if ($item['size'] == "medium") {
                $price = $products['price'];
            }
            if ($item['size'] == "large") {
                $price = $products['price'] + 1;
            }
            if ($item['size'] == "calzone") {
                $price = $products['price'] + 2;
            }
            if ($item['amount'] >= 2) {
                $priceProduct = $price + ($price *($item['amount']-1) / 2);
            }
            else {
                $priceProduct = $price;
            }
        }
        else {
            $price = $ingredients['price'];
            $priceProduct = $price * $item['amountIngr'];
        }
        
        $totalPrice += $priceProduct;
        if (isset($item['id'])) {
            ?>
            <div class="shoppingCartItem">
                <img class="shoppingCartItemImage" src="../images/<?=$products['product_image']?>">
                <h2 class="shoppingCartItemName"><?=$products['product_name']?> <?=$item['size']?></h2>
                <h2 class="shoppingCartItemPrice">p.st: €<?=number_format($price, 2, '.', '');?></h2>
                <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="shoppingCartItemAmount">
                    <a href="shoppingCart.php?min=<?=$item['id']?>_<?=$item['size']?>">delete</a>
                    <input type="number" name="amount" class="inputField" id="amount_<?=$products['product_id']?><?=$item['size']?>" value="<?=$item['amount']?>">
                    <a href="shoppingCart.php?plus=<?=$item['id']?>_<?=$item['size']?>">add</a>
                </form>
            </div>
            <?php
            if (isset($_GET['plus'])) {
                $item['amount']++;
                $amountOf = $item['amount'];
            } 
            if(isset($_GET['min'])) {
                if ($item['amount'] >= 1) {
                    $item['amount']--;
                }
                if ($item['amount'] == 0) {
                    unset($item);
                }
            }
        }
        if (isset($item['ingr_id'])) {
        ?>
            <div class="shoppingCartItem">
                <img class="shoppingCartItemImage" src="../images/<?=$ingredients['ingredient_image']?>">
                <h2 class="shoppingCartItemName"><?=$ingredients['ingredient_name']?></h2>
                <h2 class="shoppingCartItemPrice">p.st: €<?=number_format($price, 2, '.', '');?></h2>
                <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="shoppingCartItemAmount">
                    <a href="shoppingCart.php?min=<?=$item['id']?>">delete</a>
                    <input type="number" name="amount" class="inputField" id="amount_<?=$ingredients['ingredient_id']?>" value="<?=$item['amountIngr']?>">
                </form>
            </div>
        <?php
        }
    }
        ?>
    <a href="ingredient.php" id='linkToIngredients'>extra opties</a>
    <h1 class="shoppingCartItemPrice" id="totalPrice">totale prijs: €<?=number_format($totalPrice, 2, '.', '')?></h1>

    <form action="paymentSuccessful.php" method="post">
        <input type="submit" name='pay' value="betaal">
    </form>
<?php
       payment();
}

function printShoppingCartIngr() {
    $totalPrice = 0.00;
    $pdo = pdoObjectCart('corcalzpizza');
    $sqlIngredient = "SELECT * FROM ingredients WHERE ingredient_id = :ingredient_id";
    $stmtIngredients = $pdo->prepare($sqlIngredient);
}

//function to print out the payment the user has made
function printPayment() {
    $pdo = pdoObjectCart('corcalzpizza');
    if (isset($_POST['pay']) ) {
        if (!empty($_SESSION['cart']) ) {
            $totalPrice = 0.00;
            $pdo = pdoObjectCart('corcalzpizza');
            $sqlpro = "SELECT * FROM products WHERE product_id = :product_id";
            $stmtpro = $pdo->prepare($sqlpro);
            
            $sqlingr = "SELECT * FROM ingredients WHERE ingredient_id = :ingredient_id";
            $stmtingr = $pdo->prepare($sqlingr);

            foreach ($_SESSION['cart'] as $item) {
                $stmtpro->bindParam(':product_id', $item['id']);
                $stmtpro->execute();
                
                $stmtingr->bindParam(':ingredient_id', $item['ingr_id']);
                $stmtingr->execute();
                
                $ingredients = $stmtingr->fetch(PDO::FETCH_ASSOC);
                
                $products = $stmtpro->fetch(PDO::FETCH_ASSOC);
                $price = 0.00;
                if (isset($item['size']) ) {
                    if ($item['size'] == "medium") {
                        $price = $products['price'];
                    }
                    if ($item['size'] == "large") {
                        $price = $products['price'] + 1;
                    }
                    if ($item['size'] == "calzone") {
                        $price = $products['price'] + 2;
                    }
                    if ($item['amount'] >= 2) {
                        $priceProduct = $price + ($price *($item['amount']-1) / 2);
                    }
                    else {
                        $priceProduct = $price;
                    }
                }
                else {
                    $price = $ingredients['price'];
                    $priceProduct = $price * $item['amountIngr'];
                }

                $totalPrice += $priceProduct;
                if(isset($item['id'])) {
                    ?>
                    <div class="paymentReceiptInfoText">
                        <h2><?=$item['amount']?>* <?=$products['product_name']?> <?=$item['size']?></h2>
                        <h2><?=number_format($priceProduct, 2, '.', '')?></h2>
                    </div>
                    <?php
                }
                if (isset($item['ingr_id']) ) {
                    ?>
                    <div class="paymentReceiptInfoText">
                        <h2><?=$item['amountIngr']?>* <?=$ingredients['ingredient_name']?></h2>
                        <h2><?=number_format($priceProduct, 2, '.', '')?></h2>
                    </div>
                    <?php
                }
            }
            ?>
            <h3>totaalprijs: €<?=number_format($totalPrice, 2, '.', '')?></h3>
            <?php
        }
        else {
            header('location: home.php');
        }
    }
}

//function to add the session to the database if the user has payed
function payment() {
    $pdo = pdoObjectCart('corcalzpizza');
    if (isset($_POST['pay']) ) {
        if (!empty($_SESSION['cart']) ) {
            try {
                $stmt = $pdo->prepare("INSERT INTO invoice (user_id) VALUES (?)");
                $stmt->execute([$_SESSION['user']['id']]);

                foreach ($_SESSION['cart'] as $item) {
                    $sql = "INSERT INTO invoice_line (user_id, product_id, product_amount, product_size, ingredient_id, ingredient_amount) VALUES (?, ? , ? , ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    if (!isset($item['id']) ) {
                        $item['id'] = null;
                    }
                    if (!isset($item['size'])) {
                        $item['size'] = null;
                    }
                    if (!isset($item['amount']) ) {
                        $item['amount'] = null;
                    }
                    if (!isset($item['ingr_id']) ) {
                        $item['ingr_id'] = null;
                    }
                    if (!isset($item['amountIngr']) ) {
                        $item["amountIngr"] = null;
                    }
                    $stmt->execute([$_SESSION['user']['id'] , $item['id'] ,$item['amount'], $item['size'], $item['ingr_id'], $item['amountIngr']]);
                }
                unset($_SESSION['cart']);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}
?>
