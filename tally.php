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



<style>
.test table {
	max-width:100%;
}

.test th {
	    text-align: center;
    padding: 8px 8px;
    background-color: #045E79;
    color: #fff;
    font-size: 13px
}

.test td {
    padding: 8px 8px;
    color: #000;
    font-size: 13px
}

</style>
  </head>

	<body>
	
			<div class="test">
			
			<table border="1" width="100%">
				<tr>
					<th>Mutya No 				</th>
					<th> Municipality 			</th>
					<th> Swimsuit 				</th>
					<th> Best in Swimsuit 		</th>
					<th> Evening Gown 			</th>
					<th> Best Evening Gown 		</th>
					<th> Preliminary Average 	</th>
					<th> Preliminary Ranking 	</th>
					<th> Q and A Top 10 		</th>
					<th> Top 10 Ranking 		</th>
					<th> Q and A Top 5 			</th>
				
					<th> Rating </th>
				</tr>
					
				<?php

					//$sql="SELECT * FROM tblcandidate join tblscore on tblcandidate.pk_number = tblscore.fk_tblcandidate_pknumber";
					$sql="SELECT sum(score)as score,sum(score)as average,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
						wHERE  fk_category_pkcategory = 'Swimsuit' 
						group by pk_number ORDER BY average DESC";
					$rankswimsuit=makeArrayRank($sql);
					
					$sql="SELECT sum(score)as score,sum(score)as average,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
						wHERE  fk_category_pkcategory = 'Evening Gown' 
						group by pk_number ORDER BY average DESC";
					$rankGown=makeArrayRank($sql);
					
					
					$sql="SELECT sum(score)as score,sum(score)as average,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
						wHERE (fk_category_pkcategory = 'Casual Interview'  OR fk_category_pkcategory = 'Swimsuit' OR fk_category_pkcategory = 'Evening Gown')
						group by pk_number ORDER BY average DESC";
					$rankPrelim=makeArrayRank($sql);
					
					
					$sql="SELECT sum(score)as score,sum(score)as average,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
						wHERE fk_category_pkcategory = 'Casual Interview Semi'  
						group by pk_number ORDER BY average DESC";
					$rankTop10=makeArrayRank($sql);
					
					$sql="SELECT sum(score)as score,sum(score)as average,pk_number FROM tblscore JOIN tblcandidate on tblscore.fk_tblcandidate_pknumber = tblcandidate.pk_number
						wHERE fk_category_pkcategory = 'Casual Interview Final'  
						group by pk_number ORDER BY average DESC";
					$rankTop5=makeArrayRank($sql);					
					
					
					
					
					
					$sql="select * from tblcandidate";
					$result=mysqli_query($con,$sql);
					
					while ($resultset = mysqli_fetch_array($result))
					{
						$swimsuit=swimsuitCategory($resultset['pk_number']);
						$eveningGown=eveningGownCategory($resultset['pk_number']);
						$top10=top10($resultset['pk_number']);
						$top5=top5($resultset['pk_number']);
						
						
			if (isset($rankTop10[$resultset['pk_number']]))
						{
							$rank1andatop10=ordinal($rankTop10[$resultset['pk_number']]);
						}
					else
					{
						$rank1andatop10=" - ";
					}
					
				if (isset($rankTop5[$resultset['pk_number']]))
						{
							$rank1andatop5=ordinal($rankTop5[$resultset['pk_number']]);
						}
					else
					{
						$rank1andatop5=" - ";
					}
					
					
				if (isset($rankswimsuit[$resultset['pk_number']]))
						{
							$rankswimsuits=ordinal($rankswimsuit[$resultset['pk_number']]);
						}
					else
					{
						$rankswimsuits=" - ";
					}	
					
					
				if (isset($rankGown[$resultset['pk_number']]))
						{
							$rankgowns=ordinal($rankGown[$resultset['pk_number']]);
						}
					else
					{
						$rankgowns=" - ";
					}
				
				if (isset($rankPrelim[$resultset['pk_number']]))
						{
							$rankprelims=ordinal($rankPrelim[$resultset['pk_number']]);
						}
					else
					{
						$rankprelims=" - ";
					}
					
					
						echo "
								<tr>
									<td>".$resultset['pk_number'].". ".$resultset['name']."
									</td>
									<td>".$resultset['municipality']."
									</td>
									<td>".($swimsuit/6)."
									</td>
									<td>
									<font color='red'>".$rankswimsuits."</font>
									</td>
									<td>".($eveningGown/6)."
									</td>	
									<td>
									<font color='red'>".$rankgowns."</font>
									</td>
									<td>".number_format((($eveningGown+$swimsuit)/2)/6,2)."
									
									</td>		
		
									<td> 
										<font color='red'>".$rankprelims."</font>
									</td>	
									
									<td>".($top10/6)."
									</td>
									
									<td> 
										<font color='red'>".$rank1andatop10."</font>
									</td>	
									
									<td>".($top5/6)."
									</td>
									<td> 
										<font color='red'>".$rank1andatop5."</font>
									</td>									
								</tr>
						
						";
						
						
						
					}


				?>
					
					
					
					
								
				
				</table>
				
				<br>
				<table border="1" width="100%">
				
				<tr>
					<th>
					Judge Name
					</th>
					<th>
					Swimsuit
					</th>
					<th>
					Evening GOwn
					</th>
					<th>
					Top 10
					</th>
					<th>
					Top 5
					</th>
					<th>
					Help
					</th>
					
				</tr>
				<?php
				
						$sql="SELECT * FROM tbljudge";
						
						$result=mysqli_query($con,$sql);
						
						while ($resultset=mysqli_fetch_array($result))
						{
							
							echo "
									<tr>
									<td>
										".$resultset['name']."
									</td>
							
									<td>
										".getJudgeScore($resultset['pk_username'],'Swimsuit')."
									</td>
									<td>
										".getJudgeScore($resultset['pk_username'],'Evening Gown')."
									</td>
									<td>
										".getJudgeScore($resultset['pk_username'],'Casual Interview Semi')."
									</td>
									<td>
										".getJudgeScore($resultset['pk_username'],'Casual Interview Final')."
									</td>
									<td>
										".helpMe($resultset['pk_username'])."
									</td>
									
									
									</tr>
							
							";
							
							
							
						}
				?>
				
				
				</table>
				
				
				
				
	
</div>
	
	
	</body>
	
	<?php
	
		function swimsuitCategory($candidateNo)
		{
			include('connection.php');
			global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
			$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);

			if (mysqli_connect_error()) 
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
						die();
			}
			
			$sql="SELECT sum(score) as score FROM tblscore WHERE fk_category_pkcategory = 'Swimsuit' AND fk_tblcandidate_pknumber = ".$candidateNo." ";
			
			$result=mysqli_query($con,$sql);
			
			if($result)
			{
				$recordResult = mysqli_fetch_row($result);
				return $recordResult[0];
				
			}
			else
			{
				
				return "-";
			}
			
			
		}
		
		function eveningGownCategory($candidateNo)
		{
			include('connection.php');
			global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
			$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);

			if (mysqli_connect_error()) 
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
						die();
			}
			
			$sql="SELECT sum(score) as score FROM tblscore WHERE fk_category_pkcategory = 'Evening Gown' AND fk_tblcandidate_pknumber = ".$candidateNo." ";
			
			$result=mysqli_query($con,$sql);
			
			if($result)
			{
				$recordResult = mysqli_fetch_row($result);
				return $recordResult[0];
				
			}
			else
			{
				
				return "-";
			}
			
			
		}
		
		function top10($candidateNo)
		{
			include('connection.php');
			global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
			$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);

			if (mysqli_connect_error()) 
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
						die();
			}
			
			$sql="SELECT sum(score) as score FROM tblscore WHERE fk_category_pkcategory = 'Casual Interview Semi' AND fk_tblcandidate_pknumber = ".$candidateNo." ";
			
			$result=mysqli_query($con,$sql);
			
			if($result)
			{
				$recordResult = mysqli_fetch_row($result);
				return $recordResult[0];
				
			}
			else
			{
				
				return "-";
			}
			
		}
		
		function top5($candidateNo)
		{
			include('connection.php');
			global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
			$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);

			if (mysqli_connect_error()) 
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
						die();
			}
			
			$sql="SELECT sum(score) as score FROM tblscore WHERE fk_category_pkcategory = 'Casual Interview Final' AND fk_tblcandidate_pknumber = ".$candidateNo." ";
			
			$result=mysqli_query($con,$sql);
			
			if($result)
			{
				$recordResult = mysqli_fetch_row($result);
				return $recordResult[0];
				
			}
			else
			{
				
				return "-";
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
		
		
		function getJudgeScore($judgename,$category)
		{
			include('connection.php');
	  		global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
    		$conection=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);
			
			
			$sql="SELECT count(*) as scoredCount FROM tblscore WHERE fk_tbljudge_pkname = '".$judgename."' AND fk_category_pkcategory = '".$category."' ";
			//echo $sql;
			$result=mysqli_query($conection,$sql);
			while ($resultset=mysqli_fetch_array($result)  )
			{
				switch ($category)
				{
					case 'Swimsuit';
					if ($resultset['scoredCount']==20)
					{
						return '1';
					}
					else
					{
						return '0';
					}
					break;
					
					case 'Evening Gown';
					if ($resultset['scoredCount']==20)
					{
						return '1';
					}
					else
					{
						return '0';
					}
					break;
					
					case 'Casual Interview Semi';
					if ($resultset['scoredCount']==10)
					{
						return '1';
					}
					else
					{
						return '0';
					}
					break;
					
					case 'Casual Interview Final';
					if ($resultset['scoredCount']==5)
					{
						return '1';
					}
					else
					{
						return '0';
					}
					break;
				}
				
				
				
			}
		}
		
		function helpMe($judgename)
		{
			include('connection.php');
	  		global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE,$con;
    		$conection=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$BD_TABLE);
			
			$sql="SELECT help FROM tbljudge WHERE pk_username = '".$judgename."' ";
			$result=mysqli_query($conection,$sql);
			
			while ($resultset=mysqli_fetch_array($result))
			{
				if ($resultset['help']==1)
				{
					return 1;
				}
				else
				{
					return 0;
				}
				
			}
			
		}
	?>
	
