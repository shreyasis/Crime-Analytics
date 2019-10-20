<?php
$con = mysqli_connect("localhost","root","");
if (!$con)
{
	die('Could not connect: ' . mysqli_error());
}

mysqli_select_db($con,"weblib");

$sql="INSERT INTO crimeinfo VALUES('$_POST[t1]','$_POST[t2]','$_POST[t3]','$_POST[t4]','$_POST[t5]','$_POST[t6]','$_POST[t7]')";

if (!mysqli_query($con,$sql))
{
	die('Error: ' . mysqli_error($con));
}
mysqli_close($con);

echo "<h3 align=center>Crime details recorded successfully...</h3>";
?>

