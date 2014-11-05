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
         <form action="index.php" method="post">

<?php
     $date=explode("/",$_POST['SD']);
     $SD=$date[2]."-".$date[1]."-".$date[0];
     $date=explode("/",$_POST['ED']);
     $ED=$date[2]."-".$date[1]."-".$date[0];
if(isset($_POST['button1']))
{?>
          <?php
$cbs=false;
    $result = mysql_query("SELECT * FROM view_e;");
while ($row = mysql_fetch_array($result)) {
    $cbname="sl".$row['ID'];
if (isset($_POST[$cbname])&&$row['SoftLock']==0) {
$cbs=true;
        $resultsl = mysql_query("UPDATE emplyee SET SoftLock=1, SLBy='{$_POST['cid']}', SLDate= NOW(), ReleaseDate=DATE_ADD(Now(), INTERVAL 7 DAY), SLockStartDate='{$SD}', SLockEndDate='{$ED}' WHERE ID='{$row['ID']}';");
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: ketaki.8493@gmail.com' . "\r\n";
   $to = "ketaki.8493@gmail.com";
   $subject = "Emp ID {$row['ID']} soft locked on SO {$_POST['SO']}";

   $message = "<html><body>Dear Sir/Madam,<br> The emp ID: {$row['ID']} has been soft locked for the SO: {$_POST['SO']}<br><br><form action=\"ketaki.tk/rmg/approveSL.php\" method=\"post\"><table style=\"border:none;\"><thead style=\"background-color: #2d6ca2;\"><th>Employee ID</th><th>Name</th><th>Locked By</th><th>Approve</th></thead><tbody><tr><td>".$row['ID']."</td><td>".$row['FirstName']." ".$row['LastName']."</td><td>".$_POST['cid']."</td><td><input type=\"checkbox\" name=\"sl".$row['ID']."\"></td></tr></tbody></table><br><br><input type=\"submit\" value=\"Approve Soft Lock\"></form></body></html>";
   $retval = mail ($to,$subject,$message,$headers);
   if( $retval == true )  
   {
       echo "Message for ".$row['FirstName']." ".$row['LastName']." sent successfully...<br><hr>";
   }
   else
   {
      echo "Message for ".$row['FirstName']." ".$row['LastName']." could not be sent...<br><hr>";
   }
}
}
if($cbs==false)
echo "No selection made!<br>";
}
else if(isset($_POST['button2']))
{
  $result = mysql_query("SELECT * FROM view_e;");
$cbs=false;
while ($row = mysql_fetch_array($result)) {
    $cbname="hl".$row['ID'];
if (isset($_POST[$cbname])) {
$cbs=true;
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: ketaki.8493@gmail.com' . "\r\n";
   $to = "ketaki.8493@gmail.com";
   $subject = "Emp ID {$row['ID']} hard locked on SO {$_POST['SO']}";

   $message = "<html><body>Dear Sir/Madam,<br> The emp ID: {$row['ID']} has been hard locked for the SO: {$_POST['SO']}<br><br><form action=\"ketaki.tk/rmg/confirmHL.php\" method=\"post\"><table style=\"border:none;\"><thead style=\"background-color: #2d6ca2;\"><th>Employee ID</th><th>Name</th><th>Locked By</th><th>Approve</th></thead><tbody><tr><td>".$row['ID']."</td><td>".$row['FirstName']." ".$row['LastName']."</td><td>".$_POST['cid']."</td><td><input type=\"checkbox\" name=\"hl".$row['ID']."\"></td></tr></tbody></table><br><br><input type=\"submit\" value=\"Approve Hard Lock\"></form></body></html>";

   $retval = mail ($to,$subject,$message,$headers);
   if( $retval == true )
   {
       echo "Message for ".$row['FirstName']." ".$row['LastName']." sent successfully...<br><hr>";
   }
   else
   {
      echo "Message for ".$row['FirstName']." ".$row['LastName']." could not be sent...<br><hr>";
   }
}}  
if($cbs==false)
echo "No selection made!<br>";
}


else if(isset($_POST['button3']))
{
  $result = mysql_query("SELECT * FROM view_e;");
$cbr=false;
while ($row = mysql_fetch_array($result)) {
    $cbname="sl".$row['ID'];
if (!isset($_POST[$cbname])&&$row['SoftLock']==1&&$row['SLBy']==$_POST['cid']) {
$cbr=true;
$resultrl=mysql_query("UPDATE emplyee SET SoftLock=0,SLBy=NULL, SLDate=null, ReleaseDate=null,SLockStartDate=null,SLockEndDate=null WHERE ID='{$row['ID']}';");
      echo $row['FirstName']." released...<br><hr>";

}}  
if($cbr==false)
echo "No de-selection made!<br>";
}

?>
             <br>
             <br>
 <div class="form-group">
    <div class="col-sm-10">
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
      <button type="submit" class="btn btn-primary">Search Again</button>
    </div>
     </div>
          </form>
          </div>
        </div>
      <div id="push">
             </div>
   <div id="footer">
      <div class="container">
       <p>Copyright &#169; <a href="#">Capgemini</a></p>
    </div>
             </div>
           </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  </body>
</html>