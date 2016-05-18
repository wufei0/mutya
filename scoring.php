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


		include('connection.php');
	  global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
    $con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);
    
    if (mysqli_connect_error()) 
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
				die();
    }
    
    
    
    switch ($_POST['scoreFunction'])
    {
    ////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////	CATEGORIES //////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////
	  		case 'Casual Interview';
		    		$_SESSION['category']='Casual Interview';
		    		
		    		if (checkScoreSubmited($_SESSION['category'],20))
		    		{
		    			summaryScore('Casual Interview');
		    			die();
		    		}
		    		
		    		$sqlQuery='SELECT * FROM tblcandidate ORDER BY PK_NUMBER ASC';
						$result=mysqli_query($con,$sqlQuery);
		
						echo "<table border='1' width='100%'>";
						echo "
										<tr>
											<th class='width'>Mutya No</th>
											<th class='navTH'><a href='#' onclick='updateFromTemp()'>Casual Interview</a></th>
											<th>Swimsuit</th>
											<th>Evening Gown</th>
											<th>Average</th>
											<th>Rank</th>
					          </tr>
					       ";
						while($recordSet=mysqli_fetch_array($result))
					  {
					  	echo "
					  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
	  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
	  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")'> </td>
	  									<td> - </td>
	  									<td> - </td>
	  									<td> - </td>
	  									<td> - </td>
					        </tr>
					  	
					  		";
					  }
					  echo "<tr><td></td><td><input class='btn btn-primary' type='button' value='submit' onclick='submitMe()'></td></tr>";
						echo "</table>";
						break;			 
					
					
					case 'Swimsuit';
					    		$_SESSION['category']='Swimsuit';
					    		
					    		if (checkScoreSubmited($_SESSION['category'],20))
					    		{
					    			summaryScore('Swimsuit');
					    			die();
					    		}
					    
			    						$sqlQuery='SELECT * FROM tblcandidate ORDER BY PK_NUMBER ASC';
											$result=mysqli_query($con,$sqlQuery);
							
											echo "<table border='1' width='100%'>";
											echo "
															<tr>
																<th class='width'>Mutya No</th>
																
																<th class='navTH'><a href='#' onclick='updateFromTemp()'>Swimsuit</th>
																<th>Evening Gown</th>
																<th>Average</th>
																<th>Rank</th>
										          </tr>
										       ";
										       
										       $sql="SELECT score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
															WHERE  fk_tbljudge_pkname = '".$_SESSION['username']."' ORDER BY score DESC";
															 
															 
															 
										  	$makeArrayRanks=makeArrayRank($sql);
											while($recordSet=mysqli_fetch_array($result))
										  {
										  	
										  	
										  	$sql="SELECT score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
															WHERE fk_tblcandidate_pknumber = ".$recordSet['pk_number']." 
															 AND fk_tbljudge_pkname = '".$_SESSION['username']."' ";
										  	
										  	
										  	$results=mysqli_query($con,$sql);
										  	$recordResult = mysqli_fetch_row($results);
										  	echo "
										  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
						  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
						  								
						  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")'> </td>
						  									<td> - </td>
						  									<td> <a href='#'>".$recordResult[0]." </a> </td>
						  									<td> <font color='red'>".ordinal($makeArrayRanks[$recordSet['pk_number']])."</font> </td>
										        </tr>
										  	
										  		";
										 	}
											echo "<tr><td></td><td><input class='btn btn-primary' type='button' value='submit' onclick='submitMe()'></td></tr>";
											echo "</table>";
						break;
					
					
					
					case 'Evening Gown';
					    		$_SESSION['category']='Evening Gown';
					    		
					    		if (checkScoreSubmited($_SESSION['category'],20))
					    		{
					    			summaryScore('Evening Gown');
					    			die();
					    		}
					    
			    						$sqlQuery='SELECT * FROM tblcandidate ORDER BY PK_NUMBER ASC';
											$result=mysqli_query($con,$sqlQuery);
							
											echo "<table border='1' width='100%'>";
											echo "
															<tr>
																<th class='width'>Mutya No</th>
																
																<th>Swimsuit</th>
																<th class='navTH'><a href='#' onclick='updateFromTemp()'>Evening Gown</th>
																<th>Average</th>
																<th>Rank</th>
										          </tr>
										       ";

										       $sql="SELECT avg(score) as score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
												WHERE fk_tbljudge_pkname = '".$_SESSION['username']."'  group by fk_tblcandidate_pknumber
												 ORDER BY score DESC";
												 
							  	$makeArrayRanks=makeArrayRank($sql);
    			
    						while($recordSet=mysqli_fetch_array($result))
							  {
							  	
							  	$sql="SELECT score,pk_number,pk_category,category_sort FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
												JOIN tblcategory on tblscore.fk_category_pkcategory = tblcategory.pk_category
												
												WHERE fk_tblcandidate_pknumber = ".$recordSet['pk_number']."  
												 AND fk_tbljudge_pkname = '".$_SESSION['username']."'  order by category_sort asc";
							  	
							  
							  	$results=mysqli_query($con,$sql);
							  	mysqli_data_seek($results, 0);
							  	$recordResult = mysqli_fetch_row($results);
							  	$casualInterview=$recordResult[0];
							  	
							  	mysqli_data_seek($results, 1);
							  	$recordResult = mysqli_fetch_row($results);
							  	$swimsuit=$recordResult[0];
							  	$averageScore=number_format(($casualInterview+$swimsuit),2);
							  	echo "
							  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
			  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
			  									
			  									<td> <a href='#'>".$swimsuit." </a> </td>
			  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")'> </td>
			  									<td> <a href='#'>".$averageScore." </a> </td>
			  									<td> <font color='red'>".ordinal($makeArrayRanks[$recordSet['pk_number']])."</font> </td>
							        </tr>
							  	
							  		"; 
							  }
							
								
											echo "<tr><td></td><td></td><td><input class='btn btn-primary' type='button' value='submit' onclick='submitMe()'></td></tr>";
											echo "</table>";
						break;
						
						
						
						case 'Casual Interview Semi';
					    		$_SESSION['category']='Casual Interview Semi';
					    		
					    		if (checkScoreSubmited($_SESSION['category'],10))
					    		{
					    			summaryScore('Casual Interview Semi');
					    			die();
					    		}
					    
	    								
			    						$sqlQuery='SELECT pk_number,municipality,sum(score) as totalscore,fk_tbljudge_pkname,fk_tblcandidate_pknumber 
														from tblcandidate join tblscore on tblcandidate.pk_number = tblscore.fk_tblcandidate_pknumber
															group by pk_number order by sum(score) desc	limit 10';
														
														
											$result=mysqli_query($con,$sqlQuery);
							
											echo "<table border='1' width='100%'>";
											echo "
															<tr>
																<th class='width'>Mutya No</th>
																<th class='navTH'><a href='#' onclick='updateFromTemp()'>Question and Answer</th>
																<th>Rank</th>
										          </tr>
										       ";

//								$me=mysqli_fetch_array($result);
//								echo $me[1];
//								$me=mysqli_fetch_array($result);
//								echo $me[1];
//								$me=mysqli_fetch_array($result);
//								echo $me[1];

    			
    						while($recordSet=mysqli_fetch_array($result))
							  {
							  	
							  	echo "
							  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
			  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
			  			
			  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")'> </td>
			  									
			  									<td> <font color='red'> - </font> </td>
							        </tr>
							  	
							  		"; 
							  }
							
								
											echo "<tr><td></td><td><input class='btn btn-primary' type='button' value='submit' onclick='submitMe()'></td></tr>";
											echo "</table>";
						break;
						
						
						
						
						case 'Casual Interview Final';
					    		$_SESSION['category']='Casual Interview Final';
					    		
					    		if (checkScoreSubmited($_SESSION['category'],5))
					    		{
					    			summaryScore('Casual Interview Final');
					    			die();
					    		}
					    
	    								
			    						$sqlQuery="SELECT pk_number,municipality,sum(score) as totalscore,fk_tbljudge_pkname,fk_tblcandidate_pknumber 
														from tblcandidate join tblscore on tblcandidate.pk_number = tblscore.fk_tblcandidate_pknumber
														WHERE fk_category_pkcategory='Casual Interview Semi'
															group by pk_number order by sum(score) desc	limit 5";
														
														
											$result=mysqli_query($con,$sqlQuery);
							
											echo "<table border='1' width='100%'>";
											echo "
															<tr>
																<th class='width'>Mutya No</th>
																<th class='navTH'><a href='#' onclick='updateFromTemp()'>Question and Answer</th>
																<th>Rank</th>
										          </tr>
										       ";

//								$me=mysqli_fetch_array($result);
//								echo $me[1];
//								$me=mysqli_fetch_array($result);
//								echo $me[1];
//								$me=mysqli_fetch_array($result);
//								echo $me[1];

    			
    						while($recordSet=mysqli_fetch_array($result))
							  {
							  	
							  	echo "
							  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
			  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
			  			
			  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")'> </td>
			  									
			  									<td> <font color='red'> - </font> </td>
							        </tr>
							  	
							  		"; 
							  }
							
								
											echo "<tr><td></td><td><input class='btn btn-primary' type='button' value='submit' onclick='submitMe()'></td></tr>";
											echo "</table>";
						break;
 ////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////END	CATEGORIES //////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////
    
    					
				case 'getPhoto';
						
						$sqlQuery="SELECT municipality,name,age FROM tblcandidate WHERE pk_number = " .$_POST["candNumber"];
						//$sqlQuery='asdjadhjashdkashdkhasd';
						$result=mysqli_query($con,$sqlQuery);
					
			
						while($recordSet=mysqli_fetch_array($result))
					  {
					 		
					  	echo"
					  	<div class='place'>
          						
          					</div>
          					<div  class='pix'>
          							<img src='images/candidates/".$recordSet['municipality'].".jpg' class='Image' align='middle' />
          					</div>
          					<div class='listname'>
          							<h3>".$recordSet['municipality']."</h3>
          							<h4>".$recordSet['name']."</h4>
          							<p>".$recordSet['age']." years old</p>
          							<!--<p>36 - 24 - 38</p>-->
          					</div>
          					
          					";
						exit();
						}
			
						break;   
						
				case 'tempSave';
					//$sqlQuery='SELECT * FROM tblcandidate ORDER BY PK_NUMBER ASC';
					//$result=mysqli_query($con,$sqlQuery);
					if (searchTempScore($_SESSION['username'],$_POST['candNumber']))
					{
						$sqlQuery="UPDATE tblTempScore SET score='".$_POST['tempScore'] ."' WHERE fk_username= '".$_SESSION['username']."' AND  fk_candidate= ".$_POST['candNumber']." ";
						$result=mysqli_query($con,$sqlQuery);
						echo $sqlQuery;
						die();
					}
					else
					{
						$sqlQuery="INSERT INTO  tblTempScore(fk_username,fk_candidate,score, fk_category) VALUES ('".$_SESSION['username']."',".$_POST['candNumber'].",'".$_POST['tempScore'] ."','".$_SESSION['category'] ."')";
						$result=mysqli_query($con,$sqlQuery);
							echo $sqlQuery;
						die();
					}
					
					
					break;
			
	///////////////////////////////////////////////////////////////////////////////////////
	//////////////////////UPDATE DATA//////////////////////////////////////////////////		
	///////////////////////////////////////////////////////////////////////////////////////				
					case 'updateData';
					
					if ($_SESSION['category']=='Casual Interview')
								{
									
				    		$sqlQuery='SELECT * FROM tblcandidate ORDER BY PK_NUMBER ASC';
								$result=mysqli_query($con,$sqlQuery);
				
								echo "<table border='1' width='100%'>";
								echo "
												<tr>
													<th class='width'>Mutya No</th>
													<th class='navTH'><a href='#' onclick='updateFromTemp()'>Question and Answer</a></th>
													<th>Swimsuit</th>
													<th>Evening Gown</th>
													<th>Average</th>
													<th>Rank</th>
							          </tr>
							       ";
							       
							         
										  	
								while($recordSet=mysqli_fetch_array($result))
							  {
							  	$sqlQuery="SELECT score FROM tblTempScore WHERE fk_username = '".$_SESSION['username']."' AND fk_candidate=".$recordSet['pk_number'];
									$results=mysqli_query($con,$sqlQuery);
			//							echo $sqlQuery;
			//							die();
							  	$recordSets = mysqli_fetch_row($results);
							  		if 	($recordSets != null)
							  		{
									  	echo "
									  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
					  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
					  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")' value='".$recordSets[0]."'></td>
					  									<td> - </td>
					  									<td> - </td>
					  									<td> - </td>
					  									<td> - </td>
									        </tr>
									  	
									  		";
							  		
							  		}
							  		
							  		else
							  		{
							  			echo "
									  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
					  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
					  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")' value=''> </td>
					  									<td> - </td>
					  									<td> - </td>
					  									<td> - </td>
					  									<td> - </td>
									        </tr>
									  	
									  		";
							  		}
							  		
							  
								
							}
											echo "<tr><td></td><td></td><td><input class='btn btn-primary' type='button' value='submit' onclick='submitMe()'></td></tr>";
											echo "</table>";
						
										
							    	
								}			
					
					elseif ($_SESSION['category']=='Swimsuit')
					{
								$sqlQuery='SELECT * FROM tblcandidate ORDER BY PK_NUMBER ASC';
											$result=mysqli_query($con,$sqlQuery);
							
											echo "<table border='1' width='100%'>";
											echo "
															<tr>
																<th class='width'>Mutya No</th>
																
																<th class='navTH'><a href='#' onclick='updateFromTemp()'>Swimsuit</th>
																<th>Evening Gown</th>
																<th>Average</th>
																<th>Rank</th>
										          </tr>
										       ";
										       
										        $sql="SELECT score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
															WHERE fk_category_pkcategory = 'Casual Interview' 
															 AND fk_tbljudge_pkname = '".$_SESSION['username']."' ORDER BY score DESC";
															 
										  	$makeArrayRanks=makeArrayRank($sql);
										       
										 while($recordSet=mysqli_fetch_array($result))
											  {
											  	$sqlQuery="SELECT score FROM tblTempScore WHERE fk_username = '".$_SESSION['username']."' AND fk_candidate=".$recordSet['pk_number'];
													$results=mysqli_query($con,$sqlQuery);
							//							echo $sqlQuery;
							//							die();
											  	$recordSets = mysqli_fetch_row($results);
											  	
											  	//$sqlGetPrevScores="SELECT score from tblscore WHERE fk_tblcandidate_pknumber=".$recordSet['pk_number']."  AND fk_tbljudge_pkname = ";
											  	$sqlGetPrevScores="SELECT score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
															WHERE fk_tblcandidate_pknumber = ".$recordSet['pk_number']." AND fk_category_pkcategory = 'Casual Interview' 
															 AND fk_tbljudge_pkname = '".$_SESSION['username']."' ";
											  	$sqlGetPrevScoresResult=mysqli_query($con,$sqlGetPrevScores);
											  	$sqlGetPrevScoresRecordset = mysqli_fetch_row($sqlGetPrevScoresResult);
											  	
											  		if 	($recordSets != null)
											  		{
													  	echo "
													  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
									  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
									  									
									  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")' value='".$recordSets[0]."'> </td>
									  									<td> - </td>
									  									<td> <a href='#'>".$sqlGetPrevScoresRecordset[0]." </a></td> </td>
									  									<td> <font color='red'>".ordinal($makeArrayRanks[$recordSet['pk_number']])."</font> </td>
													        </tr>
													  	
													  		";
											  		
											  		}
											  		
											  		else
											  		{
											  			echo "
													  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
									  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
									  									
									  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")' value=''> </td>
									  									<td> - </td>
									  									<td> <a href='#'>".$sqlGetPrevScoresRecordset[0]." </a></td> </td>
									  									<td> <font color='red'>".ordinal($makeArrayRanks[$recordSet['pk_number']])."</font> </td>
													        </tr>
													  	
													  		";
											  		}
											  		
											  
												
											}
							echo "<tr><td></td><td><input class='btn btn-primary' type='button' value='submit' onclick='submitMe()'></td></tr>";
								echo "</table>";      
					}
					
					elseif ($_SESSION['category']=='Evening Gown')
					{
								$sqlQuery='SELECT * FROM tblcandidate ORDER BY PK_NUMBER ASC';
											$result=mysqli_query($con,$sqlQuery);
							
											echo "<table border='1' width='100%'>";
											echo "
															<tr>
																<th class='width'>Mutya No</th>
															
																<th>Swimsuit</th>
																<th class='navTH'><a href='#' onclick='updateFromTemp()'>Evening Gown</th>
																<th>Average</th>
																<th>Rank</th>
										          </tr>
										       ";
										       
										        $sql="SELECT sum(score)as score,sum(score)as average,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
															WHERE (fk_category_pkcategory = 'Casual Interview'  OR fk_category_pkcategory = 'Swimsuit')
															 AND fk_tbljudge_pkname = '".$_SESSION['username']."' group by pk_number ORDER BY average DESC";
															 
										  	$makeArrayRanks=makeArrayRank($sql);
										       
										 while($recordSet=mysqli_fetch_array($result))
											  {
											  	$sqlQuery="SELECT score FROM tblTempScore WHERE fk_username = '".$_SESSION['username']."' AND fk_candidate=".$recordSet['pk_number'];
													$results=mysqli_query($con,$sqlQuery);
											  	$recordSets = mysqli_fetch_row($results);
											  	
											  	
											  	$sqlGetPrevScores="SELECT score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
															JOIN tblcategory ON tblscore.fk_category_pkcategory = tblcategory.pk_category
															WHERE fk_tblcandidate_pknumber = ".$recordSet['pk_number']." AND (fk_category_pkcategory = 'Casual Interview'  OR
															 fk_category_pkcategory = 'Swimsuit')													 
															 AND fk_tbljudge_pkname = '".$_SESSION['username']."' ORDER BY category_sort";
														
													$sqlGetPrevScoresResult=mysqli_query($con,$sqlGetPrevScores);
															
													mysqli_data_seek($sqlGetPrevScoresResult, 0);		
													$sqlGetPrevScoresResults = mysqli_fetch_row($sqlGetPrevScoresResult);		
													$casualInterview=$sqlGetPrevScoresResults[0];		
													
													mysqli_data_seek($sqlGetPrevScoresResult, 1);	
													$sqlGetPrevScoresResults = mysqli_fetch_row($sqlGetPrevScoresResult);		
													$swimsuit=$sqlGetPrevScoresResults[0];
															
													$prevScoreAverage=number_format(($casualInterview+$swimsuit),2);
											  	
											  		if 	($recordSets != null)
											  		{
													  	echo "
													  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
									  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
									  									
									  									<td> <a href='#'>".$swimsuit." </a></td>
									  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")' value='".$recordSets[0]."'>  </td>
									  									<td> <a href='#'>".$prevScoreAverage." </a></td> </td>
									  									<td> <font color='red'>".ordinal($makeArrayRanks[$recordSet['pk_number']])."</font> </td>
													        </tr>
													  	
													  		";
											  		
											  		}
											  		
											  		else
											  		{
											  			echo "
													  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
									  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
									  									
									  									<td> <a href='#'>".$swimsuit." </a></td>
									  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")' value=''> </td>
									  									<td> <a href='#'>".$prevScoreAverage." </a></td> </td>
									  									<td> <font color='red'>".ordinal($makeArrayRanks[$recordSet['pk_number']])."</font> </td>
													        </tr>
													  	
													  		";
											  		}
											  		
											  
												
											}
											echo "<tr><td></td><td></td><td><input class='btn btn-primary' type='button' value='submit' onclick='submitMe()' /></td></tr>";
								echo "</table>";   
					}
					
					elseif ($_SESSION['category']=='Casual Interview Semi')
					{
						
			    						$sqlQuery='SELECT pk_number,municipality,sum(score) as totalscore,fk_tbljudge_pkname,fk_tblcandidate_pknumber
														from tblcandidate join tblscore on tblcandidate.pk_number = tblscore.fk_tblcandidate_pknumber
															group by pk_number order by sum(score) desc	limit 10';
											
														
											$result=mysqli_query($con,$sqlQuery);
							
											echo "<table border='1' width='100%'>";
											echo "
															<tr>
																<th class='width'>Mutya No</th>
																<th class='navTH'><a href='#' onclick='updateFromTemp()'>Question and Answer</th>
																<th>Rank</th>
										          </tr>
										       ";

//								$me=mysqli_fetch_array($result);
//								echo $me[1];
//								$me=mysqli_fetch_array($result);
//								echo $me[1];
//								$me=mysqli_fetch_array($result);
//								echo $me[1];


								$sql="";
    			
    						while($recordSet=mysqli_fetch_array($result))
							  {
							  	
							  	$sqlQuery="SELECT score FROM tblTempScore WHERE fk_username = '".$_SESSION['username']."' AND fk_candidate=".$recordSet['pk_number'];
									$results=mysqli_query($con,$sqlQuery);
							  	$recordSets = mysqli_fetch_row($results);
							  	
							  	if 	($recordSets != null)
							  		{
							  			echo "
							  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
			  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
			  			
			  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")' value=".$recordSets[0]."> </td>
			  									
			  									<td> <font color='red'> - </font> </td>
							        </tr>
							  	
							  		"; 
							  		}
							  		
							  		else
							  		{
							  			echo "
							  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
			  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
			  			
			  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")'> </td>
			  									
			  									<td> <font color='red'> - </font> </td>
							        </tr>
							  	
							  		"; 
							  		}
							  	
							  	
							  }
							
								
											echo "<tr><td></td><td><input class='btn btn-primary' type='button' value='submit' onclick='submitMe()'></td></tr>";
											echo "</table>";
						
					}
					
					
							
					
					elseif ($_SESSION['category']=='Casual Interview Final')
					{
						
			    						$sqlQuery="SELECT pk_number,municipality,sum(score) as totalscore,fk_tbljudge_pkname,fk_tblcandidate_pknumber 
														from tblcandidate join tblscore on tblcandidate.pk_number = tblscore.fk_tblcandidate_pknumber
														WHERE fk_category_pkcategory='Casual Interview Semi'
															group by pk_number order by sum(score) desc	limit 5";
											
														
											$result=mysqli_query($con,$sqlQuery);
							
											echo "<table border='1' width='100%'>";
											echo "
															<tr>
																<th class='width'>Mutya No</th>
																<th class='navTH'><a href='#' onclick='updateFromTemp()'>Question and Answer</th>
																<th>Rank</th>
										          </tr>
										       ";

//								$me=mysqli_fetch_array($result);
//								echo $me[1];
//								$me=mysqli_fetch_array($result);
//								echo $me[1];
//								$me=mysqli_fetch_array($result);
//								echo $me[1];


								$sql="";
    			
    						while($recordSet=mysqli_fetch_array($result))
							  {
							  	
							  	$sqlQuery="SELECT score FROM tblTempScore WHERE fk_username = '".$_SESSION['username']."' AND fk_candidate=".$recordSet['pk_number'];
									$results=mysqli_query($con,$sqlQuery);
							  	$recordSets = mysqli_fetch_row($results);
							  	
							  	if 	($recordSets != null)
							  		{
							  			echo "
							  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
			  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
			  			
			  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")' value=".$recordSets[0]."> </td>
			  									
			  									<td> <font color='red'> - </font> </td>
							        </tr>
							  	
							  		"; 
							  		}
							  		
							  		else
							  		{
							  			echo "
							  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
			  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
			  			
			  									<td> <input type='text' onblur='tempSave(this.value,".$recordSet['pk_number'].")'> </td>
			  									
			  									<td> <font color='red'> - </font> </td>
							        </tr>
							  	
							  		"; 
							  		}
							  	
							  	
							  }
							
								
											echo "<tr><td></td><td><input class='btn btn-primary' type='button' value='submit' onclick='submitMe()'></td></tr>";
											echo "</table>";
						
					}
						break;
						
	///////////////////////////////////////////////////////////////////////////////////
	//////////////////////////// SUBMIT SCORE///////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
						
					case 'submitScore';
						mysqli_autocommit($con, false);
						$flag=true;
						
						if ($_SESSION['category']=='Casual Interview Semi')
						{
							$candCount=10;
							}
						elseif ($_SESSION['category']=='Casual Interview Final')
						{
							$candCount=5;
							}
						else
						{
							$candCount=20;
							}
							
							
							
						if (checkTempScoreComplete()== $candCount)
						{
							
								$sqlQuery="SELECT fk_username,fk_category,score,fk_candidate FROM tblTempScore
								 WHERE fk_username= '".$_SESSION['username']."' AND  fk_category = '".$_SESSION['category']."'
								";
								
								$result=mysqli_query($con,$sqlQuery);
								

								while ($resultSet=mysqli_fetch_array($result))
								{
										$sql="INSERT INTO tblscore(fk_tblcandidate_pknumber,fk_category_pkcategory,score,fk_tbljudge_pkname) 
												VALUES (".$resultSet['fk_candidate'].",'".$resultSet['fk_category']."',".$resultSet['score'].",'".$resultSet['fk_username']."')";
										$results=mysqli_query($con,$sql);
										if  (!$results)
										{
												$flag=false;
										}
										
								}
									
									
										$sql="DELETE FROM tblTempScore WHERE fk_username= '".$_SESSION['username']."' AND  fk_category = '".$_SESSION['category']."' ";
										$deleteResult=mysqli_query($con,$sql);
										
										if  (!$deleteResult)
												{
														$flag=false;
												}
												
												
												
										
								if ($flag)
								{
										mysqli_commit($con);
										echo "true";
								}
									
							else
								{
									mysqli_rollback($con);
										echo "false";
								}
								
									
							
							
							
						}
					
				
						
					break;
					
					
					case 'help';
					
						$sql="UPDATE tbljudge set help=1 WHERE name='".$_POST['judge']."' ";
										$results=mysqli_query($con,$sql);
										if  (!$results)
										{
												echo false;
										}
										else
										{
											echo "true";
										}
										
					
					break;
					
					
		                       
		}
		
		
		
		function searchTempScore($judgeid,$candNumber)
		{
			$sqlQuery="SELECT COUNT(*) as numrows FROM tblTempScore WHERE fk_username = '".$judgeid."' AND fk_candidate = ".$candNumber;
			
			
			
			include('connection.php');
	  global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
    $con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);
    
    if (mysqli_connect_error()) 
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
				die();
    }
    
    
     
		
			
			
			$result=mysqli_query($con,$sqlQuery);
	
	
//			echo $result['numrows'][0];
//			die();
			while ($recordSet=mysqli_fetch_array($result))
			{
				
				if ($recordSet['numrows']>0)
				{
					return true;
			}
			else
			{
					return false;
			}		
				
			}
	
			
		}
		
		function checkTempScoreComplete()
		{
			
			 global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
  $con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);
  
			$sqlQuery="SELECT count(*) from tblTempScore WHERE fk_username = '".$_SESSION['username']."' ";
			$result=mysqli_query($con,$sqlQuery);
			
			$recordSet = mysqli_fetch_row($result);
		
			return $recordSet[0];
			
			
		}
		
		function checkScoreSubmited($conCategory,$rowCount)
		{
				include('connection.php');
	  		global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
    		$conection=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);
    		
    		$sqlString="SELECT COUNT(*) FROM tblscore WHERE fk_category_pkcategory = '".$conCategory."' AND fk_tbljudge_pkname = '".$_SESSION['username']."' ";
    		$result=mysqli_query($conection,$sqlString);
			
				$recordSet = mysqli_fetch_row($result);
			
				if($recordSet[0]==$rowCount)
				{
					return true;
				}
				else
				{
					return false;
				}
			
		}
		
		function summaryScore($conCategory)
		{
				include('connection.php');
	  		global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
    		$conection=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);
    		
    		switch ($conCategory)
    		{
    			
    				case 'Casual Interview';
    						$sqlQuery='SELECT * FROM tblcandidate ORDER BY PK_NUMBER ASC';
								$result=mysqli_query($con,$sqlQuery);
				
								echo "<table border='1' width='100%'>";
								echo "
												<tr>
													<th class='width'>Mutya No</th>
													<th>Casual Interview</a></th>
													<th>Swimsuit</th>
													<th>Evening Gown</th>
													<th>Average</th>
													<th>Rank</th>
							          </tr>
							       ";
							       
							       $sql="SELECT score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
												WHERE fk_category_pkcategory = '".$conCategory."' 
												 AND fk_tbljudge_pkname = '".$_SESSION['username']."' ORDER BY score DESC";
												 
							  	$makeArrayRanks=makeArrayRank($sql);
								while($recordSet=mysqli_fetch_array($result))
							  {
							  	
							  	
							  	$sql="SELECT score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
												WHERE fk_tblcandidate_pknumber = ".$recordSet['pk_number']." AND fk_category_pkcategory = '".$conCategory."' 
												 AND fk_tbljudge_pkname = '".$_SESSION['username']."' ";
							  	
							  	
							  	$results=mysqli_query($conection,$sql);
							  	$recordResult = mysqli_fetch_row($results);
							  	echo "
							  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
			  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
			  									<td> <a href='#'>".$recordResult[0]." </a></td>
			  									<td> - </td>
			  									<td> - </td>
			  									<td> <a href='#'>".number_format($recordResult[0],2)." </a> </td>
			  									<td> <font color='red'>".ordinal($makeArrayRanks[$recordSet['pk_number']])."</font> </td>
							        </tr>
							  	
							  		";
							  }
							
								echo "</table>";
    						
    				
    						break;
    						
    		
    		
    		
    			case 'Swimsuit';
    			
    						$sqlQuery='SELECT * FROM tblcandidate ORDER BY PK_NUMBER ASC';
								$result=mysqli_query($conection,$sqlQuery);
				
								echo "<table border='1' width='100%'>";
								echo "
												<tr>
													<th class='width'>Mutya No</th>
												
													<th>Swimsuit</th>
													<th>Evening Gown</th>
													<th>Average</th>
													<th>Rank</th>
							          </tr>
							       ";
    				
    						 $sql="SELECT sum(score) as score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
												WHERE fk_tbljudge_pkname = '".$_SESSION['username']."'  AND fk_category_pkcategory = '".$conCategory."' 
												group by fk_tblcandidate_pknumber
												 ORDER BY score DESC";
												// echo $sql;
							  	$makeArrayRanks=makeArrayRank($sql);
    			
    						while($recordSet=mysqli_fetch_array($result))
							  {
							  	
							  	$sql="SELECT score,pk_number,pk_category,category_sort FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
												JOIN tblcategory on tblscore.fk_category_pkcategory = tblcategory.pk_category
												
												WHERE fk_tblcandidate_pknumber = ".$recordSet['pk_number']."  
												 AND fk_tbljudge_pkname = '".$_SESSION['username']."'  order by category_sort asc";
							  	
							
							  	$results=mysqli_query($conection,$sql);
							  	mysqli_data_seek($results, 0);
							  	$recordResult = mysqli_fetch_row($results);
							  	$casualInterview=$recordResult[0];
							  	
							  	mysqli_data_seek($results, 1);
							  	$recordResult = mysqli_fetch_row($results);
							  	$swimsuit=$recordResult[0];
							  	$averageScore=number_format(($casualInterview+$swimsuit),2);
							  	echo "
							  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
			  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
			  									
			  									<td> <a href='#'>".$swimsuit." </a> </td>
			  									<td> - </td>
			  									<td> <a href='#'>".$averageScore." </a> </td>
			  									<td> <font color='red'>".ordinal($makeArrayRanks[$recordSet['pk_number']])."</font> </td>
							        </tr>
							  	
							  		";
							  }
							
								echo "</table>";
    			
    			
    			break;
    			
    				case 'Evening Gown';
    			
    						$sqlQuery='SELECT * FROM tblcandidate ORDER BY PK_NUMBER ASC';
								$result=mysqli_query($conection,$sqlQuery);
				
								echo "<table border='1' width='100%'>";
								echo "
												<tr>
													<th class='width'>Mutya No</th>
													
													<th>Swimsuit</th>
													<th>Evening Gown</th>
													<th>Average</th>
													<th>Rank</th>
							          </tr>
							       ";
    				
										        $sql="SELECT sum(score)as score,sum(score)as average,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
															WHERE (fk_category_pkcategory = 'Casual Interview'  OR fk_category_pkcategory = 'Swimsuit' OR fk_category_pkcategory = 'Evening Gown')
															 AND fk_tbljudge_pkname = '".$_SESSION['username']."' group by pk_number ORDER BY average DESC";
//												 echo $sql;
//												 die();
							  	$makeArrayRanks=makeArrayRank($sql);
    			
    						while($recordSet=mysqli_fetch_array($result))
							  {
							  	
							  	$sql="SELECT score,pk_number,pk_category,category_sort FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
												JOIN tblcategory on tblscore.fk_category_pkcategory = tblcategory.pk_category
												
												WHERE fk_tblcandidate_pknumber = ".$recordSet['pk_number']."  
												 AND fk_tbljudge_pkname = '".$_SESSION['username']."'  order by category_sort asc";
//							  	 echo $sql;
//												 die();
							  
							  	$results=mysqli_query($conection,$sql);
							  	
							  	mysqli_data_seek($results, 0);
							  	$recordResult = mysqli_fetch_row($results);
							  	$casualInterview=$recordResult[0];
							  	
							  	mysqli_data_seek($results, 1);
							  	$recordResult = mysqli_fetch_row($results);
							  	$swimsuit=$recordResult[0];
							  	
							  	mysqli_data_seek($results, 2);
							  	$recordResult = mysqli_fetch_row($results);
							  	
							  	
							  	$eveningGown=$recordResult[0];
							  	$averageScore=number_format(($casualInterview+$swimsuit+$eveningGown)/2,2);
							  	echo "
							  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
			  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
			  									
			  									<td> <a href='#'>".$swimsuit." </a> </td>
			  									<td> <a href='#'>".$eveningGown." </a> </td>
			  									<td> <a href='#'>".$averageScore." </a> </td>
			  									<td> <font color='red'>".ordinal($makeArrayRanks[$recordSet['pk_number']])."</font> </td>
							        </tr>
							  	
							  		";
							  }
							
								echo "</table>";
    			
    			
    			break;
    			
    			
    			
    			
    			case 'Casual Interview Semi';
    	
    						$sqlQuery='SELECT * FROM tblcandidate ORDER BY PK_NUMBER ASC';
    						
						    	$sqlQuery='SELECT pk_number,municipality,sum(score) as totalscore,fk_tbljudge_pkname,fk_tblcandidate_pknumber
									from tblcandidate join tblscore on tblcandidate.pk_number = tblscore.fk_tblcandidate_pknumber
									group by pk_number order by sum(score) desc	limit 10';
									
								$result=mysqli_query($con,$sqlQuery);
				
								echo "<table border='1' width='100%'>";
								echo "
												<tr>
													<th class='width'>Mutya No</th>
													<th>Question and Answer</a></th>
													<th>Rank</th>
							          </tr>
							       ";
							       
							       $sql="SELECT score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
												WHERE fk_category_pkcategory = 'Casual Interview Semi' 
												 AND fk_tbljudge_pkname = '".$_SESSION['username']."' ORDER BY score DESC";
												 
							  	$makeArrayRanks=makeArrayRank($sql);
								while($recordSet=mysqli_fetch_array($result))
							  {
							  	
							  	
							  	$sql="SELECT score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
												WHERE fk_tblcandidate_pknumber = ".$recordSet['pk_number']." AND fk_category_pkcategory = 'Casual Interview Semi' 
												 AND fk_tbljudge_pkname = '".$_SESSION['username']."' ";
							  	
							  	
							  	$results=mysqli_query($conection,$sql);
							  	$recordResult = mysqli_fetch_row($results);
							  	echo "
							  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
			  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
			  									<td> <a href='#'>".$recordResult[0]." </a></td>
			  									<td> <font color='red'>".ordinal($makeArrayRanks[$recordSet['pk_number']])."</font> </td>
							        </tr>
							  	
							  		";
							  }
							
								echo "</table>";
    			
    			break;
    		
    			case 'Casual Interview Final';
    	
    						$sqlQuery='SELECT * FROM tblcandidate ORDER BY PK_NUMBER ASC';
    						
			    						$sqlQuery="SELECT pk_number,municipality,sum(score) as totalscore,fk_tbljudge_pkname,fk_tblcandidate_pknumber 
														from tblcandidate join tblscore on tblcandidate.pk_number = tblscore.fk_tblcandidate_pknumber
														WHERE fk_category_pkcategory='Casual Interview Final'
															group by pk_number order by sum(score) desc	limit 5";
									
								$result=mysqli_query($con,$sqlQuery);
				
								echo "<table border='1' width='100%'>";
								echo "
												<tr>
													<th class='width'>Mutya No</th>
													<th>Question and Answer</a></th>
													<th>Rank</th>
							          </tr>
							       ";
							       
							       $sql="SELECT score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
												WHERE fk_category_pkcategory = 'Casual Interview Final' 
												 AND fk_tbljudge_pkname = '".$_SESSION['username']."' ORDER BY score DESC";
												 
							  	$makeArrayRanks=makeArrayRank($sql);
								while($recordSet=mysqli_fetch_array($result))
							  {
							  	
							  	
							  	$sql="SELECT score,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
												WHERE fk_tblcandidate_pknumber = ".$recordSet['pk_number']." AND fk_category_pkcategory = 'Casual Interview Final' 
												 AND fk_tbljudge_pkname = '".$_SESSION['username']."' ";
							  	
							  	
							  	$results=mysqli_query($conection,$sql);
							  	$recordResult = mysqli_fetch_row($results);
							  	echo "
							  			<tr onclick='getPhoto(this.id)' id=".$recordSet['pk_number'].">
			  									<td   class='width'><a href='#'>".$recordSet['pk_number'] .". ". $recordSet['municipality'] ."</a></td>
			  									<td> <a href='#'>".$recordResult[0]." </a></td>
			  									<td> <font color='red'>".ordinal($makeArrayRanks[$recordSet['pk_number']])."</font> </td>
							        </tr>
							  	
							  		";
							  }
							
								echo "</table>";
    			
    			break;
    			
    			
    		}
			
		}
		
		function makeArrayRank($sql)
		{
				include('connection.php');
	  		global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
    		$conection=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);
//			echo $sql;
//			die();
				$result=mysqli_query($conection,$sql);
				$counterA=1;
				
				while($resultSet=mysqli_fetch_array($result))
				{
						
						if ($counterA==1)
						{
								$holdme=$resultSet['pk_number'];
								$rank[$resultSet['pk_number']]=1;
						}
						else
						{
								if ($rankHolder==$resultSet['score'])
								{
										$rank[$resultSet['pk_number']]=$rank[$holdme];
										$holdme=$resultSet['pk_number'];
								}
								else
								{
										$rank[$resultSet['pk_number']]=$counterA;
										$holdme=$resultSet['pk_number'];
								}
						}
						$counterA++;
						$rankHolder=$resultSet['score'];
//						echo $rankHolder."<br>";
				}
				
				mysqli_close($conection);
				return $rank;
		}
		
		function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}
		
		
    
	





?>