<?php include("Include/Sessions.php"); ?>
<?php include("Include/Functions.php"); ?>
<?php include("Include/DB.php"); ?>
<?php Confirm_Login(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Comments</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/adminstyles.css">
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
                <li><a href="AddNewPost.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add New Post</a></li>
            	<li><a href="Admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
            	<li class="active"><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
            	<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
            	<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
            </ul>
         

		</div> <!--End of side area-->
         <!--start of main area-->
		<div class="col-sm-10">
			<div><?php echo Message();
               echo SuccessMessage();
			 ?></div>
			<h1>Un-Approved Comments</h1>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Date</th>
						<th>Comment</th>
						<th>Approve</th>
						<th>Delete Comment</th>
						<th>Details</th>
					</tr>
					<?php 
					  $Admin="jaysmilet";
                      $Query="SELECT * FROM comments WHERE status='OFF' ORDER BY datetime desc";
                      $Execute=mysqli_query($Connection,$Query);
                      $SrNo=0;
                      while ($DataRows=mysqli_fetch_array($Execute)) {
                      	$CommentId=$DataRows['id'];
                      	$DateTimeOfComment=$DataRows['datetime'];
                      	$PersonName=$DataRows['name'];
                      	$PersonComment=$DataRows['comment'];
                      	$CommentedPostId=$DataRows['admin_panel_id'];
                      	$SrNo++;
                      
                        if (strlen($PersonName)>10) {$PersonName=substr($PersonName,0,10)."..";}
					 ?>
					 <tr>
					 	<td><?php echo htmlentities($SrNo); ?></td>
					 	<td style="color: blue;"><?php echo htmlentities($PersonName); ?></td>
					 	<td><?php echo htmlentities($DateTimeOfComment); ?></td>
					 	<td><?php echo htmlentities($PersonComment); ?></td>
					 	<td><a href="ApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-success">Approve</span></a></td>
					 	<td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a></td>
					 	<td><a href="FullPost.php?id=<?php echo $CommentedPostId; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
					 	
					 </tr>
					 <?php } ?>
				</table>
			</div>
            <h1>Approved Comments</h1>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Date</th>
						<th>Comment</th>
						<th>Approved By</th>
						<th>Revert Approve</th>
						<th>Delete Comment</th>
						<th>Details</th>
					</tr>
					<?php 
					  
                      $Query="SELECT * FROM comments WHERE status='ON' ORDER BY datetime desc";
                      $Execute=mysqli_query($Connection,$Query);
                      $SrNo=0;
                      while ($DataRows=mysqli_fetch_array($Execute)) {
                      	$CommentId=$DataRows['id'];
                      	$DateTimeOfComment=$DataRows['datetime'];
                      	$PersonName=$DataRows['name'];
                      	$PersonComment=$DataRows['comment'];
                      	$ApprovedBy=$DataRows['approvedby'];
                      	$CommentedPostId=$DataRows['admin_panel_id'];
                      	$SrNo++;
                        if (strlen($PersonName)>10) {$PersonName=substr($PersonName,0,10)."..";}
					 ?>
					 <tr>
					 	<td><?php echo htmlentities($SrNo); ?></td>
					 	<td style="color: blue;"><?php echo htmlentities($PersonName); ?></td>
					 	<td><?php echo htmlentities($DateTimeOfComment); ?></td>
					 	<td><?php echo htmlentities($PersonComment); ?></td>
					 	<td><?php echo $ApprovedBy; ?></td>
					 	<td><a href="DisApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-warning">Dis-Approve</span></a></td>
					 	<td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a></td>
					 	<td><a href="FullPost.php?id=<?php echo $CommentedPostId; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
					 	
					 </tr>
					 <?php } ?>
				</table>
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