
<?php
    
    include("headerLogin.php");
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Gebruikersnaam en wachtwoord ontvangen via het POST-verzoek
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Hash het wachtwoord
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Hier kun je de gehashte gebruikersnaam en wachtwoord opslaan in de database

  // Redirect naar home.php of een andere pagina na succesvolle login
  header('Location: home.php');
  exit();
}
?>
<div class="pizzaBackground"></div>
<div class="username">
  <h2>Login Form</h2>

  <form action="home.php" method="POST">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>

    <input type="submit" value="Submit">
  </form>
</div>

<?php
    include("bottom.php");
?>
