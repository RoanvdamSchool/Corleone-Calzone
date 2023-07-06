<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>corleone calzone pizza</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="icon" type="image/x-icon" href="images/favicon.ico">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/styleAnouk.css" rel="stylesheet">
        <link href="css/styleMax.css" rel="stylesheet">
        <link href="css/styleRoan.css" rel="stylesheet">
    </head>
    <body>
        
        <header>
            <h1 id="websiteNameLogin">Corleone Calzone Pizza</h1>
            <img id="websiteLogoLogin" src="images/carleone%20calzone_LOGO.png" alt="websiteLogo">
        </header>
        <?php
        if (session_status() === PHP_SESSION_NONE) session_start();
        
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include("php/databaseFunctions.php");

  if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header('Refresh:0');
  }

  // Gebruikersnaam en wachtwoord ontvangen via het POST-verzoek
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Hash het wachtwoord
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Hier kun je de gehashte gebruikersnaam en wachtwoord opslaan in de database
  $pdo = pdoObject('corcalzpizza');
  $query = "
    SELECT *
    FROM `users`
    WHERE user_name = :user
  ";
  $sto = $pdo->prepare($query);
  $sto->execute([
    ':user' => $username
  ]);
  $fetch = $sto->fetch(PDO::FETCH_ASSOC);

    $_SESSION['user'] = null;
    $_SESSION['user']['id'] = $fetch['user_id'];
    $_SESSION['user']['username'] = $fetch['user_name'];
    $_SESSION['user']['is_admin'] = $fetch['is_admin'];

  if (!empty($fetch) && password_verify("tJ8!kE5}vE4^cV8<" . $password . "pX6jaQ2@fS5/rB2)", $fetch['password'])) {
      if ($_SESSION['user']['is_admin'] == 0) {
        header('Location: html/home.php');   
      }
      if ($_SESSION['user']['is_admin'] == 1) {
          header('location: html/admin.php');
      }
  }


  // Redirect naar home.php of een andere pagina na succesvolle login
}

if (session_status() === PHP_SESSION_NONE) session_start();

?>
<div class="pizzaBackground"></div>

  <form action="" class="loginContainer" method="POST">
      <div class="username">
  <h2>Login Form</h2>
    <label for="username">Username:</label><br>
    <input type="text" id="username" class='col-8 offset-2' name="username"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" class="col-8 offset-2" name="password"><br><br>

<div class="buttons">
  <input type="submit" value="Submit">
  <a href="html/signUp.php">account aanmaken</a>
  <a href="html/changePassword.php">Password vergeten</a>
</div>
  </form>
</div>


<?php
    include("html/bottom.php");
?>
