<?php
 if(!isset($_SESSION))
	session_start();

 if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
    if(isset($_SESSION["adminPermission"]) && $_SESSION["adminPermission"]) {
		header("Location: customerPhotosAdmin.php");
	} else {
 		header("Location: customerPhotos.php");
	}
 }

 print_r($_SESSION);
 
 $username = "";
 if(isset($_SESSION["username"])) {
 	$username = $_SESSION["username"]; 
 }

?>

<html>
 <head>
  <title>Nash Photography - Customer Login</title>
  <?php 
   require_once("links.php");
  ?>
 </head>

 <body class="greenBackground">
  <?php 
   require_once("navigation.php");
  ?>

  <form class="login" action="handlers/loginHandler.php" method="POST">
   <div>
	<label for="username">Username: </label>
    <input type="text" name="username" id="username" value="<?php echo $username; ?>"/>
   </div>
   <div>
    <label for="password">Password: </label>
    <input type="password" name="password" id="password" value="">
   </div>
   <div>
    <input type="submit" value="Login"/>
   </div>
  </form>
  
  <?php
   require_once("footer.php");
  ?>
 </body>

</html>

