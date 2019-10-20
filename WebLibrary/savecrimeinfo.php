<html>
<head>
<title>Save Crime Details</title>
<link href="MyStyle.css" rel="stylesheet" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body id="body_book">
<center> <font face="ar christy" color=red style="font-size: 80px; text-shadow: 0px 0px 3px black">Save Crime Details</font></center>
<br>
<div class="book" style="height: 95%;">
    <h2 align="center"><b class="avatar"><center><img src="images/Book_Logo.gif"></center></b></h2> 
    <form action="savecrime.php" method="post">
    <div>
    <pre><input type="text" placeholder="Crime Category" autofocus required name="t1">
    <br><input type="text" placeholder="Longitude" autofocus required name="t2">    
	<br><input type="text" placeholder="Latitude" autofocus required name="t3">
	<br><input type="text" placeholder="Neighborhood" autofocus required name="t4">
	<br><input type="text" placeholder="Day" autofocus required name="t5">
	<br><input type="text" placeholder="Month" autofocus required name="t6">
    <br><input type="text" placeholder="Year" autofocus required name="t7">
</div>
	<!--<br><br><input type="file" required name="t6">--><br><br>
    <input type="submit" value="Save" name="submit"> <input type="Reset" value="Clear" name="reset"></pre></div>        
    </form>
</div>
</body>
</html>
