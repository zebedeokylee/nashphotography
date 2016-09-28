<html>
 <head>
  <title>Nash Photography - Customer Login</title>
  <?php 
   require_once("links.php");
  ?>
 </head>

 <body class="purpleBackground">
  <?php 
   require_once("navigation.php");
  ?>

  <form class="login">
    Username: <input type="text" name="username">
    Password: <input type="text" name="password">
   <input type="submit" value="Login">
  </form>
 
  
  <?php
   require_once("footer.php");
  ?>
 </body>

</html>

