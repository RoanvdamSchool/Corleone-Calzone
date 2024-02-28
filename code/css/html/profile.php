<div class="pizzaBackground"></div>
<?php
 include("headerMain.php");

 error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST)) {
    $pdo = pdoObject('corcalzpizza');
    $query = "
      UPDATE `users`
      SET user_name = :value
      WHERE user_id = :id;
    ";
    $sto = $pdo->prepare($query);
    $sto->execute([
        ':value' => $_POST['username'],
        ':id' => $_SESSION['user']['id']
    ]);
}
 $pdo = pdoObject('corcalzpizza');
 $query = "
   SELECT *
   FROM `users`
   WHERE user_id = :user
 ";
 $sto = $pdo->prepare($query);
 $sto->execute([
   ':user' => $_SESSION["user"]["id"]
 ]);
 $fetch = $sto->fetch(PDO::FETCH_ASSOC);
 
?>
<main>
    <form method="post" class="profile">
    <input type='text' name='username' value='<?= $fetch["user_name"] ?>'>
        <p class="color"><?= $fetch["created_at"] ?></p>
        <input type='submit' value='Update'>
    </form>
</main>
<?php
  include("footer.php");  
?>
