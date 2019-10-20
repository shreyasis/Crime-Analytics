<?php
include("login.php");
?>
<html>
<head>
<title>EdEasy</title>
<link href="MyStyle.css" rel="stylesheet" type="text/css"/>
<link href="Book.ico" rel="shortcut icon"/>
</head>

<body style="background-image:url(images/indexbg.jpg);background-attachment:fixed;background-repeat:no-repeat;background-size:100%;">
    <link href="https://fonts.googleapis.com/css?family=Kristi" rel="stylesheet">
<br><br><br>
   <center> <font face: 'Kristi', cursive; color=red style="font-size: 80px; text-shadow: 0px 0px 3px black"> Agent Login Portal</font></center>
<div class="login" style="height:50%;">
    <h2 style="height:25%; float:center;"><b class="avatar"><center><img src="images/Key-512.png"></center></b></h2>
    <div>
    <form action="" method="post">
        <br><label>Email-id</label><br>
        <input type="text" placeholder="abc@xyz.com" autofocus required name="email"><br>
        <br><label>Password</label><br>
        <input type="password" placeholder="Password" autofocus required name="pwd"><br>
        </div>
        <div>
        <h4 align=center><font color=yellow><?php echo $error; ?></font></h4>
        </div>
        <div>
            <a href=guest.php><font face="ar christy" color=orange style="font-size: 25px; text-shadow: 0px 0px 3px black">Login as guest</font></a>
            <!--<a href=signup.php><font face="ar christy" color=orange style="font-size: 25px; text-shadow: 0px 0px 3px black">Signup Now</font></a>-->
        <input type="submit" value="Login" name="submit" style="float:right;line-height:30px;">
        </div>
        <div>
            <br><br>
            <a href=signup.php><font face="ar christy" color=orange style="font-size: 25px; text-shadow: 0px 0px 3px black">Signup Now</font></a>
        <!--<a href=guest.php><font face="ar christy" color=orange style="font-size: 25px; text-shadow: 0px 0px 3px black">Login as guest</font></a>-->
        </div>
    </form>
</div>
<br>
<br><br>
<h4 align=center style="background:black;padding:5pt;opacity:0.5;border-radius:10pt;"><font color=pink>
Crime Analytics</font>
</h4>
</body>
</html>
