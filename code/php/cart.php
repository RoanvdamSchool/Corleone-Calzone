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

function shoppingCart() {
    $pdo = pdoObjectCart("colcalzpizza");
    if (isset($_POST["setInCart"]) && $_POST["action"] == "setInCart") {
        echo "<script>alert('product is in winkelwagen')</script>";
        if (!isset($_SESSION["cart"]) ) {
            $_SESSION["cart"] = [];
        }
        else {
            if () {
                
            }
           array_push($_SESSION["cart"], [ "id" => $_POST['id'], "size" =>$_POST["size"], "amount" =>$_POST["amount"] ]);
            var_dump($_SESSION["cart"]);
        }
    }
}


?>