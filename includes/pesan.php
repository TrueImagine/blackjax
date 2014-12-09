<?php
	if(!empty($_SESSION['message'])){
		echo "<div id=\"message\">";
		echo "<h3>Notice:</h3>";
		echo $_SESSION["message"];
		echo "</div>";
		$_SESSION['message'] = null;
		echo "<br>";
	}
?>