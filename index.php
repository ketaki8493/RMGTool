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
   <script type="text/javascript" src="bootstrap-select.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap-select.css">
      <link rel="stylesheet" type="text/css" href="datepicker.css">
   <script type="text/javascript" src="bootstrap-datepicker.js"></script>
			 <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
              $(document).ready(function () {
                
                $('#example2').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
        </script>
      
      <script type="text/javascript">
        $(window).on('load', function () {

            $('.selectpicker').selectpicker({
                //'selectedText': 'cat'
            });

            // $('.selectpicker').selectpicker('hide');
        });
    </script>
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
          <form class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="ID" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
          <form action="PageTwo.php" method="post" class="form-horizontal" role="form">
         <div class="form-group">
    <label class="col-sm-2 control-label">Corp ID</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name="cid" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">SO Number</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name="so">
    </div>
      <div class="col-sm-2">
          </div>
      <div class="col-sm-2">
          <input type="radio">Soft Locks
      <a href="sl.php" class="btn btn-primary">Reporting</a>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Skill</label>
    <div class="col-sm-2">
      <select class="selectpicker show-tick form-control" data-selected-text-format="count" multiple data-size="5" name="PrimarySkill[]" required>
                        <?php
                    $result = mysql_query("SELECT DISTINCT PrimarySkill FROM emplyee ORDER BY PrimarySkill");
			while ($row = mysql_fetch_array($result)) {?>
			   <option><?php echo $row['PrimarySkill']; ?> </option>
<?php
			}
?>
                    </select>
    </div>
  </div>
 <div class="form-group">
    <label class="col-sm-2 control-label">Location</label>
    <div class="col-sm-2">
<select class="selectpicker show-tick form-control" data-selected-text-format="count" multiple data-size="5" name="Location[]" required>
                       <?php
                    $result = mysql_query("SELECT DISTINCT Location FROM emplyee ORDER BY Location");
			while ($row = mysql_fetch_array($result)) {?>
			   <option><?php echo $row['Location']; ?> </option>
<?php
			}
?>
                    </select>
    </div>
  </div>
<div class="form-group">
    <label class="col-sm-2 control-label">Level</label>
    <div class="col-sm-2">
      <select name="Level[]" class="selectpicker show-tick form-control" data-selected-text-format="count" multiple data-size="5" required>
<?php
                    $result = mysql_query("SELECT DISTINCT Level FROM emplyee ORDER BY Level");
			while ($row = mysql_fetch_array($result)) {?>
			   <option><?php echo $row['Level']; ?> </option>
<?php
			}
?>
                    </select>
    </div>
  </div>
 <div class="form-group">
    <label class="col-sm-2 control-label">Start Date</label>
    <div class="col-sm-2">
<input  type="text" class="form-control"  id="example1" name="datepicker" required>
     </div>
  </div>
    <div class="form-group">
    <label class="col-sm-2 control-label">End Date</label>
    <div class="col-sm-2">
      <input  type="text" class="form-control"  id="example2" name="datepicker1">
    </div>
  </div>
          
  <div class="form-group">
    <div class="col-sm-offset-2">
      <button type="submit" class="btn btn-primary">Search</button>
        <a href="index.php" class="btn btn-primary">Reset</a>
    </div>
  </div>
</form>
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