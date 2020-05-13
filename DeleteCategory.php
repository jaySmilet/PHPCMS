<?php include("Include/DB.php"); ?>
<?php include("Include/Sessions.php"); ?>
<?php include("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php 
if (isset($_GET["id"])) {
	$IdFromURL=$_GET["id"];
	$Query="DELETE FROM category WHERE id='$IdFromURL'";
	$Execute=mysqli_query($Connection,$Query);
		if ($Execute) {
    		$_SESSION["SuccessMessage"]="Category Deleted Successfully !!";
    		Redirect_to("categories.php");
    	}else{
    		$_SESSION["ErrorMessage"]="Something went wrong,Try Again!";
    	    Redirect_to("categories.php");
    	}
	}
 ?>