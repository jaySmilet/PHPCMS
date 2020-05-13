<?php include("Include/DB.php"); ?>
<?php include("Include/Sessions.php"); ?>
<?php include("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php 
if (isset($_GET["id"])) {
	$IdFromURL=$_GET["id"];
	$Query="UPDATE comments SET status='OFF' WHERE id='$IdFromURL'";
	$Execute=mysqli_query($Connection,$Query);
		if ($Execute) {
    		$_SESSION["SuccessMessage"]="Comment Dis-Approved Successfully !!";
    		Redirect_to("comments.php");
    	}else{
    		$_SESSION["ErrorMessage"]="Something went wrong,Try Again!";
    	    Redirect_to("comments.php");
    	}
	}
 ?>