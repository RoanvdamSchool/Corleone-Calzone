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

function checkIfItemIsInCart() {
    $isNewItem = true;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item["id"] == $_POST['id'] && $item['size'] == $_POST['size']) {
                $item['amount'] += intval($_POST['amount']);
                echo "<script>alert('product bestaat al')</script>";
                $isNewItem = false;
                break;
            }
        }
        if ($isNewItem && isset($_POST['id']) && isset($_POST['size']) && isset($_POST['amount']) ) {
            echo "<script>alert('product is in winkelwagen')</script>";
            array_push($_SESSION["cart"], [ "id" => $_POST['id'], "size" => $_POST["size"], "amount" => intval($_POST["amount"]) ]);
            echo $_POST['id'] . " " . $_POST['size'] . " " . $_POST['amount'];
            $_POST['id'] = null;
            $_POST['size'] = null;
            $_POST['amount'] = null;
            $isNewItem = false;
        }
    var_dump($_SESSION["cart"]);
    var_dump($_SESSION);
}

function shoppingCart() {
    $pdo = pdoObjectCart("colcalzpizza");
    if (isset($_POST["setInCart"]) && $_POST["action"] == "setInCart") {
        //echo "<script>alert('product is in winkelwagen')</script>";
        if (!isset($_SESSION["cart"]) ) {
            $_SESSION["cart"] = [];
        }
        else {
            checkIfItemIsInCart();
        }
    }
}

function printShoppingCart() {
    $totalPrice = 0.00;
$pdo = pdoObjectCart('corcalzpizza');
$sql = "SELECT * FROM products WHERE product_id = :product_id";
$stmt = $pdo->prepare($sql);

    foreach ($_SESSION['cart'] as $item) {
        $stmt->bindParam(':product_id', $item['id']);
        $stmt->execute();

        $products = $stmt->fetch(PDO::FETCH_ASSOC);
        $price = 0.00;
        if ($item['size'] == "medium") {
            $price = $products['price'];
        }
        if ($item['size'] == "large") {
            $price = $products['price'] + 1;
        }
        if ($item['size'] == "calzone") {
            $price = $products['price'] + 2;
        }
        $priceProduct = $price * $item['amount'];
        $totalPrice += $priceProduct;
        ?>
        <div class="shoppingCartItem">
            <img class="shoppingCartItemImage" src="<?=$products['product_image']?>">
            <h2 class="shoppingCartItemName"><?=$products['product_name']?> <?=$item['size']?></h2>
            <h2 class="shoppingCartItemPrice">p.st: €<?=number_format($price, 2, '.', '');?></h2>
            <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="shoppingCartItemAmount">
                <a href="shoppingCart.php?min=<?=$item['id']?>_<?=$item['size']?>">delete</a>
                <input type="number" name="amount" class="inputField" id="amount_<?=$products['product_id']?><?=$item['size']?>" value="<?=$item['amount']?>">
                <a href="shoppingCart.php?plus=<?=$item['id']?>_<?=$item['size']?>">add</a>
            </form>
        </div>
        <!--<script>
            const amountInput_<?=$products['product_id']?> = document.getElementById("amount_<?=$products['product_id']?><?=$item['size']?>");
            amountInput_<?=$products['product_id']?>.addEventListener('input', (event) => {
                let amountValue = event.target.value;
                <?php
                    //$item['amount'] = "<script>document.write(amountValue)</script>";
                ?>
                // Perform any desired actions with the updated amount value
                console.log(amountValue);
            });
        </script>-->
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
    ?>
    <a href="ingredient.php">extra opties</a>
    <h1 class="shoppingCartItemPrice" id="totalPrice">totale prijs: €<?=number_format($totalPrice, 2, '.', '')?></h1>

    <form action="paymentSuccessful.php" method="post">
        <input type="submit" name='pay' value="betaal">
    </form>
<?php
        var_dump($_SESSION['cart']);
        payment();
}

function payment() {
    $pdoconn = pdoObjectCart('corcalzpizza');
    if (isset($_POST['pay']) ) {
        if (!empty($_SESSION['cart']) ) {
            try {
                $stmt = $pdoconn->prepare("INSERT INTO invoice (user_id) VALUES (?)");
                $stmt->execute([$_SESSION['user']['id']]);

                foreach ($_SESSION['cart'] as $item) {
                    $pdo = "INSERT INTO invoice_line (user_id, product_id, product_amount, product_size) VALUES (?, ? , ? , ?)";
                    $stmt = $pdoconn->prepare($pdo);
                    $stmt->execute([$_SESSION['user']['id'] , $item['id'] ,$item['amount'], $item['size']]);
                }
                unset($_SESSION['cart']);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}
?>
