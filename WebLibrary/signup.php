<html>
<head>
<title>Sign Up</title>
<link href="MyStyle1.css" rel="stylesheet" type="text/css" />
<link href="Book.ico" rel="shortcut icon" />
</head>

<body style="background-image:url(images/indexbg.jpg);background-repeat:no-repeat;background-size:100%;">
    <form name=f1 method=post action='signup.php'>
<table width="99%" height="80%" border="0" cellpadding="0">
  <tr>
    <td align="center" width="30%"></td>
    <td valign="top">
        <table width="99%" border="0" cellpadding="0" cellspacing="0">
          <tr>
              <td colspan="2"><h3 align=right style="padding-right: 70px;"><a href=index.php><font face="ar christy" color=red style="font-size: 25px; text-shadow: 0px 0px 3px black">Back to login page</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face="ar christy" color=red style="font-size: 80px; text-shadow: 0px 0px 3px black">Sign Up</font></h3></td>
          </tr>
          <tr>
            <td width="35%" >&nbsp;</td>
            <td width="65%"><span style="color:#F00; font-family:'Comic Sans MS'; font-size:18px;"></span></td>
          </tr>
          <form method="post" action="">
          <tr>
            <td><label>Agent Name&nbsp;<b style="color:#F00; font-size:22px;">*</b>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
            <td><input type="text" name="fname" placeholder="First Name" style="width:45%;" required max="25">&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="lname" required max="24" placeholder="Last Name" style="width:45%;"></td>
          </tr>          
          <tr>
          	<td><label>Agent E-mail&nbsp;<b style="color:#F00; font-size:22px;">*</b>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
            <td><input type="email" name="email" placeholder="abc@xyz.com" style="width:93%;" required max="50"></td>
          </tr>
          <tr>
          	<td><label>Agency Name&nbsp;<b style="color:#F00; font-size:22px;">*</b>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
            <td><input type="text" name="ag_name" placeholder="hackharvard" style="width:93%;" required max="50"></td>
          </tr>
          <tr>
          	<td><label>Password&nbsp;<b style="color:#F00; font-size:22px;">*</b>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
            <td><input type="password" name="pwd" placeholder="Password" style="width:93%;" required max="30"></td>
          </tr>
          <tr>
          	<td><label>Re-enter Password&nbsp;<b style="color:#F00; font-size:22px;">*</b>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
            <td><input type="password" name="rpwd" placeholder="Re-enter Password" style="width:93%;" required max="50"></td>
          </tr>
		  <tr>
            <td width="35%" >&nbsp;</td>
            <td width="65%">&nbsp;</td>
          </tr>
          <tr>
            <td align="right"><input type="reset" value="Clear"></td>
            <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Sign Up" style="float:none;"></td>
          </tr>
          </form>
        </table>
	</td>
  </tr>
</table>
    </form>
    <?php
                if(isset($_POST['pwd']) && $_POST['pwd']!=null && isset($_POST['rpwd']) && $_POST['rpwd']!=""){
                    if($_POST['pwd'] != $_POST['rpwd']){
                        echo"<script language='javascript'>
                                window.alert('Passwords do not match');
                            </script>
                            ";
                    }
                    else{
                        $con = mysqli_connect("localhost","root","","weblib");
                        if(mysqli_connect_errno()){
                            echo "Could not connect.";
                        }
                        $query = "SELECT * FROM login WHERE EMAIL = '{$_POST['email']}'";
                        $queryArray = mysqli_fetch_array(mysqli_query($con,$query));
                        if(empty($queryArray['EMAIL'])){
                            $name=$_POST['fname'].$_POST['lname'];
                            mysqli_query($con,"INSERT INTO login VALUES ('$name','{$_POST['email']}','{$_POST['pwd']}','{$_POST['ag_name']}')");
                            mysqli_close($con);
                            echo "<script language='javascript'>
                                    window.alert('New account created. You will be redirected to login page when you click ok');
                                    setTimeout(function(){
                                       window.location='index.php';
                                    }, 300);
                                    </script>
                                    ";
                        }
                        else{
                            echo"<script language='javascript'>
                                    window.alert('Email already exists. Please choose a different email-id');
                                </script>
                                ";
                        }
                    }
                }
                ?>
<br>
<h4 align=center style="background:black;padding:5pt;opacity:0.5;border-radius:10pt;"><font color=pink>
Crime Analytics<!--<br>Developed By: Anindit, Ankita and Shreyasis--></font>
</h4>
</body>
</html>
