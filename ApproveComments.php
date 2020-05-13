<?php include("Include/DB.php"); ?>
<?php include("Include/Sessions.php"); ?>
<?php include("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php 
if (isset($_GET["id"])) {
	$IdFromURL=$_GET["id"];
    $Admin=$_SESSION["User_name"];
	$Query="UPDATE comments SET status='ON',approvedby='$Admin' WHERE id='$IdFromURL'";
	$Execute=mysqli_query($Connection,$Query);
		if ($Execute) {
    		$_SESSION["SuccessMessage"]="Comment Approved Successfully !!";
    		Redirect_to("comments.php");
    	}else{
    		$_SESSION["ErrorMessage"]="Something went wrong,Try Again!";
    	    Redirect_to("comments.php");
    	}
	}
 ?>