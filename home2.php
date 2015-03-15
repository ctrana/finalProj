<?php
session_start();
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","tranac-db","GxMuVbwDqQKe5OMo","tranac-db");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Home</title>
<link rel="stylesheet" href="style.css"/>
<script src="jquery-1.11.2.min.js"></script>

	<script>


			$(document).ready(function() {
				
				$('#subRev').click(function()
				{
					var make=$("#make").val();
					var model=$("#model").val();
					var year=$("#year").val();
					var comments=$("#comments").val();
					var share=$("#share").val();
					var dataSt = 'make='+make+'&model='+model+'&year='+year+'&comments='+comments+'&share='+share;
					
					
						$.ajax({
							type: "POST",
							url: "addReview.php",
							data: dataSt,
							cache: false,
							beforeSend: function(){ $("#subRev").val('Connecting...');},
							success: function(data){
								if(data)
								{
									$.ajax({
										type: "POST",
										url: "reviews.php",
										data: dataSt,
										cache: false,
										success: function(data){
											if(data)
											{
												$("#reviews").append(data);
											}
											else
											{
												 
											}
										}
									});
								}
								else
								{
									 $('#newReview');
									 $("#subRev").val('subRev')
									 $("#error3").html("<span style='color:#cc0000'>Error:</span> Invalid username and password. ");
								}
							}
						});
						
					
				
				});
			});
			
	</script>
	
</head>
<body>
	<div id="main">
		<div id="greeting">
			<P>
				<?php
					echo "Hello " . $_SESSION['userName'];
				?>
			</p>
		</div>
		
		<div id="reviews">
			<fieldset>
			<legend>Reviews</legend>
			<table>
			  <tr>
				<td>Make</td>
				<td>Model</td>
				<td>Year</td>
				<td>Comments</td>
				
			
			   </tr>
		    </table>
			</fieldset>
		</div>
		
	<br>
	
		<div id="newReview">
			<fieldset>
				<legend >Create New Review</legend>
				<form method="POST" action="">
					
					<label>Car Make</label> 
					<input type="text" name="make" class="input" autocomplete="off" id="make"/>
					
					<label>Car Model</label> 
					<input type="text" name="model" class="input" autocomplete="off" id="model"/>
					
					<label>Year</label> 
					<input type="text" name="year" class="input" autocomplete="off" id="year"/>
					
					<Label>Comments</label>
					<textarea name ="comments"  class="input" id="comments"> 
					</textarea>
					
					<label>Share Review</label>
					<fieldset id="shared">
						<select  id="share" name="share">
						  <option value="1">Yes</option>
						  <option selected value="0">No</option>
						</select>
					</fieldset> 
					
					<br>
					
					<input type="submit" class="button button-primary" value="Submit" id="subRev"/>
					
					<span></span>
					<div id="error3">
					
					</div>
					
				</form>
			</fieldset>	
					
		</div>
		
		<a href="logout.php">Logout</a>
	</div>
	
</body>
</html>