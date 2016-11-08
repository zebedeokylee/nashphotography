  <nav>
   <?php
	if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
		echo "<div class=\"logout\"><a href=\"handlers/logoutHandler.php\">Logout</a></div>";
	}
   ?>
   <div class="logo">
    <a href="index.php"><img src="logo.png"/></a>
   </div>
   <div>
	<ul class="center">
     <li><a class="navFont" href="gallery.php">Gallery</a></li>
     <li><a class="navFont" href="customerPhotosLogin.php">Customer Photos</a></li>
     <li><a class="navFont" href="pricing.php">Pricing</a></li>
     <li><a class="navFont" href="contact.php">Contact</a></li>
    </ul>
   </div>
  </nav>
