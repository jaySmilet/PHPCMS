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
    $Admin="Jaysmilet";
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
    	$EditFromURL=$_GET['Edit'];
    	$Query="UPDATE admin_panel SET datetime='$DateTime',title='$Title',category='$Category',author='$Admin',image='$Image',post='$Post' WHERE id='$EditFromURL'";
    	$Execute=mysqli_query($Connection,$Query);
    	move_uploaded_file($_FILES["Image"]["tmp_name"], $Target); // image files moving to another location
    	if ($Execute) {
    		$_SESSION["SuccessMessage"]="Post Updated!";
    		Redirect_to("dashboard.php");
    	}else{
    		$_SESSION["ErrorMessage"]="Something went wrong,Try Again!";
    	Redirect_to("dashboard.php");
    	}
    }    
} 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Post</title>
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

<div class="container-fluid">
	<div class="row">

		<!--start of side area-->
		<div class="col-sm-2">
			
			
            <ul class="nav nav-pills nav-stacked" id="Side_Menu">
            	<li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
            	<li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
            	<li  class="active"><a href="AddNewPost.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add New Post</a></li>
            	<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
            	<li><a href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
            	<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
            	<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
            </ul>
         

		</div> <!--End of side area-->
         <!--start of main area-->
		<div class="col-sm-10">
			<h1>Update Post</h1>
            <div><?php echo Message();
               echo SuccessMessage();
			 ?></div>
			<div>
				<?php 
				   $SearchQueryParameter=$_GET['Edit'];
                    $Query="SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
                    $ExecuteQuery=mysqli_query($Connection,$Query);
                    while ($DataRows=mysqli_fetch_array($ExecuteQuery)) {
                    	$TitleToBeUpdated=$DataRows['title'];
                    	$CategoryToBeUpdated=$DataRows['category'];
                    	$ImageToBeUpdated=$DataRows['image'];
                    	$PostToBeUpdated=$DataRows['post'];
                    }

				 ?>
				<form action="EditPost.php?Edit=<?php echo $SearchQueryParameter; ?>" method="POST" enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
						<label for="title"><span class="FieldInfo"> Title:</span></label>
						<input value="<?php echo $TitleToBeUpdated; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
						</div>
						<div class="form-group">
						<label for="categoryselect"><span class="FieldInfo">Existing Category: </span></label>
						<?php 
						echo $CategoryToBeUpdated; ?>
						<br>
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
					    <label for="imageselect"><span class="FieldInfo"> Existing Image:</span></label>
					     <img src="UploadedFiles/<?php echo $ImageToBeUpdated; ?>" width="170px"; height="60px";>  
						<br>
						<label for="imageselect"><span class="FieldInfo"> Select Image:</span></label>
						<input class="form-control" type="file" name="Image" id="imageselect">
						</div>
						<div class="form-group">
						<label for="postarea"><span class="FieldInfo"> Post:</span></label>
						<textarea class="form-control" name="Post" id="postarea">
							<?php echo $PostToBeUpdated; ?>
						</textarea>
						</div>
						<br>
						<input class="btn btn-success btn-block" type="submit" name="Submit" value="Update Post">
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