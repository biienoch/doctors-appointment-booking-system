<?php
    require_once 'includes/header.php';
       
    ?>
    <div>
     <h1>Register</h1>
     <form action="includes/register-inc.php" method="post">
         <input type="text" name="username" placeholder="username">
         <input type="password" name="password" placeholder="password">
         <input type="confirmpassword" name="confirmPassword" placeholder="confirmPassword">

         <button type="submit" name="submit">Register</button>
         <p>already have an account? <a href="login.php">login</a></p>
        </form>
        </div>
    <?php
    require_once 'includes/footer.php';
    ?>