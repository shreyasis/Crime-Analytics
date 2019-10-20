<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) 
{
	if (empty($_POST['email']) || empty($_POST['pwd'])) 
	{
		$error = "Email-id or Password is invalid...";
	}
	else
	{
		$connection = mysqli_connect("localhost", "root", "", "weblib");
		$email=$_POST['email'];
		$password=$_POST['pwd'];
		$email = stripslashes($email);
		$password = stripslashes($password);
		$email = mysqli_real_escape_string($connection,$email);
		$password = mysqli_real_escape_string($connection,$password);
		$query = mysqli_query($connection, "select * from login where password='$password' AND email='$email'");
		$rows = mysqli_num_rows($query);
		if ($rows == 1)
		{
			$_SESSION['login_user']=$email; // Initializing Session to store user mail-id i.e. username
			header("location: profile.php"); // Redirecting To Other Page		
		} 
		else
		{
			$error = "Email-id or Password is invalid";
			//header('Location: index.php');	// Redirecting To Home Page
		}
		mysqli_close($connection); // Closing Connection
	}
}
?>