<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect("localhost", "root", "");

// Selecting Database
$db = mysqli_select_db($connection,"weblib");

session_start();	// Starting Session

if(isset($_SESSION['login_user']) && $_SESSION['login_user']!='')
	$user_check=$_SESSION['login_user'];	// Storing Session
else
{
	mysqli_close($connection);		// Closing Connection	
	header('Location: index.php');	// Redirecting To Home Page
}

$login_email='';

// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($connection,"select MEMBER_NAME from login where email='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session=$row['MEMBER_NAME'];		//Store the Member Full Name that will display on profile page
if(isset($login_session) && $login_session=='')
{
	mysqli_close($connection);		// Closing Connection	
	header('Location: index.php');	// Redirecting To Home Page
}
?>