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
<title>PT Suke Tbk | Edit Employees</title>
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
                <h2>Edit Employees</h2>   
              </div>
            </div>              
            <!-- /. ROW  -->
            <hr />
            <form action="<?php echo $editFormAction; ?>" class="form-horizontal" method="post" name="form1" id="form1" enctype="multipart/form-data">
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label" ></label>
              <div class="col-sm-10">
                <label for="photo"><img src="../image/<?php echo htmlentities($row_pegawai['photo'], ENT_COMPAT, ''); ?>" style="width:150px; height:130px; " ></label>
              <input type="file" name="photo" id="photo" value="<?php echo htmlentities($row_pegawai['photo'], ENT_COMPAT, 'utf-8'); ?>"></div></div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label" >Id</label>
              <div class="col-sm-2">
              <input type="text" name="id" class="form-control" id="id" readonly="readonly" placeholder="id" value="<?php echo $row_pegawai['id']; ?>" required="required"></div></div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label" >Nama</label>
              <div class="col-sm-3">
              <input type="text" name="name" class="form-control" id="name" placeholder="name" value="<?php echo $row_pegawai['name']; ?>" required="required"></div></div>
            <div class="form-group form-group-sm">
              <label for="kode" class="col-sm-2 control-label">Tanggal Lahir</label>
              <div class="col-sm-2">
                <div class='input-group date' id='datepicker'>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                  <input name="dateofbirth" type="text" class="form-control" id="dateofbirth" placeholder="yyyy-mm-dd" value="<?php echo $row_pegawai['dateofbirth']; ?>">
                </div>
              </div></div>
            <div class="form-group form-group-sm">
              <label for="kode" class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-2">
                <select type="text" name="gender" class="form-control">
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              </div>
            <div class="form-group form-group-sm">
              <label for="kode" class="col-sm-2 control-label">Departemen</label>
              <div class="col-sm-3">
                <select type="text" name="departemen" class="form-control">
                  <?php
	// Query tampilkan data dari database
	@$sql 	= "SELECT * FROM departemen ORDER BY kode";
	@$query	= mysql_query($sql) or die ("Query salah : ".mysql_error());
	while($data = mysql_fetch_array(@$query)) {
		if($data['kode']==@$kategori) { @$cek=" selected"; } else { @$cek=""; }
	  	echo "<option value='$data[departemen]' $cek>$data[departemen]</option>";
	} ?>
                </select>
              </div>
              </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label" >Email</label>
              <div class="col-sm-3">
               <input type="text" name="email" class="form-control" id="email" placeholder="email" value="<?php echo $row_pegawai['email']; ?>" required="required"></div></div>
            <div class="form-group form-group-sm">
              <label for="addres" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-4">
                <td><label for="textarea"></label>
                  <textarea name="addres" id="addres" cols="45" rows="5"><?php echo $row_pegawai['addres']; ?></textarea></td>
              </div>
              </div>
            <div class="form-group form-group-sm">
            <div class="form-group form-group-sm">
            <label class="col-sm-2 control-label" ></label>
            <div class="col-sm-10">
            <td><input onclick="return confirm('Are you sure of the data entered?')" name="submit" type="submit" class="btn btn-primary" value="Save" /></td>
            </tr>
            </table>
            <input type="hidden" name="MM_update" value="form1" />
            <input type="hidden" name="id" value="<?php echo $row_pegawai['id']; ?>" />
            
            
            
            
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
