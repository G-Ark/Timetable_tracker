<?php
ob_start();
session_start();
//required for start of every session

$user=$_POST['uname'];
$pass=$_POST['pass'];
//required values are in the user and pass variables

$con=mysqli_connect("localhost","root","","timetable");

//connection with db established

$username = mysqli_real_escape_string($con,$user);
$query = "SELECT username, pw FROM login WHERE username = '$user';";
 
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result) == 0) // User not found. So, redirect to login_form again.
{
	echo "Username invalid!Redirecting to login page.Please wait....";
	header('Refresh:1,url= login.php');
}//redirect to login for failed login
else
{
	$row = mysqli_fetch_array($result);
	if($row["username"]==$user && $row["pw"]==$pass)
	{
		echo"You are a validated user.";
		session_regenerate_id();
		$_SESSION['sess_user_id'] = $row['pw'];
		$_SESSION['sess_username'] = $row['username'];
		session_write_close();
		header('Refresh:0,url= index.php');
	}//redirect to index for successful login
	else
	{
		echo "Credentials not correct...Please wait";
		header('Refresh:2 ,url= login.php');
	}//redirect to login for failed login
}
?>