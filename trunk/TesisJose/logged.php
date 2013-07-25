<?php
	include_once 'includes/header.php';
	
	if(! SessionUtil::checkIfUserIsLogged()){
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_MUST_BE_LOGGED;
		header("Location: index.php");
	}
?>
	
<?php
	include_once 'includes/footer.html';
?>