<?php

	if (session_status() == PHP_SESSION_NONE) 
	{
	    session_start();
	}

	if(isset($_SESSION['judgename']))
	{
		header('Location:home.php');
		exit();
	}
	
	
	
	
	
	
	include('connection.php');
  global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;
  $con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);

	if (mysqli_connect_error()) 
  {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
  }	
	
	$username=addslashes($_POST['username']);
	$password=addslashes($_POST['password']);
	
	$sqlQuery="SELECT pk_username,name,password FROM tbljudge WHERE pk_username LIKE '". $username ."' 
						AND  password = '". $password ."' ";
	
	
	$result=mysqli_query($con,$sqlQuery);
	
  while($recordSet=mysqli_fetch_array($result))
  {
  	$_SESSION['judgename']=$recordSet['name'];
  	$_SESSION['username']=$recordSet['pk_username'];
  	header('location:home.php');
  	exit();
  }
  
  //unset($_SESSION['judgename']);
  header('location:index.php');
  //exit();
  

?>