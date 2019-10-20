<?php
echo "
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
    <center> <font face='ar christy' color=red style='font-size: 50px; text-shadow: 0px 0px 3px black'>Feedback Update:</font></center>
    <center>
    <div id=main>
    <div class=main_color>
    ";
if($_POST['t4']=="15")
{
	echo "Feedback succesfully submitted! Thank you for your valuable feedback!";
}
echo "
    </div>
    </div>
    </center>
    ";
?>