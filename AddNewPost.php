<?php include("Include/DB.php"); ?>
<?php include("Include/Sessions.php"); ?>
<?php include("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php 
if (isset($_POST["Submit"])) {
	$Title=mysqli_real_escape_string($Connection,$_POST["Title"]);
	$Category=mysqli_real_escape_string($Connection,$_POST["Category"]);
	$Post=mysqli_real_escape_string($Connection,$_POST["Post"]);
	date_default_timezone_set("Asia/Kolkata");
    $CurrentTime=time();
    //$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
    $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
    $DateTime;
    $Admin=$_SESSION["User_name"];
    $Image=$_FILES["Image"]["name"];
    $Target="UploadedFiles/".basename($_FILES["Image"]["name"]);
if (empty($Title)) {
    	$_SESSION["ErrorMessage"]="Title can't be empty!";
    	Redirect_to("AddNewPost.php");
    	
    }elseif(strlen($Title)<2) {
    	$_SESSION["ErrorMessage"]="Title should be atleast 2 characters!";
    	Redirect_to("AddNewPost.php");
    	
    } else{
    	//global $ConnectingDB;
    	$Query="INSERT INTO admin_panel(datetime,title,category,author,image,post) VALUES('$DateTime','$Title','$Category','$Admin','$Image','$Post')";
    	$Execute=mysqli_query($Connection,$Query);
    	move_uploaded_file($_FILES["Image"]["tmp_name"], $Target); // image files moving to another location
    	if ($Execute) {
    		$_SESSION["SuccessMessage"]="Post Added!";
    		Redirect_to("AddNewPost.php");
    	}else{
    		$_SESSION["ErrorMessage"]="Something went wrong,Try Again!";
    	Redirect_to("AddNewPost.php");
    	}
    }    
} 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard </title>
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
			<li><a href="#">Home</a></li>
			<li class="active"><a href="Blog.php" target="_blank">Blog</a></li>
			<li><a href="#">About Us</a></li>
			<li><a href="#">Services</a></li>
			<li><a href="#">Contact Us</a></li>
			<li><a href="#">Feature</a></li>
		</ul>
		<form action="FullPost.php" class="navbar-form navbar-right">
			<div class="form-group">
				<input type="text" name="Search" class="form-control" placeholder="Search">
			</div>
			<button class="btn btn-default" name="SearchButton">Go</button>
		</form>
		</div>
	</div>
</nav>
<div class="Line" style="height: 10px; background: #27aae1;"></div>	

<div class="container-fluid">
	<div class="row">

		<!--start of side area-->
		<div class="col-sm-2">
			<br><br>
			
            <ul class="nav nav-pills nav-stacked" id="Side_Menu">
            	<li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
            	<li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
            	<li  class="active"><a href="AddNewPost.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add New Post</a></li>
            	<li><a href="Admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
            	<li><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
            	<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
            	<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
            </ul>
         

		</div> <!--End of side area-->
         <!--start of main area-->
		<div class="col-sm-10">
			<h1>Add New Post</h1>
            <div><?php echo Message();
               echo SuccessMessage();
			 ?></div>
			<div>
				<form action="AddNewPost.php" method="POST" enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
						<label for="title"><span class="FieldInfo"> Title:</span></label>
						<input class="form-control" type="text" name="Title" id="title" placeholder="Title">
						</div>
						<div class="form-group">
						<label for="categoryselect"><span class="FieldInfo"> Category:</span></label>
						<select class="form-control" name="Category" id="categoryselect">
                          
					<?php 
                     $ViewQuery="SELECT * FROM category ORDER BY datetime desc";
                     $Execute=mysqli_query($Connection,$ViewQuery);
                    
                     while ($DataRows=mysqli_fetch_array($Execute)) {
                     	$Id=$DataRows["id"];
                     	$CategoryName=$DataRows["name"];
                     	
                        
					 ?>
					 <option><?php echo $CategoryName; ?></option>
                       <?php } ?>

						</select>
						</div>
						<div class="form-group">
						<label for="imageselect"><span class="FieldInfo"> Select Image:</span></label>
						<input class="form-control" type="file" name="Image" id="imageselect">
						</div>
						<div class="form-group">
						<label for="postarea"><span class="FieldInfo"> Post:</span></label>
						<textarea class="form-control" name="Post" id="postarea"></textarea>
						</div>
						<br>
						<input class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Post">
					</fieldset>
					<br>
				</form>
			</div>
			
		</div><!--End of main area-->
		
	</div> <!--End of row-->
</div> <!--End of conatiner-fluid-->

<div id="Footer">
<hr><p>Designed By | Jay | &copy; jaysmilet 2018 --- All right reserved
    </p>
    	<a style="color: white; text-decoration: none; cursor: pointer;font-weight: bold;" href="http://jaysmilet.blogspot.com" target="blank">
    		<p>this site is for business purpose</p>
    	</a>

</div>
<div style="height: 10px; background: green;"></div>
</body> 
</html>