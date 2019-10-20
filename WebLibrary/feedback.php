<html>
<head>
<title>Feedback</title>
<link href="MyStyle.css" rel="stylesheet" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body id="body_book">
<center> <font face="ar christy" color=red style="font-size: 80px; text-shadow: 0px 0px 3px black">Feedback</font></center>
<br>
<div class="book" style="height: 94%;">
    <form action="feedback.php" method="post">
    <div>
    <pre><input type="text" placeholder="Name" autofocus required name="t1">
    <br><input type="text" placeholder="Email id" autofocus required name="t2">
	<br><select name="t3" required autofocus>		
    <option value="">-- Select Category--</option>
    <option value="General Message">General</option>
    <option value="Want to know about something?">Query</option>
    <option value="Suggestions">Suggestion</option>
    <option value="Request a particular book">Request</option>
    <option value="Other (Please specify in message)">Other</option>
    </select>
    <br><input type="text" placeholder="What is 10+5=? (Antispam to check you are hooman :3)" autofocus required name="t4">    
    <br><textarea rows=5 cols=81 placeholder="Your message" autofocus required name="t5" style="border-radius: 3px; height: 40%;"></textarea>
	<br><br><input type="submit" value="Send" name="submit"> <input type="Reset" value="Clear" name="reset"></pre></div>        
    </form>
    <?php
    if(isset($_POST['t1']) && isset($_POST['t2']) && isset($_POST['t4']) && isset($_POST['t5'])){
        if($_POST['t4']=="15"){
            echo "
                <script>
                window.alert('Your feedback was succesfully submitted!');
                </script>
                ";
        }
        else{
            echo "
                <script>
                window.alert('Your antispam answer is not correct! You are not human confirmed!');
                </script>
                ";
        }
    }
    ?>
</div>
</body>
</html>
