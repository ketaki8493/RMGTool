<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resource Management Tool</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/jumbotron.css" rel="stylesheet">
      <link href="css/footer.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
    <?php

$hostname = "mysql7.000webhost.com";
$mysql_database = "a4748775_employ";
$username = "a4748775_root";
$password = "kitkat93";
//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password);
$selected = mysql_select_db($mysql_database,$dbhandle);
    ?>
  <body style="background-color: #eee;">
       <div id="wrapper">
          <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Resource Management Tool</a>
        </div>
        <div class="navbar-collapse collapse">
         
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
<?php
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: ketaki.8493@gmail.com' . "\r\n";
   $to = "ketaki.8493@gmail.com";
   $subject = "Soft Lock Apprval";
   $message = "<html><body>Dear Sir/Madam,<br>      Please Approve the following Soft Locks<br><form action=\"ketaki.tk/rmg/approveSL.php\" method=\"post\"><table><thead style=\"background-color: #2d6ca2;\"><th>Employee ID</th><th>Name</th><th>Locked By</th><th>Approve</th></thead><tbody>";
    $result = mysql_query("SELECT ID, SLBy, FirstName, LastName from emplyee where SoftLock=1;");
while ($row = mysql_fetch_array($result))
{$message.="<tr><td>".$row['ID']."</td><td>".$row['FirstName']." ".$row['LastName']."</td><td>".$row['SLBy']."</td><td><input type=\"checkbox\" name=\"sl".$row['ID']."\"></td></tr>";
}
$message.="</tbody></table><br><input type=\"submit\" value=\"Approve Soft Locks\"></form></body></html>";
    // Always set content-type when sending HTML email
$retval = mail ($to,$subject,$message,$headers);
   if( $retval == true )  
   {
       echo "Message sent successfully...<br><hr>";
   }
   else
   {
      echo "Message could not be sent...<br><hr>";
   }

?>
          <br>
             <br>
 <div class="form-group">
    <div class="col-sm-10">
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
  </div>
      </div>
     </div>
        </div>
      <div id="push"></div>
          <div id="footer">
      <div class="container">
       <p>Copyright &#169; <a href="#">Capgemini</a></p>
    </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  </body>
</html>