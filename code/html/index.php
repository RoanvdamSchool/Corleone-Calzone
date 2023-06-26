
<?php
    
    include("headerLogin.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include("../php/databaseFunctions.php");

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



  if (!empty($fetch) && password_verify("tJ8!kE5}vE4^cV8<" . $password . "pX6jaQ2@fS5/rB2)", $fetch['password'])) {
    header('Location: home.php');
  }

 
  $_SESSION['user'] = null;
  $_SESSION['user']['id'] = $fetch['user_id'];
  $_SESSION['user']['username'] = $fetch['user_name'];

  // Redirect naar home.php of een andere pagina na succesvolle login
}

if (session_status() === PHP_SESSION_NONE) session_start();

?>
<div class="pizzaBackground"></div>
<div class="username">
  <h2>Login Form</h2>

  <form action="" method="POST">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>

<div class="buttons">
  <input type="submit" value="Submit">
  <a href="signUp.php">Sign Up</a>
  <a href="changePassword.php">Password vergeten</a>
</div>
  </form>
</div>


<?php
    include("bottom.php");
?>
