<?php

if (session_status() == PHP_SESSION_NONE) 
	{
	    session_start();
	}
	
	
	
	include('connection.php');
	  global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
    $con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);
    
    if (mysqli_connect_error()) 
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
				die();
    }
    
    
    
    