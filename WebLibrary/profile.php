 <?php
include('session.php');
?>
<html>
<head>
<title><?php echo $login_session; ?> : Home</title>
<link href="Book.ico" rel="shortcut icon" type="image/x-icon">
<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400,700,500);
    <link href="https://fonts.googleapis.com/css?family=Yellowtail" rel="stylesheet">

/* main Styles */

html { box-sizing: border-box; }

*, *:before, *:after { box-sizing: inherit; }

a { text-decoration: none; }

.container {
    width: 1000px;
    margin: auto;
}

h1 { text-align:center; margin-top:150px;}

nav {
    border-top: 5px solid #B60911;
	box-shadow: 0px 0px 4px 0px #000;
	background: #425A87;
    border-radius: 6px;
	/*position: fixed;*/
}

nav ul {
    font-family: 'Yellowtail';
    color: white;
    font-size: 10;
    margin: 0;
    padding: 0;
}

nav ul li {
  display: inline-block;
  position: relative;
}

nav ul li a {
  color: #fff;
  display: block;
    font-family: 'Yellowtail';
    color: white;
    text-shadow: 0px 0px 3px black;
  font-size: 19px;
  padding: 15px 10px;
  transition: 0.3s linear;
}

nav ul li a:hover {
    text-shadow: 0px 0px 5px lightgreen;
	background: #293854; }

nav ul li ul {
  border-bottom: 5px solid lightgreen;
  display: none;
  position: absolute;
  width: 250px;
}

nav ul li ul li {
  border-top: 1px solid #444;
  display: block;
}

nav ul li ul li:first-child { border-top: none; }

nav ul li ul li a {
  background: #373737;
  display: block;
  padding: 10px 14px;
}

nav ul li ul li a:hover {
    text-shadow: 0px 0px 5px lightgreen;
	background: #293854; }

nav .fa.fa-angle-down { margin-left: 6px; }
.imgcnt {
  display: block;
  margin-left: 35%;
  margin-right: 65%;
  width: 30%;
}
    </style>
</head>
<body style="background-image:url(images/bggg.jpg);background-repeat:no-repeat;background-size:100%; background-attachment:fixed;">
<header style="height:25px; background-color:black;">
<?php
echo "<nav>
<div class='container'>
  <ul>
    <li><a href='profile.php'>Home</a></li>
    <li><a href='aboutus.php' target='frm1'>About Us</a></li>
    <li> <a href='#'>Agent<i class='fa fa-angle-down'></i></a>
      <ul>
        <li><a href='savecrimeinfo.php' target='frm1'>Save New Crime</a></li>
        <li><a href='viewcrimepoint.php' target='frm1'>View Crime Points</a></li>
      </ul>
    </li>
    <li><a href='feedback.php' target='frm1'>Feedback</a></li>
    <li class='sub-menu'> <a href='#'>Profile<i class='fa fa-angle-down'></i></a>
      <ul>
        <li><a href='updateinfo.php' target='frm1'>Update Profile</a></li>
        <li><a href='logout.php'>Logout</a></li>
      </ul>
    </li>
  </ul>
</div>
</nav> <br> <br> <br> ";
?><br><br>
</header>
<div id="profile">
<b style="float: right;"><b style="text-shadow: 0px 0px 3px red; font-size: 25; color: white;"><br><br>Welcome 
<?php
echo $login_session;
if(strcmp($user_check,'admin@panel.com')==0)
	echo " <font color=white style='font-size: 18'> [Admin]<br></font>";
    ?></b></b>
</div><br><br><br>
<img src="images/logo2.png" class="imgcnt">
<iframe name="frm1" width="99%" height="80%" style="border: none;">
</iframe>
<h4 align=center style="background:black;padding:5pt;opacity:0.5;border-radius:10pt;"><font color=pink>
Crime Analytics<!--<br>Developed By: Anindit, Ankita and Shreyasis.--></font>
</h4>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
<script>
$('nav li').hover(
  function() {
	  $('ul', this).stop().slideDown(200);
  },
	function() {
    $('ul', this).stop().slideUp(200);
  }
);
</script>
</body>
</html>