<?php
	ob_start();
	session_start();
//	include "navigation.php";
	date_default_timezone_set('Asia/Kolkata');
	$fname= date("Y.m.d")."sql";
	echo "Here!";
	//exec('mysqldump --user=... --password=... --host=... DB_NAME > /path/to/output/file.sql');
	$con=mysqli_connect("localhost","root","","timetable");
	$query="SELECT * INTO OUTFILE '$fname' FROM timetable";
$table_name = "timetable";
$backup_file  = "timetable.sql";
$sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";

mysql_select_db('timetable');
$retval = mysql_query( $sql);

	//mysqli_query($con.$query);
	echo "pAssing exec";
	//$query="DELETE from class where 1;";
	//mysql_query($query);
	//$query="DELETE from handles where 1;";
//	mysql_query($query);
//	header('Refresh:1,url=index.php');
//	bool unlink ( string $filename [, resource $context ] )
?>