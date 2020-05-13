<?php include("Include/DB.php"); ?>
<?php include("Include/Sessions.php"); ?>
<?php include("Include/Functions.php"); ?>
<?php 
if (isset($_POST["Submit"])) {
	$Username=mysqli_real_escape_string($Connection,$_POST["Username"]);
	$Password=mysqli_real_escape_string($Connection,$_POST["Password"]);
if (empty($Username)||empty($Password)) {
    	$_SESSION["ErrorMessage"]="All Fields must be filled out!";
    	Redirect_to("Login.php");  
    }else{
    	$Found_Account=Login_Attempt($Username,$Password);
    	$_SESSION["User_id"]=$Found_Account["id"];
    	$_SESSION["User_name"]=$Found_Account["username"];
    	if($Found_Account) {
    		$_SESSION["SuccessMessage"]="Welcome {$_SESSION["User_name"]} !";
    	    Redirect_to("dashboard.php");
    	} else {
    		$_SESSION["ErrorMessage"]="Invalid Username / Password!";
    	    Redirect_to("Login.php"); 
    	}
    	
    }    
} 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Admins</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/adminstyles.css">
	<style>
		.FieldInfo{
			color: rgb(251,174,44);
			font-family: Bitter,Georgia,"Times New Roman",Times,serif;
			font-size: 1.2em;
		}
		body{
			background-color: #ffffff;
		}
	</style>
</head>
<body>
<div style="height: 10px; background: #27aae1;"></div>
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
				<span class="sr-only">Toogle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="Blog.php"><img src="images/ADS Siyapa.jpg" style="margin-top: -14.5px;"></a>
		</div>
		<div class="collapse navbar-collapse" id="collapse">
		<ul class="nav navbar-nav">
			
		</ul>
		</div>
	</div>
</nav>
<div class="Line" style="height: 10px; background: #27aae1;"></div>	

<div class="container-fluid">
	<div class="row">
         <!--start of main area-->
		<div class="col-sm-offset-4 col-sm-4">
			<br><br><br><br>
			 <div><?php echo Message();
               echo SuccessMessage();
			 ?></div>
			<h2>Welcome back !</h2>
			<div>
				<form action="Login.php" method="POST">
					<fieldset>
						<div class="form-group">
	                    <label for="Username"><span class="FieldInfo"> Username:</span></label>
	                    <div class="input-group input-group-lg">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-envelope text-primary"></span>
								</span>
						<input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
						</div>
						</div>
						<div class="form-group">
						<label for="Password"><span class="FieldInfo"> Password:</span></label>
						<div class="input-group input-group-lg">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-lock text-primary"></span>
								</span>
						<input class="form-control" type="password" name="Password" id="categoryname" placeholder="Password">
					</div>
						</div>
						<br>
						<input class="btn btn-info btn-block" type="submit" name="Submit" value="Login">
					</fieldset>
					<br>
				</form>
			</div>
			
		
	</div> <!--End of row-->
</div> <!--End of conatiner-fluid-->


</body> 
</html>