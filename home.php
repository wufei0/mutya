<?php

		if (session_status() == PHP_SESSION_NONE) 
	{
	    session_start();
	}

	if(!isset($_SESSION['judgename']))
	{
			session_destroy();
			header('Location:index.php');
			exit();
	}

	

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" 
  type="image/png" 
  href="images/icon.png" />

    <title>MUTYA 2016 PAGEANT NIGHT</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/index.css" rel="stylesheet" type="text/css" />

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet" />

<?php

		include('connection.php');
	  global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;
    $con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);
?>

  </head>

  <body>

    <!--################################################### header ####################################-->
    <header>
			<div id="header">
    <?php
    	include_once('header.php');
    ?>
      </div>
		</header>
    <!--################################################### end header ####################################-->

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" id="slidebar">
        	
        	
 <!-- NAVIGATION RIGHT START ------------------------------------->        	
      
    <?php
    //name of judge
    echo "<font style='color:#860808; font-weight:bold;'>";
    echo $_SESSION['judgename'];
  
    echo "</font><br>";
		echo " <a href=logout.php style='color:#052750; font-weight:bold;'> <font style='font-size:10px;'>logout</font></a>"; 
    
    if (mysqli_connect_error()) 
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
				die();
    }
    echo "<ul class='nav nav-sidebar'>";
    $strSQL="SELECT * FROM mutya.tblcategory ORDER BY category_sort ASC";
    $result=mysqli_query($con,$strSQL);
    $strContestCategory='Final';
    $bolFinalCategoryUsed = false;
    $bolPrelimCategoryUsed = false;
    $bolSemiFinalCategoryUsed = false;
    while($recordSet=mysqli_fetch_array($result))
    {
    		if ($recordSet['category_kind']== 'Prelim' AND $bolPrelimCategoryUsed==false)
    		{
    				echo "<li class='active bg' id='Prelim'><a>Preliminary Round <span class='sr-only'>(current)</span></a></li>";
    				$bolPrelimCategoryUsed=true;
    				//$strContestCategory	='SemiFinal';
    		}	
    		else if ($recordSet['category_kind']=='Semi' AND $bolSemiFinalCategoryUsed==false)
    		{
    				echo "<li class='active bg' id='Semi'><a>Semi Final Round <span class='sr-only'>(current)</span></a></li>";
    				$bolSemiFinalCategoryUsed=true;
    				//$strContestCategory='Final';
    		}	
    		else if ($recordSet['category_kind']=='Final' AND $bolFinalCategoryUsed==false)
    		{
    				echo "<li class='active' id='Final'><a>Final Round <span class='sr-only'>(current)</span></a></li>";
    				$bolFinalCategoryUsed=true;
    				//$strContestCategory='Final';
    		}	
    		
    		if (($recordSet['enable_status']==1) AND ($recordSet['pk_category']!='Casual Interview'))
    		{
    			
    			echo "<li onclick='clickCategory(this.id)' id='".$recordSet['pk_category']."'><a href='#'>". $recordSet['description']."</a></li>";
    		}
    		else
    		{
    			if ($recordSet['pk_category']!='Casual Interview')
    			{
    			echo "<li  id='".$recordSet['pk_category']."'><a href='#'>". $recordSet['description']."</a></li>";
    		}
    		}
    }	
    
    echo 	"</ul>";
		
    
    ?>    	
          
 <!-- NAVIGATION RIGHT END ------------------------------------->           
          
          <?php
          echo  '<a href="#" style="color:#000; bottom:0; position:fixed; opacity:0.1;" onclick ="helpUs()">Help me please!</a>';
          ?>
        </div>
        
        <!--################################################ content #####################################-->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="main">
          	<div class="content-right">
          		
          	
         <!--################################################ Ajax COntent START #####################################-->  			
          			<div id="scorepage" class="scroll style-3">
          					
          					
          			</div>
         <!--################################################ Ajax COntent END #####################################-->
         
         
<!--################################################ Ajax picture START #####################################-->  			           			
          			<div id="gallery">
          					
          			</div>
          			<div class="tclear"></div>
<!--################################################ Ajax picture START #####################################-->  			          			
          	
          				
          	</div>
        </div>
         
        <!--################################################ end content #####################################-->
      </div>
    
    </div>


 <!-- BOOTSTRAP MODAL START ------------------------------------->
 
		 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close btn-danger" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Document Tracker</h4>
              </div>
              <div class="modal-body">
                      <div id="modalcontent">

                         </div>
              </div>
              <div class="modal-footer">
      
              </div>
            </div>
        </div>
            
    
    
   
     </div>
         
 <!-- BOOTSTRAP MODAL END ------------------------------------->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.2.0.min.js"></script>
    <!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!--<script src="../../assets/js/vendor/holder.min.js"></script> -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="css/ie10-viewport-bug-workaround.js"></script>-->
  </body>
  
  
   <!-- ajax start------------------------------------->
  <script>
  	function clickCategory(catID)
    {

     
        var myData = catID;
       jQuery.ajax({
                type: "POST",
                url:"scoring.php",
                dataType:"text", // Data type, HTML, json etc.
                data:{scoreFunction:catID},
               // data:{search_string:$("#search_string").val(),searchCheck:searchCheckbox},
                beforeSend: function() {
                            $("#scorepage").html("<div class='tblGIF'><img src='images/ajax-loader.gif' align='middle' /></div>");
                    },
                ajaxError: function() {
                            $("#scorepage").html("<div class='tblGIF'><img src='images/ajax-loader.gif' /></div>");
                    },
                success:function(response){
                           $("#scorepage").html(response);
                            

                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            });
            
    }
  	
  	function getPhoto(candidateID)
  	{
  		var getPhoto = "getPhoto";
       jQuery.ajax({
                type: "POST",
                url:"scoring.php",
                dataType:"text", // Data type, HTML, json etc.
                data:{scoreFunction:getPhoto,candNumber:candidateID},
               // data:{search_string:$("#search_string").val(),searchCheck:searchCheckbox},
                beforeSend: function() {
                            $("#gallery").html("<div class='GIF'><img src='images/ajax-loader.gif' align='middle' /></div>");
                    },
                ajaxError: function() {
                            $("#gallery").html("<div class='GIF'><img src='images/ajax-loader.gif' /></div>");
                    },
                success:function(response){
                            $("#gallery").html(response);
                            

                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            });
  		
  		
  		
  	}
  	
  	//FUNCTION NOT IN USE
  	function mouseOverPhoto(candidateID)
  	{
  		var getPhoto = "getPhoto";
       jQuery.ajax({
                type: "POST",
                url:"scoring.php",
                dataType:"text", // Data type, HTML, json etc.
                data:{scoreFunction:getPhoto,candNumber:candidateID},
               // data:{search_string:$("#search_string").val(),searchCheck:searchCheckbox},
                beforeSend: function() {
                            $("#gallery").html("<div ><img src='images/ajax-loader.gif' align='middle' /></div>");
                    },
                ajaxError: function() {
                            $("#gallery").html("<div ><img src='images/ajax-loader.gif' /></div>");
                    },
                success:function(response){
                            $("#gallery").html(response);
                            

                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            });
  	}
  	
  	
  	//TEMPORARY SAVE SCORE TO TEMPORARY TABLE
  	function tempSave(tempScore,candidateID)
  	{
  		
  		if (isNaN(tempScore))
  		  		{
  			 alert ("Numeric values only.");
		  			return; 
  		}
//  		else if (tempScore!='')
//  		{
//  			alert ("Numeric values only");
//  			return 0; 
//  			}
  		
  
  if (tempScore!='') {
  	
  		if ((tempScore < 70) || (tempScore > 100))
		  		{
		  			alert ("Possible score is between 75 and 100");
		  			return;
		  		}		  	
		  		
		  	}
		  	else
		  		{
		  			return;
		  			}
		  		
  		var saveScore = "tempSave";
  		
       jQuery.ajax({
                type: "POST",
                url:"scoring.php",
                dataType:"text", // Data type, HTML, json etc.
                data:{scoreFunction:saveScore,candNumber:candidateID,tempScore:tempScore},
        
                success:function(response){
//                            $("#gallery").html(response);
									//alert ("save");
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            });
  		
  	}
  	
  	
  	
  	function updateFromTemp()
  	{
  
  	
  		var updateData = 'updateData';
  		
  		jQuery.ajax({
                type: "POST",
                url:"scoring.php",
                dataType:"text", // Data type, HTML, json etc.
                data:{scoreFunction:updateData},
               // data:{search_string:$("#search_string").val(),searchCheck:searchCheckbox},
                beforeSend: function() {
                            $("#scorepage").html("<div ><img src='images/ajax-loader.gif' align='middle' /></div>");
                    },
                ajaxError: function() {
                            $("#scorepage").html("<div ><img src='images/ajax-loader.gif' /></div>");
                    },
                success:function(response){
                            $("#scorepage").html(response);
                            $("#gallery").html("");

                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            });
  	}
  	
  	
  	function submitMe()
  	{
  		
  		if(!confirm("This is the final score. Continue?"))
  		{
  			return;
  			}
  	
  		var updateData = 'submitScore';
  		
  		jQuery.ajax({
                type: "POST",
                url:"scoring.php",
                dataType:"text", // Data type, HTML, json etc.
                data:{scoreFunction:updateData},
               
                success:function(response){
                	
                		if (response=="true")
                		{
                			alert("Save success. Refresh page.");
                			$("#scorepage").html(response);
                      $("#gallery").html("");
                		}
                		else
                			{
                				
                				alert("Error Saving. Try again");
                			}
                            
                            
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            });
  	}
  	
  	
  	function helpUs()
  	{
  			
  		
  			
  			var helpMe = 'help';
  			<?php 
  			echo "var judgeName = '".$_SESSION['judgename']."';";
  			?>
  			jQuery.ajax({
                type: "POST",
                url:"scoring.php",
                dataType:"text", // Data type, HTML, json etc.
                data:{scoreFunction:helpMe,judge:judgeName},
               
                success:function(response){
                	
                		if (response=="true")
                		{
                			alert("SOS sent. Sit tight.");
                
                		}
                		else
                			{
                				
                				alert("Asa. No help Coming");
                			}
                            
                            
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            });
  			
  	}
  </script> 
  <!-- ajax start------------------------------------->
  
  
  
</html>
