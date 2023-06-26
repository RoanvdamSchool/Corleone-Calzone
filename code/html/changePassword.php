<?php
    
    include("headerLogin.php");
    error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>wachtwoord</title>
    
</head>
<body>
<div class="pizzaBackground"></div>
    <div class="signup-form">
        <h2>Password</h2>
        <form action="" method="post">
            <label for="password">username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">new password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="set new password">
        </form>
    </div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../php/databaseFunctions.php");
  
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
      header('Refresh:0');
    }

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $hashed_passwd = password_hash("tJ8!kE5}vE4^cV8<" . $password . "pX6jaQ2@fS5/rB2)", CRYPT_SHA256);

    $pdo = pdoObject('corcalzpizza');
    $query = "
    UPDATE users 
    SET password = :password
    WHERE user_name = :user;
";
    $sto = $pdo->prepare($query);
    try {
        $sto->execute([
            ':user' => $username,
            ':password' => $hashed_passwd
          ]);
    } catch (PDOException $e) {
        die($e);
    }

    header("Location: index.php");
}
?>