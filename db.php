<?php
//connection to database
	$a = mysqli_connect("parker-production.com.mysql", "parker_production_com", "RU3bWDykgABBpaDaGKjGSSN9") or die("Error processing the request.");
	mysqli_select_db($a, "parker_production_com") or die("Could not connect to database."); //database name=gamequiz
	//echo "Connected";
?>