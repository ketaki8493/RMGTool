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
  <body style="background-color: #eee;">
      <?php
$hostname = "mysql7.000webhost.com";
$mysql_database = "a4748775_employ";
$username = "a4748775_root";
$password = "kitkat93";
//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password);
$selected = mysql_select_db($mysql_database,$dbhandle);
?>

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
$query="SELECT * FROM emplyee where SoftLock=1";
	$result = mysql_query($query);
 if(mysql_num_rows($result)==0)
{echo "No Soft Locks!<br><br><div class=\"form-group\"><div class=\"col-sm-10\"><a href=\"javascript:history.back()\" class=\"btn btn-primary\">Back</a>";
}
else
{
?>
<form action="sendConsolidatedEmail.php" method="post">

         <table class="table table-hover">
      <thead style="background-color: #2D6CA2; color:#fff; font-size:12px;">
<tr>
<th style="width: 10%;">Employee ID</th>
<th style="width: 25%;">Name</th>
<!--<th style="width: 10%;">Last Name</th>-->
<th style="width: 4%;">Level</th>
<th style="width: 9%;">Location</th>
<th style="width: 14%;">Skill</th>
<!--<th style="width: 10%;">Start Date</th>-->
<th style="width: 18%;">End Date(Current Project)</th>
    <th style="10%">Locked By</th>
        <th >SLockDate</th>
</tr>
</thead>

      <tbody>
      <?php
while ($row = mysql_fetch_array($result)) {
?>
<tr>
  <td><?php echo $row['ID'];?></td>
  <td><?php echo $row['FirstName']." ".$row['LastName'];?></td>
<!--  <td></td> -->
  <td><?php echo $row['Level'];?></td>
  <td><?php echo $row['Location'];?></td>
  <td><?php echo $row['PrimarySkill'];?></td>
    <?php
 $dates=explode('-',$row['StartDate']);
 $datesp=$dates[2]."/".$dates[1]."/".$dates[0];
 $datee=explode('-',$row['EndDate']);
 $dateep=$datee[2]."/".$datee[1]."/".$datee[0];
 $dated=explode('-',$row['SLDate']);
 $dateed=$dated[2]."/".$dated[1]."/".$dated[0];
    ?>

  <td><?php echo $dateep;?></td>
    <td><?php echo $row['SLBy']; ?></td>
 <td><?php echo $dateed;?></td>
</tr>
<?php
}
?>

      </tbody>
    </table>
          <br>
            <div class="form-group">
    <div class="col-sm-10">
        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
        <button type="submit" class="btn btn-primary">Send Email</button>
          </div>
  </div>     
          </form>
          <?php
}
?>
      </div>
    </div>
 
      <div id="push"></div>
          <div id="footer">
      <div class="container">
       <p>Copyright &#169; <a href="#">Capgemini</a></p>
    </div>
              </div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  </body>
</html>