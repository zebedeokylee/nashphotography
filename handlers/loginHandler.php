<?php
 if(!isset($_SESSION))
	session_start();
 require_once("../Dao.php");
 
 $dao = new Dao();
 $users = $dao->login($_POST["username"], $_POST["password"]);
 if(sizeof($users) == 1) {
	$_SESSION["loggedIn"] = true;
  	$_SESSION["userId"] = $users[0]["id"];
	if($users[0]["adminPermission"] == 0) {
		$_SESSION["adminPermission"] = false;
		header("Location: ../customerPhotos.php");
	} else {
		$_SESSION["adminPermission"] = true;
		header("Location: ../customerPhotosAdmin.php");
	} 
 } else { 
 	$status = "Invlaid username or password";
  	$_SESSION["status"] = $status;
	$_SESSION["username"] = $_POST["username"];
	$_SESSION["loggedIn"] = false;
	header("Location: ../customerPhotosLogin.php");
 }
