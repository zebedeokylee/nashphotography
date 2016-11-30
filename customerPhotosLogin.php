<?php
 if(!isset($_SESSION))
	session_start();

 //if user is already logged in, redirect to correct customer page based on admin permission
 if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
    if(isset($_SESSION["adminPermission"]) && $_SESSION["adminPermission"]) {
		header("Location: customerPhotosAdmin.php");
		exit;
	} else {
 		header("Location: handlers/customerPhotosHandler.php");
		exit;
	}
 }
 
 //Select Page
 $_SESSION["selectedPage"] = "customerPhotos";

 //Get info from unsuccessful login attempt and clear it
 $username = "";
 if(isset($_SESSION["username"])) {
 	$username = $_SESSION["username"]; 
 } 
 
 $status = "";
 if(isset($_SESSION["status"])) {
 	$status = $_SESSION["status"];
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
   <div class="columns">
	<div class="column columnLabels">
	 <div>
	  <div><label for="username">Username: </label></div>
      <div><label for="password">Password: </label></div>
     </div>
    </div>
    <div class="column">
     <div><input type="text" name="username" id="username" value="<?php echo htmlentities($username); ?>"/></div>
     <div><input type="password" name="password" id="password" value=""></div>
     <div class="submit">
      <input type="submit" value="Login"/>
     </div>
    </div>
   </div>

   <?php
	if($status != "") {
	 echo "<div class=\"errorMessage\">$status</div>";
    }
   ?>
  </form>
 
  <?php
   require_once("footer.php");
  ?>
 </body>

</html>

