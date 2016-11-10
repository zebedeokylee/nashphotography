<?php
 if(!isset($_SESSION))
	session_start();

 require_once("../Dao.php");

 //Check that the username and password were given
 $status = "";
 if(!isset($_POST["username"]) || (isset($_POST["username"]) && $_POST["username"] == "")){
 	$status = "Username is a required field. ";
 }
 if(!isset($_POST["password"]) || (isset($_POST["password"]) && $_POST["password"] == "")){
 	$status .= "Password is a required field. ";
 }
 if($status != "") {
	if(isset($_POST["username"])) 
		$_SESSION["username"] = $_POST["username"];
  	$_SESSION["status"] = $status;
	header("Location: ../customerPhotosLogin.php"); 
    exit;
 }

 //Unset variables 
 if(isset($_SESSION["username"])) {
	unset($_SESSION["username"]); 	
 } 
 if(isset($_SESSION["status"])) {
	unset($_SESSION["status"]);
 }
 

 //Check that user and password are in the database 
 $dao = new Dao();
 try {
 	$users = $dao->login($_POST["username"], $_POST["password"]);
 } catch(Exception $e) {
  	$_SESSION["status"] = "Error when locating user"; 
	header("Location: ../customerPhotosLogin.php"); 
	exit;
 }

 if(sizeof($users) == 1) {
	$_SESSION["loggedIn"] = true;
  	$_SESSION["userId"] = $users[0]["id"];
    
	//Unset username session variable since we don't need it 
    if(isset($_SESSION["username"])) {
		unsset($_SESSION["username"]);
	}

	//Reroute user based on adminpermission
	if($users[0]["adminPermission"] == 0) {
		$_SESSION["adminPermission"] = false;
 		header("Location: customerPhotosHandler.php");
		exit;
	} else {
		$_SESSION["adminPermission"] = true;
		header("Location: ../customerPhotosAdmin.php");
		exit;
	} 
 } else {
	$status = "Invlaid username or password";
  	$_SESSION["status"] = $status;
	$_SESSION["username"] = $_POST["username"];
	$_SESSION["loggedIn"] = false;
	header("Location: ../customerPhotosLogin.php");
 }
