  <nav>
   <?php
 	if(!isset($_SESSION))
		session_start();
	
	if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
		echo "<div class=\"logout\"><a href=\"handlers/logoutHandler.php\"><button>Logout</button></a></div>";
	}
 
	$selectedPage = "";
	if(isset($_SESSION["selectedPage"]))
		$selectedPage = $_SESSION["selectedPage"]; 
	
   ?>
   <div class="logo">
    <a href="index.php"><img src="logo.png"/></a>
   </div>
   <div>
	<ul class="center">
     <li><a class="navFont" <?php echo($selectedPage == "gallery" ? "id=\"selectedPage\"" : ""); ?>" href="gallery.php">Gallery</a></li>
     <li><a class="navFont" <?php echo($selectedPage == "customerPhotos" ? "id=\"selectedPage\"" : ""); ?>" href="customerPhotosLogin.php">Customer Photos</a></li>
     <li><a class="navFont" <?php echo($selectedPage == "pricing" ? "id=\"selectedPage\"" : ""); ?>" href="pricing.php">Pricing</a></li>
     <li><a class="navFont" <?php echo($selectedPage == "contact" ? "id=\"selectedPage\""  : ""); ?>" href="contact.php">Contact</a></li>
    </ul>
   </div>
  </nav>
