<?php
include("head.php");
include("header.php");
?>
<div id="buyProductBox" class="col-10 offset-1">
    <section id="buyProductImage">
        <img src="../images/pizzaHawaii.jpg" class="buyProductImage">
    </section>
    <section class="buyProductInfo">
        <h2 class="buyPizzaName">pizza hawaii</h2>
            <form action="home.php">
                <section id="chooseSize">
                    <h4>kies grootte</h4>
                    <input type="radio" name="medium" value="medium">
                    <label for="medium">medium</label><br>
                    <input type="radio" name="large" value="large">
                    <label for="large">large</label><br>
                    <input type="radio" name="calzone" value="calzone">
                    <label for="calzone">calzone</label>
                </section>
                <section id="amount">
                    <label for="amount">hoeveelheid</label><br>
                    <input type="number" name="amount" class="inputField">
                </section>
                <input type="submit" value="zet in winkelwagen" id="submitButton">
            </form>
    </section>
</div>
<?php
include("bottom.php");
?>