<html>
 <head>
  <title>Nash Photography - Admin</title>
  <?php 
   require_once("links.php");
  ?>
 </head>

 <body class="greenBackground">
  
  <img class="newCustomerIcon" src="add.png" title="Create New Customer"/>
  
  <?php 
   require_once("navigation.php");
  ?>

  <div class="customerProfiles center">
     <div>
      <img class="customerProfilePicture" src="photos/main.jpg">
      <div>Customer 1<img class="addIcon" src="add.png"></div>
     </div>
     
     <div>
      <img class="customerProfilePicture" src="photos/main.jpg">
      <div>Customer 2<img class="addIcon" src="add.png"></div>
     </div>
   
     <div>
      <img class="customerProfilePicture" src="photos/main.jpg">
      <div>Customer 3<img class="addIcon" src="add.png"></div>
     </div>
  </div>

  <?php
   require_once("footer.php");
  ?>
 </body>

</html>

