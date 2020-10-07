<?php
session_start();

if (isset($_POST['submit']) ) 
  
    if ($_POST['submit']) {
     $_SESSION['artist1'] = $_POST['input'];
     $_SESSION['artist2'] = $_POST['input2'];
     echo "<script>window.open('check.php','_self')</script>"; 
    }else 
        $msg = '<span style="color:red">YOU HAVE ENTERED THE WRONG CAPTCHA!!!</span>';   
?> 
<html>
<head>
<link rel="stylesheet" type="text/css" href="newform.css">
</head>   
   
<body> 
<h2>ENTER THE ID OF THE ARTIST1 AND ARTIST2</h2>
      <form action="" method="POST">
      <div class="container"> <pre>   
    ARTIST1 ID:    <input type="text" name="input" style="width:300px"  ><br><br>
    ARTIST2 ID:   <input type="text" name="input2" style="width:300px"><br><br>
    <input type="submit" value="Submit" name="submit"> </pre>
</div>
      </form> 
   
      
</body> 
</html>