<?php
  require_once 'config_seesion.inc.php';
  require_once 'signup_view.inc.php';
  require_once 'login_view.inc.php';
include 'header_public.php'
?>


<div class="boody">
    <div class="form-container">
        <h2>Login and Sign Up</h2>
        <form action="login.inc.php" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <button  class="vv" type="submit">Log In</button>
        </form>

        <?php


check_login_errors();
    ?>

        <div class="form-separator">or</div>
        <form action="signup.inc.php" method="POST">
        <?php
 signup_inputs()    ?>

            <button class="vv" type="submit">Sign Up</button>
        </form>
    </div>

    <?php


check_signup_errors();
    ?>
</div>
    
<?php include '../authore/footer.php'?>

