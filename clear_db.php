<?php
	ob_start();
	session_start();
	$con=mysqli_connect("localhost","root","","timetable");
	$query="DELETE from class where 1;";
	mysqli_query($con,$query);
	$query="DELETE from handles where 1;";
	mysqli_query($con,$query);
//	header('Refresh:1,url=index.php');
//	bool unlink ( string $filename [, resource $context ] )
?>