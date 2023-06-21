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
?>