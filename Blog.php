<?php include("Include/DB.php"); ?>
<?php include("Include/Sessions.php"); ?>
<?php include("Include/Functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>ADS Siyapa</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/publicstyles.css">
	<style>
		
		.col-sm-3{
			background-color: yellow;
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
		<form action="Blog.php" class="navbar-form navbar-right">
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
	<div class="row"> <!-- Row Area Start -->
		<div class="col-sm-8"> <!-- Main Area Start -->
			<?php 
			if (isset($_GET["SearchButton"])) {
				$Search=$_GET["Search"];
				$ViewQuery="SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%' ";
			} else {
							
              $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc";
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
			 	<p class="post"><?php 
			 	if (strlen($Post)>150) {$Post=substr($Post,0,150)."...";}
			 	echo $Post; ?></p>
			    </div>
			    <a href="FullPost.php?id=<?php echo $PostId; ?>"><span class="btn btn-info">Read More &rsaquo;&rsaquo;</span></a>
			 </div>
			 
			<?php } ?>
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