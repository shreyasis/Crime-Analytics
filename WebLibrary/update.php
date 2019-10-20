<?php
session_start();
$error='';

$con=mysqli_connect("localhost","root","","weblib");

if(isset($_POST["pwd"]) || isset($_POST["rpwd"]) || isset($_POST["email"]))
{
	if(strcmp($_POST["pwd"],$_POST["rpwd"])==0)
	{		
		if(strlen($_POST["pwd"])>=5)
		{
			$mname=$_POST['fname'].' '.$_POST['lname'];
			$sql="INSERT INTO login (member_name,email,password) VALUES ('{$mname}','{$_POST['email']}','{$_POST['pwd']}')";			
			if (!mysqli_query($sql,$con))
			{
				$error="Email id already registered. Try another...";
				mysqli_close($con);
			}
			else
			{
				$_SESSION['login_user']=$_POST['email'];
				header('Location: Profile.php');
			}
		}
		else
			$error="Password should be at least of 5 characters...";		
	}
	else
		$error="Password mis-matched...";
}
?>