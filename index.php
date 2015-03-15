<?php
session_start();
if(!empty($_SESSION["user"]))
{
header('Location: home.php', true);
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Login</title>
<link rel="stylesheet" href="style.css"/>
<script src="jquery-1.11.2.min.js"></script>

	<script>
			$(document).ready(function() {
				
				$('#login').click(function()
				{
					var username=$("#username").val();
					var password=$("#password").val();
					var dataString = 'username='+username+'&password='+password;
					if($.trim(username).length>0 && $.trim(password).length>0)
					{
						
			 
						$.ajax({
							type: "POST",
							url: "ajaxLogin.php",
							data: dataString,
							cache: false,
							beforeSend: function(){ $("#login").val('Connecting...');},
							success: function(data){
								if(data)
								{
				
									$("body").load("home.php");
								}
									
								else
								{
									 $('#box1');
									 $("#login").val('Login')
									 $("#error1").html("<span style='color:#cc0000'>Error:</span> Invalid username and password. ");
								}
							}
						});
					
					}
					return false;
				});
				
				$('#create').click(function()
				{
					var user=$("#user").val();
					var pass=$("#pass").val();
					var dataStr = 'user='+user+'&pass='+pass;
					if($.trim(username).length>0 && $.trim(password).length>0)
					{
						
			 
						$.ajax({
							type: "POST",
							url: "createAcct.php",
							data: dataStr,
							cache: false,
							beforeSend: function(){ $("#create").val('Connecting...');},
							success: function(data){
								if(data)
								{
									$('#box2');
									 $("#create").val('Create')
									 $("#error2").html("<span style='color:#cc0000'>Error:</span> Account Not Created. ");
								}
								else
								{
									$('#box2');
									 $("#create").val('Create')
									 $("#error2").html("<span style='color:#3ADF00'>Success:</span> Account Created. ");
								}
							}
						});
					
					}
					return false;
				});
				
			});
	</script>
	
</head>

<body>
<div id="main">
	<h1>Login</h1>

	<div id="box1">
	<form action="" method="post">
		<label>Username</label> 
		<input type="text" name="username" class="input" autocomplete=	"off" id="username"/>
		<label>Password </label>
		<input type="password" name="password" class="input" autocomplete="off" id="password"/><br/>
		<input type="submit" class="button button-primary" value="Log In" id="login"/> 
		<span></span> 

		<div id="error1">

		</div>	
	</form>
	</div>
		
	
<br>
	
	<h2>Create Account</h2>
	
	<div id="box2">
		<form action="" method="post">
			<label>Username</label> 
			<input type="text" name="user" class="input" autocomplete=	"off" id="user"/>
			<label>Password </label>
			<input type="password" name="pass" class="input" 			autocomplete="off" id="pass"/><br/>
			<input type="submit" class="button button-primary" value="Create" id="create"/> 
			<span></span>
			<div id="error2">
			
			</div>			

		</form>
	</div>	
</div>
</body>
</html>