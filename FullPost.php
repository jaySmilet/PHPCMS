<?php include("Include/DB.php"); ?>
<?php include("Include/Sessions.php"); ?>
<?php include("Include/Functions.php"); ?>
<?php 
if (isset($_POST["Submit"])) {
	$Name=mysqli_real_escape_string($Connection,$_POST["Name"]);
	$Email=mysqli_real_escape_string($Connection,$_POST["Email"]);
	$Comment=mysqli_real_escape_string($Connection,$_POST["Comment"]);
	date_default_timezone_set("Asia/Kolkata");
    $CurrentTime=time();
    //$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
    $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
    $DateTime;
    $PostId=$_GET["id"];
if (empty($Name)||empty($Email)||empty($Comment)) {
    	$_SESSION["ErrorMessage"]="All Fields are required !!";
        } elseif(strlen($Comment)>500) {
    	$_SESSION["ErrorMessage"]="Comment should be less than 500 characters!"; 
    } else{
    	//global $ConnectingDB;
    	$PostIDFromURL=$_GET['id'];
    	$Query="INSERT INTO comments (datetime,name,email,comment,approvedby,status,admin_panel_id) VALUES('$DateTime','$Name','$Email','$Comment','Pending','OFF','$PostIDFromURL')";
    	$Execute=mysqli_query($Connection,$Query);
    	if ($Execute) {
    		$_SESSION["SuccessMessage"]="Comment Submitted Successfully! Wait for admin approval";
    		Redirect_to("FullPost.php?id={$PostId}");
    	}else{
    		$_SESSION["ErrorMessage"]="Something went wrong,Try Again!";
    	Redirect_to("FullPost.php?id={$PostId}");
    	}
    }    
} 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<?php 
             $PostIDFromURL=$_GET["id"];			
              $ViewQuery="SELECT * FROM admin_panel WHERE id='$PostIDFromURL'";
			
			  $Execute=mysqli_query($Connection,$ViewQuery);
			  while ($DataRows=mysqli_fetch_array($Execute)) {
			  	$PostId=$DataRows["id"];
			  	$Title=$DataRows["title"];
		 ?>
		 <?php echo htmlentities($Title); ?>
		<?php } ?>
	</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/publicstyles.css">
	<style>
		.FieldInfo{
			color: rgb(251,174,44);
			font-family: Bitter,Georgia,"Times New Roman",Times,serif;
			font-size: 1.2em;
		}
		
		.col-sm-3{
			background-color: yellow;
		}
		.CommentBlock{
			background-color: #f2f7f9;
		}
		.Comment-info{
			color: #365899;
			font-family: sans-serif;
			font-size: 1.1em;
			font-weight: bold;
			padding-top: 10px;
		}
		.Comment{
			margin-top: -2px;
			padding-bottom: 10px;
			font-size: 1.1em;
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
			<li class="active"><a href="Blog.php">Blog</a></li>
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
<div class="container"> <!-- Container Area Start -->
	<div>
		<h1>The Complete Information Provider</h1>
		<p class="lead">Read only genuine articles from here</p>
	</div>
	<div><?php echo Message();
               echo SuccessMessage();
			 ?></div>
	<div class="row"> <!-- Row Area Start -->
		<div class="col-sm-8"> <!-- Main Area Start -->
			<?php 
			if (isset($_GET["SearchButton"])) {
				$Search=$_GET["Search"];
				$ViewQuery="SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%' ";
			} else {
				$PostIDFromURL=$_GET["id"];			
              $ViewQuery="SELECT * FROM admin_panel WHERE id='$PostIDFromURL' ORDER BY datetime desc";
			}
			  $Execute=mysqli_query($Connection,$ViewQuery);
			  while ($DataRows=mysqli_fetch_array($Execute)) {
			  	$PostId=$DataRows["id"];
			  	$DateTime=$DataRows["datetime"];
			  	$Title=$DataRows["title"];
			  	$Category=$DataRows["category"];
			  	$Admin=$DataRows["author"];
			  	$Image=$DataRows["image"];
			  	$Post=$DataRows["post"];
			  
			 ?>
			 <div class="blogpost thumbnail">
			 	<img class="img-responsive img-rounded" src="UploadedFiles/<?php echo $Image; ?>">
			 	<div class="caption">
			 	<h1 id="heading"><?php echo htmlentities($Title); ?></h1>
			 	<p class="description">Category: <?php echo htmlentities($Category); ?> Published on: <?php echo htmlentities($DateTime); ?></p>
			 	<p class="post"><?php echo $Post; ?></p>
			    </div>
			    
			 </div>
			 
			<?php } ?>
			<span class="FieldInfo"> Comments:</span><br>
			<?php 
              $PostIdForComments=$_GET["id"];
              $ExtractingCommentsQuery="SELECT * FROM comments WHERE admin_panel_id='$PostIdForComments' AND status='ON'";
              $Execute=mysqli_query($Connection,$ExtractingCommentsQuery);
              while ($DataRows=mysqli_fetch_array($Execute)) {
              	$CommentDate=$DataRows["datetime"];
              	$CommenterName=$DataRows["name"];
              	$Comments=$DataRows["comment"];
              

			 ?>
			 <div class="CommentBlock">
			 	<img style="margin-left: 10px; margin-top: 10px;" class="pull-left" src="images/12.png" width="70px"; height="70px";>
			 	<p style="margin-left: 120px;" class="Comment-info"><?php echo $CommenterName; ?></p>
			 	<p style="margin-left: 120px;" class="description"><?php echo $CommentDate; ?></p>
			 	<p style="margin-left: 120px;" class="Comment"><?php echo $Comments; ?></p>
			 </div>
		
			 <hr>
			 <?php } ?>
			<span class="FieldInfo"> Share your thoughts about this post:</span>
			
			
			<div>
				<form action="FullPost.php?id=<?php echo $PostId; ?>" method="POST" enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
						<label for="name"><span class="FieldInfo"> Name:</span></label>
						<input class="form-control" type="text" name="Name" id="name" placeholder="Name">
						</div>
						<div class="form-group">
						<label for="email"><span class="FieldInfo"> Email:</span></label>
						<input class="form-control" type="email" name="Email" id="Email" placeholder="Email">
						</div>
						<div class="form-group">
						<label for="commentarea"><span class="FieldInfo"> Comment:</span></label>
						<textarea class="form-control" name="Comment" id="commentarea"></textarea>
						</div>
						<br>
						<input class="btn btn-primary" type="submit" name="Submit" value="Submit">
					</fieldset>
					<br>
				</form>
			</div>
			
		</div> <!-- Main Area End -->
		<div class="col-sm-offset-1 col-sm-3"> <!-- Side Area Start -->
			<h3>Hello World</h3>
			<p>Welcome to my home page! Myself Jay and I love to write articles Welcome to my home page! Myself Jay and I love to write articles Welcome to my home page! Myself Jay and I love to write articles Welcome to my home page! Myself Jay and I love to write articles Welcome to my home page! Myself Jay and I love to write articles Welcome to my home page! Myself Jay and I love to write articles Welcome to my home page! Myself Jay and I love to write articles Welcome to my home page! Myself Jay and I love to write articles Welcome to my home page! Myself Jay and I love to write articles.
    </p>
		</div> <!-- Side Area End -->
		
	</div> <!-- Row Area End -->
	
</div> <!-- Container Area End -->

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