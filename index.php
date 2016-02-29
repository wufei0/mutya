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

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" 
  type="image/png" 
  href="images/icon.png" />
<title>
    MUTYA NIGHT 2016
</title>

<link rel="stylesheet" type="text/css" href="css/index.css" />
<link href="css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>




<div class="container">
  <!--<div class="login">

    
    <form method="post" action="login.php">
      <p>
      <input type="text" name="username" value="" id="icon"  placeholder="Username"></p>
      <p><input type="password" name="password" value="" id="iconkey" placeholder="Password"></p>
      
      <p class="submit"><input type="submit" name="commit" value="Login"></p>
    </form>
  </div>-->


		<div class="card">
			    <h1 class="title">Mutia ti La Union 2016</h1>
			    <form method="post" action="login.php">
			      <div class="input-container">
			        <input type="text" name="username" value="" id="icon" required="required"/>
			        <label for="Username">Username</label>
			        <div class="bar"></div>
			      </div>
			      <div class="input-container">
			        <input type="password" name="password" value="" id="iconkey" required="required"/>
			        <label for="Password">Password</label>
			        <div class="bar"></div>
			      </div>
			      <div class="button-container">
			        <input type="submit" name="commit" value="Login" class="btn btn-primary" />
			      </div>
			      
			    </form>
  	</div>
  	
  	<!--<div class="card alt">
		    <div class="toggle">
		    	
		    </div>	       
  	</div>--> 
	
	
</div>






</body>
</html>