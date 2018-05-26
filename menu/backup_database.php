<?php require_once('../Connections/koneksi.php'); ?>

<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Bootstrap/jQuery Datetimepicker/css/bootstrap-datetimepicker.min.css" >
	<!-- BOOTSTRAP STYLES-->
    <link href="../Bootstrap/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../Bootstrap/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="../Bootstrap/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../Bootstrap/css/custom.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PT Suke Tbk | Backup Database</title>
</head>

<body>
<div id="wrapper">
<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Admin</a> 
            </div>
            <div style="color: white;
            padding: 15px 50px 5px 50px;
float: left;
font-size: 16px;">Aplikasi Data Pegawai PT Suke TBK&nbsp;
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="../index.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
</nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                  <img src="../Bootstrap/img/find_user.png" class="user-image img-responsive"/>
</li>
				
					
                    <li>
                        <a class="active-menu"  href="../dashboard.php"><i class="fa fa-dashboard fa-3x"></i> Data Pegawai</a>
                    </li>
                     <li>
                        <a  href="department.php"><i class="fa fa-desktop fa-3x"></i> Departemen</a>
                    </li>
                    <li>
                      <a  href="add_employee.php"><i class="fa fa-laptop fa-3x"></i>Input Pegawai</a>
                    </li>
						   <li  >
                        <a><i class="fa fa-database fa-3x"></i> Database</a>
               	</li>
                    <ul class="nav nav-second-level">
                      <li>
                                <a href="backup_database.php">Backup Database</a>
                      </li>
                      <li>
                                <a href="restore_database.php">Restore Database</a>
                      </li>
</ul>
                      <li  >
                        <a  href="change_password.php"><i class="fa fa-edit fa-3x"></i> Change Password</a>
                    </li>
                    
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
          <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Backup Database</h2>   
                    </div>  
                </div> 
                             
                 <!-- /. ROW  -->
                    <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                    </div>
                    <!--End -->
                    
                <!-- /. ROW  -->
                <hr>
<p>Database : <?php echo $database_koneksi?></p>
<p>List Of Tables</p>
<form method="post" action="proses.php">
  <?php $query = "SHOW TABLES";
$hasil = mysql_query($query);
?>
<?php while ($data = mysql_fetch_row($hasil))
{
   echo " - $data[0]<br>";
}?>
<input type="submit" name="submit" class="btn btn-default" value="Backup Data" >
</form>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
                        </div>
                  </div>
                  
<!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
<script src="../Bootstrap/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
<script src="../Bootstrap/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
<script src="../Bootstrap/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
<script src="../Bootstrap/js/morris/raphael-2.1.0.min.js"></script>
<script src="../Bootstrap/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
<script src="../Bootstrap/js/custom.js"></script>

<script src="../Bootstrap/jQuery Datetimepicker/js/jQuery.js"></script>
<script src="../Bootstrap/jQuery Datetimepicker/js/bootstrap.min.js"></script>
<script src="../Bootstrap/jQuery Datetimepicker/js/moment.js"></script>
<script src="../Bootstrap/jQuery Datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
			$(function () {
				$('#datetimepicker').datetimepicker({
					format: 'DD MMMM YYYY HH:mm',
                });
				
				$('#datepicker').datetimepicker({
					format: 'YYYY-MM-DD',
				});
				$('#datepicker1').datetimepicker({
					format: 'YYYY-MM-DD',
				});
				$('#timepicker').datetimepicker({
					format: 'HH:mm'
				});
			});
		</script>
</body>
</html>