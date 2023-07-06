<?php
    
    include("headerLogin.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup Page</title>
    
</head>
<body>
<div class="pizzaBackground"></div>
    <div class="signup-form">
        <h2>Sign Up</h2>
        <form action="signup.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <a href="../index.php">of login hier</a>
            <input type="submit" value="Sign Up">
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
        INSERT INTO `users` (user_name, password)
        VALUES (:user, :password);
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

    header("Location: ../index.php");
}
?>

