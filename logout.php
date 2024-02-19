<?php
	/* distrugge la sessione attiva */
	$sname=session_name();
	session_destroy();
	/* ed elimina il cookie corrispondente */
	if (isset($_COOKIE[session_name()])) {
		setcookie($sname,'', time()-3600,'/');
	}
	header('Location: homepage.php'); 
	exit();
?>
