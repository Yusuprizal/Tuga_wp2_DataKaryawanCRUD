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

mysql_select_db($database_koneksi, $koneksi);
$query_pegawai = "SELECT * FROM pegawai";
$pegawai = mysql_query($query_pegawai, $koneksi) or die(mysql_error());
$row_pegawai = mysql_fetch_assoc($pegawai);
$totalRows_pegawai = mysql_num_rows($pegawai);

$colname_pegawai = "-1";
if (isset($_GET['departemen'])) {
  $colname_pegawai = $_GET['departemen'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_pegawai = sprintf("SELECT * FROM pegawai WHERE departemen = %s", GetSQLValueString($colname_pegawai, "text"));
$pegawai = mysql_query($query_pegawai, $koneksi) or die(mysql_error());
$row_pegawai = mysql_fetch_assoc($pegawai);
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
<title>PT Suke Tbk | <?php echo $row_pegawai['departemen']; ?> </title></head>
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
                <h2>Departemen <?php echo $row_pegawai['departemen']; ?></h2>   
              </div>
            </div>  
                             
                 <!-- /. ROW  -->
                    <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                    </div>
                    <!--End -->
                    <div class="row">
                <div class="col-md-12">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Pegawai
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" class="table-responsive">
             <thead>
  <tr>
                 <td class="info" width="5%"><div align="center"><strong>Id</strong></div></td>
                 <td class="info" width="25%"><div align="center"><strong>Nama</strong></div></td>
                 <td class="info" width="5%"><div align="center"><strong>Tanggal Lahir</strong></div></td>
                 <td class="info" width="5%"><div align="center"><strong>Jenis Kelamin</strong></div></td>
                 <td class="info" width="10%"><div align="center"><strong>Departemen</strong></div></td>
                 <td class="info" width="15%"><div align="center"><strong>Email</strong></div></td>
                 <td colspan="2" class="info" width="10%"><div align="center"><strong>Action</strong></div></td>
               </tr>
               
               </thead>
               <?php do { ?>
                 <tr>
                <td width="5%"><div align="center"><?php echo $row_pegawai['id']; ?></div></td>
                 <td width="15%"><div><a href="employee_detail.php?id=<?php echo $row_pegawai['id']; ?>"><?php echo $row_pegawai['name']; ?></div></td>
                 <td width="15%"><div><?php echo $row_pegawai['dateofbirth']; ?></div></td>
                 <td width="10%"><div><?php echo $row_pegawai['gender']; ?></div></td>
                 <td width="15%"><div><?php echo $row_pegawai['departemen']; ?></div></td>
                 <td width="15%"><div><?php echo $row_pegawai['email']; ?></div></td>
                 <td><center><a href="employee_edit.php?id=<?php echo $row_pegawai['id']; ?>" type="button" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> Edit</a></center></td>
                 <td><center><a href="delete_employee.php?id=<?php echo $row_pegawai['id']; ?>" onclick="return confirm('Are you sure to delete?')" type="button" class="btn btn-primary"><i class="fa fa-fw fa-trash"></i> Delete</a></center></td>
               </tr>
               <?php } while ($row_pegawai = mysql_fetch_assoc($pegawai)); ?>
             </table>
                            </div>
                        </div>
                </div>
            </div>
                <!-- /. ROW  -->
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
