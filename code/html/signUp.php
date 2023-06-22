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

            <input type="submit" value="Sign Up">
        </form>
    </div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Process the submitted data
    // ...

    // Example code for hashing the password
    $hashed_passwd = password_hash("tJ8!kE5}vE4^cV8<" . $password . "pX6jaQ2@fS5/rB2)", CRYPT_SHA256);
    echo $hashed_passwd;
    header("Location: home.php");
    exit();
}
?>

