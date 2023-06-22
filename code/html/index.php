
<?php
    
    include("headerLogin.php");
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
