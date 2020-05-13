<?php include("Include/DB.php"); ?>
<?php include("Include/Sessions.php"); ?>
<?php include("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php 
if (isset($_GET["id"])) {
	$IdFromURL=$_GET["id"];
	$Query="DELETE FROM registration WHERE id='$IdFromURL'";
	$Execute=mysqli_query($Connection,$Query);
		if ($Execute) {
    		$_SESSION["SuccessMessage"]="Admin Deleted Successfully !!";
    		Redirect_to("Admins.php");
    	}else{
    		$_SESSION["ErrorMessage"]="Something went wrong,Try Again!";
    	    Redirect_to("Admins.php");
    	}
	}
 ?>