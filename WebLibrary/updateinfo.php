<?php
 error_reporting(E_ALL); ini_set('display_errors', 1);
?>
<?php
include('Session.php');
?>
<HTML>
    <head><link rel=stylesheet href='tableCSS.css' type="text/css">
    <link href="MyStyle.css" rel="stylesheet" type="text/css"/>
        <style>
    #main{
	background: transparent;
}
#main .main_color{
	background: rgba(255, 255, 255, 0.3);
	border-radius: 10px 10px 10px 10px;
	width: 1000px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>
<body text=navy>
<center> <font face="ar christy" color=red style="font-size: 80px; text-shadow: 0px 0px 3px black">Update Info</font></center>
    <div class=book style="height: 50%;">
<FORM NAME=F1 METHOD=POST ACTION="updateinfo.php">
    <div>
    <pre><input type="text" placeholder="Current Username" autofocus required name="tt4"> <br>
<input type="text" placeholder="New Username" autofocus required name="tt1"> <br>
<input type="password" placeholder="New password" autofocus required name="tt2"> <br>
<input type="password" placeholder="Confirm password" autofocus required name="tt3"> <br>
<input type="submit" value="Update" name="submit"> <input type="Reset" value="Clear" name="reset"></pre></div>        
        </form></div>
        <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 

                <?php
                if(isset($_POST['tt1']) && isset($_POST['tt2']) && isset($_POST['tt3']) && isset($_POST['tt4'])){                    
                    $con = mysqli_connect("localhost","root","","weblib");
                    if(mysqli_connect_errno()){
                        echo "Could not connect.";
                    }
                    $query = "SELECT * FROM login WHERE MEMBER_NAME = '{$_POST['tt1']}'";
                    $queryArray = mysqli_fetch_array(mysqli_query($con,$query));
                    if($_POST['tt2']==$_POST['tt3']){                
                        if(empty($queryArray['MEMBER_NAME'])){
                            mysqli_query($con,"UPDATE login SET MEMBER_NAME = '{$_POST['tt1']}', PASSWORD = '{$_POST['tt2']}' WHERE MEMBER_NAME = '{$_POST['tt4']}'");
                            echo "
                                <script language='javascript'>
                                    window.alert('Profile information successfully updated. Click ok to continue');
                                    location.reload();
                                </script>
                                 ";
                        }
                        else{
                            echo "
                                <script language='javascript'>
                                    window.alert('Username already exists. Please choose a different username');
                                </script>
                                 ";
                        }
                    }
                    else{
                        echo "
                            <script language='javascript'>
                                window.alert('Passwords do not match');
                            </script>
                             ";
                    }
                }
                ?>
    </body>
</HTML>