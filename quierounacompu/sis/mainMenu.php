<?php 
	include_once("includes/header.php");
	include_once("classes/Constants.php");
?>

<div class="centered" style="text-align: center;">
	<br />
	<br />
	
	<?php 
		if(isset($_SESSION[Constants::$KEY_MESSAGE_ERROR])){
	?>
			<span class="smallError">
				<?php echo $_SESSION[Constants::$KEY_MESSAGE_ERROR];?>
			</span>
	<?php
			unset($_SESSION[Constants::$KEY_MESSAGE_ERROR]);
		}
	?>
	
	<?php 
		if(isset($_SESSION[Constants::$KEY_MESSAGE_OPERATION])){
	?>
			<h3>
				<?php echo $_SESSION[Constants::$KEY_MESSAGE_OPERATION];?>
			</h3>
				
			</span>
	<?php
			unset($_SESSION[Constants::$KEY_MESSAGE_OPERATION]);
		}
	?>
	
	<br />
	<br />
</div>

<?php include_once("includes/footer.php");?>