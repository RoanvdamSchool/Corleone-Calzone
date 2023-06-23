<?php

$serverName = "localhost";
$user = "root";
$password = "";
$dbname = "corcalzpizza";

try {
  $pdo = new PDO("mysql:host=$serverName;dbname=$dbname", $user, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$sql = "CREATE TABLE IF NOT EXISTS users (
    user_id mediumint AUTO_INCREMENT PRIMARY KEY,
    user_name varchar(30),
    password varchar(15),
    is_admin BOOLEAN,
    created_at DATE
)
";
$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS user_order_address (
    user_address_id mediumint AUTO_INCREMENT PRIMARY KEY,
    user_id mediumint,
    address varchar(255),
    postal_code varchar(6),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
)
";
$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS products (
    product_id bigint AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    product_name varchar(50),
    product_image varchar(255),
    size varchar(7),
    price DECIMAL(10, 2)
)
";
$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS ingredients (
    ingredient_id bigint AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    ingredient_name varchar(50),
    ingredient_image varchar(255),
    price DECIMAL(10, 2),
    stock mediumint
)
";
$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS invoice_line (
    invoice_line_id bigint AUTO_INCREMENT PRIMARY KEY,
    user_id mediumint,
    product_id bigint,
    ingredient_id bigint,
    product_amount mediumint,
    product_size varchar(7),
    ingredient_amount mediumint,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    FOREIGN KEY (ingredient_id) REFERENCES ingredients(ingredient_id)
)";

$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS invoice (
    invoice_id bigint AUTO_INCREMENT PRIMARY KEY,
    order_date DATE,
    user_id mediumint,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
)";
$pdo->exec($sql);

/* INGREDIENTS */
// $sql = "INSERT INTO `ingredients` (`ingredient_id`, `description`, `ingredient_name`, `price`, `stock`, `ingredient_image`) VALUES (NULL, 'yammie yammie,\r\noverheerlijke stukjes \r\nananas voor op jouw \r\npizza', 'ananasstukjes', '0.50', '100', '../images/ananasStukjes.jpg');";

// $pdo->exec($sql);

// $sql = "INSERT INTO `ingredients` (`ingredient_id`, `description`, `ingredient_name`, `price`, `stock`, `ingredient_image`) VALUES (NULL, 'stukjes salami voor op je pizza, komt in setjes van 5', 'salami', '1.00', '250', '../images/salami.jpg');";
// $pdo->exec($sql);

// $sql = "INSERT INTO `ingredients` (`ingredient_id`, `description`, `ingredient_name`, `price`, `stock`, `ingredient_image`) VALUES (NULL, '250 gram kaas voor als kaas op je bodem niet genoeg is', 'kaas', '0.75', '300', '../images/kaas.jpg');";
// $pdo->exec($sql);


// $sql = "INSERT INTO `ingredients` (`ingredient_id`, `description`, `ingredient_name`, `price`, `stock`, `ingredient_image`) VALUES (NULL, 'prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto', 'prosciutto', '1.50', '50', '../images/prosciutto.jpg');";
// $pdo->exec($sql);

// /* PRODUCTS */
// $sql = "INSERT INTO `products` (`product_id`, `description`, `product_name`, `price`, `product_image`, ) VALUES (NULL, 'overheerlijke pizza met ananas!! zoals het hoort..', 'hawaii', '5.95', '../images/pizzaHawaii.jpg', );";

// $pdo->exec($sql);

$sql = "INSERT INTO `products` (`product_id`, `description`, `product_name`, `price`, `product_image`) VALUES (NULL, 'pizza met salami, voor als je van wieners houdt.', 'salami', '3.95', '../images/pizzaSalami.jpg');";
$pdo->exec($sql);

$sql = "INSERT INTO `products` (`product_id`, `description`, `product_name`, `price`, `product_image`) VALUES (NULL, 'pizza met extra kaas, voor de echte Hollanders', 'margherita', '7.95', '../images/pizzaMargherita.jpg');";
$pdo->exec($sql);

$sql = "INSERT INTO `products` (`product_id`, `description`, `product_name`, `price`, `product_image`) VALUES (NULL, 'pizza met prosciutto, echte Italiaanse pizza.', 'prosciutto', '10.95', '../images/pizzaProsciutto.jpg');";
$pdo->exec($sql);
?>