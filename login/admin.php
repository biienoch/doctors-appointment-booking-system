<?php
    require_once 'includes/header.php';
       
    ?>
    <div>
     <h1>log in</h1>
     <form action="includes/login-inc.php" method="post">
         <input type="text" name="username" placeholder="username">
         <input type="password" name="username" placeholder="password">

         <button type="submit" name="submit">login</button>
         
        </form>
        </div>
    <?php
    require_once 'includes/footer.php';
    ?>