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
          <form action="PageThree.php" method="post">
              <h3>Search Criteria</h3>
              <pre><input type="hidden" name="cid" value="<?php echo $_POST['cid']; ?>">Start Date <input style="width:80px;" type="text" name="SD" value="<?php echo $_POST['datepicker']; ?>" readonly> End Date <input style="width:80px;" type="text" name="ED" value="<?php echo $_POST['datepicker1']; ?>" readonly> SO Number <input style="width:30px;" type="text" name="SO" value="<?php echo $_POST['so']; ?>" readonly></pre>
<?php
$query="SELECT * FROM emplyee where ";


$date=explode("/",$_POST['datepicker']);
$newDate=$date[2]."-".$date[1]."-".$date[0];
$query=$query."(";
foreach ($_POST['Level'] as $selectedOption)
    $query=$query."Level=\"".$selectedOption."\" or ";
$query=chop($query,"or ");
$query=$query.") and (";
foreach ($_POST['PrimarySkill'] as $selectedOption)
    $query=$query."PrimarySkill=\"".$selectedOption."\" or ";
$query=chop($query,"or ");
$query=$query.") and (";
foreach ($_POST['Location'] as $selectedOption)
    $query=$query."Location=\"".$selectedOption."\" or ";
$query=chop($query,"or ");
$query=$query.") and SUBDATE(EndDate, INTERVAL 15 DAY)<'$newDate' order by Location;";
//echo $query;
	$result2 = mysql_query("drop view view_e;");
	$result1 = mysql_query("CREATE VIEW view_e AS ".$query);
	$result = mysql_query($query);

 if(mysql_num_rows($result)==0)
{echo "No records matching your query!<br><br><div class=\"form-group\"><div class=\"col-sm-10\"><a href=\"javascript:history.back()\" class=\"btn btn-primary\">Back</a>";}
else
{
?>


         <table class="table table-hover">
      <thead style="background-color: #2D6CA2; color:#fff; font-size:12px;">
<tr>
<th style="width: 10%;">Employee ID</th>
<th style="width: 20%;">Name</th>
<!--<th style="width: 10%;">Last Name</th>-->
<th style="width: 2%;">Level</th>
<th style="width: 9%;">Location</th>
<th style="width: 8%;">Skill</th>
<!--<th style="width: 10%;">Start Date</th>-->
<th style="width: 13%;">Current End Date</th>
<th style="width: 8%;">Soft Lock</th>
<th style="width: 9%;">Hard Lock</th>
        <th style="width: 8%;">SLockDate</th>
    <th>ReleaseDate</th>
</tr>
</thead>

      <tbody>
      <?php
while ($row = mysql_fetch_array($result)) {
?>
<tr
    <?php
                if($row['SoftLock']==1)
                    echo "class=\"danger\"";
                elseif($row['SoftLock']==2&&(strcasecmp($_POST['cid'],$row['SLBy'])==0))
                    echo "class=\"success\"";
    ?>
>
  <td style="font-size=10px;" ><?php echo $row['ID'];?></td>
  <td style="font-size=10px;" ><?php echo $row['FirstName']." ".$row['LastName'];?></td>
<!--  <td></td> -->
  <td style="font-size=10px;" ><?php echo $row['Level'];?></td>
  <td style="font-size=10px;" ><?php echo $row['Location'];?></td>
  <td style="font-size=10px;" ><?php echo $row['PrimarySkill'];?></td>
    <?php
 $dates=explode('-',$row['StartDate']);
 $datesp=$dates[2]."/".$dates[1]."/".$dates[0];
 $datee=explode('-',$row['EndDate']);
 $dateep=$datee[2]."/".$datee[1]."/".$datee[0];
    ?>

  <td><?php echo $dateep;?></td>
  <td><input type="checkbox" name="sl<?php echo $row['ID'];?>" <?php if(($row['SoftLock'])>0){if($_POST['cid']!=$row['SLBy']) echo"checked disabled"; else echo "checked";}?>> </td>
    <td>
        <input type="checkbox" name="hl<?php echo $row['ID'];?>" 
               <?php
                                           if(strcasecmp($_POST['cid'],$row['SLBy'])==0)
                                           {
                                               if($row['SoftLock']==2)
                                               {
                                               }
                                               else
                                               {
                                                   echo "disabled";
                                               }
                                           }
                                           else
                                               echo "disabled";
               ?>
               >
    </td>
      <td><?php
if($row['SLDate']!=null)
{
     $dated=explode('-',$row['SLDate']);
 $dateed=$dated[2]."/".$dated[1]."/".$dated[0];
echo $dateed;
}
          ?>
    </td>
<td>
<?php 
if($row['ReleaseDate'])
{
     $dated=explode('-',$row['ReleaseDate']);
 $dateed=$dated[2]."/".$dated[1]."/".$dated[0];
echo $dateed;

}
    ?></td>
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
      <input type="submit" name=button1 value="Soft Lock" class="btn btn-primary">
        <input type="submit" name=button2 value="Hard Lock" class="btn btn-primary">
        <input type="submit" name=button3 value="Release Soft Lock" class="btn btn-primary">
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