<?php require_once('../Connections/koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	if(empty($_FILES['photo']['name'])){
  $updateSQL = sprintf("UPDATE pegawai SET name=%s, dateofbirth=%s, gender=%s, departemen=%s, email=%s, addres=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['dateofbirth'], "date"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['departemen'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['addres'], "text"),
                       //GetSQLValueString($_FILES['photo']['name'], "text"),
					   GetSQLValueString($_POST['id'], "int"));
                       
  //move_uploaded_file($_FILES['photo']['tmp_name'],"../image/".$_FILES['photo']['name']);
}else{
	$updateSQL = sprintf("UPDATE pegawai SET name=%s, dateofbirth=%s, gender=%s, departemen=%s, email=%s, addres=%s, photo=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['dateofbirth'], "date"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['departemen'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['addres'], "text"),
                       GetSQLValueString($_FILES['photo']['name'], "text"),
					   GetSQLValueString($_POST['id'], "int"));
                       
  move_uploaded_file($_FILES['photo']['tmp_name'],"../image/".$_FILES['photo']['name']);}
  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  $updateGoTo = "employee_edit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_pegawai = "-1";
if (isset($_GET['id'])) {
  $colname_pegawai = $_GET['id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_pegawai = sprintf("SELECT * FROM pegawai WHERE id = %s", GetSQLValueString($colname_pegawai, "int"));
$pegawai = mysql_query($query_pegawai, $koneksi) or die(mysql_error());
$row_pegawai = mysql_fetch_assoc($pegawai);
$totalRows_pegawai = mysql_num_rows($pegawai);
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
<title>PT Suke Tbk | <?php echo $row_pegawai['name']; ?> </title>
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
                <h2>Profile Pegawai</h2>   
              </div>
            </div>              
            <!-- /. ROW  -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                    </div>
                    <!--End -->
  <div class="row">
  <div class="col-md-4"><img src="../image/<?php echo $row_pegawai['photo']; ?>" width="295" height="241" class="img-responsive" /></div>
  <div class="col-md-7">
  <table>
  <tr>
    <td><h4><strong><?php echo $row_pegawai['name']; ?></strong></h4></td>
  </tr>
  <tr>
    <td><h5><strong><?php echo $row_pegawai['departemen']; ?></strong></h5></td>
  </tr>
  </table>
  <table class="table table-hover">
  <tr>
    <td width="20%"><strong>Id</strong></td>
    <td width="3%">:</td>
    <td width="77%"><?php echo $row_pegawai['id']; ?></td>
  </tr>
  <tr>
    <td><strong>Tanggal Lahir</strong></td>
    <td>:</td>
    <td><?php echo $row_pegawai['dateofbirth']; ?></td>
  </tr>
  <tr>
  <tr>
    <td><strong>Jenis Kelamin</strong></td>
    <td>:</td>
    <td><?php echo $row_pegawai['gender']; ?></td>
  </tr>
  <tr>
    <td><strong>Email</strong></td>
    <td>:</td>
    <td><?php echo $row_pegawai['email']; ?></td>
  </tr>
  <tr>
    <td><strong>Alamat</strong></td>
    <td>:</td>
    <td><?php echo $row_pegawai['addres']; ?></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>

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
<?php
mysql_free_result($pegawai);
?>
