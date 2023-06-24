<?php
session_start();
error_reporting(0);
include('conn.php');

function connect()
{
    $con=mysqli_connect("localhost", "root", "", "preschool_system");
    if(mysqli_connect_errno()){
    echo "Connection Fail".mysqli_connect_error();
    }
    return $con;
}

  ?><?
  if(isset($_POST['update']))
  {
    $loginid = $_POST['loginID'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $edustage = $_POST['edustage'];
    $pname = $_POST['pname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $sdate = $_POST['sdate'];
    $role = $_POST['role'];
    $status = isset($_GET['status']) ? '2' : '1';

     $id = $_POST['user_id'];
     $sql = "UPDATE user SET loginid ='$loginid', password = '$password', name = '$name', dob = '$dob', edustage = '$edustage', pname = '$pname', email = '$email', contact = '$contact', address = '$address', sdate = '$sdate', role = '$role', status = '$status' WHERE user_id ='$id'";
  
  if (mysqli_query($con, $sql)) {
    echo "<script>alert('Record updated successfully')</script>";
  
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }
    
  }?>
      
<!doctype html>

<html class="no-js" lang="">
<head>
   
    <title>View user</title>
   

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="form.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
    <!-- Left Panel -->
    <?php include_once('panel.php');?>
<?php include_once('header.php');?>

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                
                                    <li><a href="CRUD.php">View User</a></li>
                                    <li class="active">User Record</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                   
         

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">View User</strong>
                        </div>
                        <div class="card-body">
                        <form  action="" method="post" autocomplete="on"> 
              <?php 
                    $cid=$_GET['viewid'];
                    $ret=mysqli_query($con,"select * from user where user_id='$cid'");

                    while ($row=mysqli_fetch_array($ret)) {
                ?>  

                <table border="1" class="table table-bordered mg-b-0">
                    <tr>
                        <th>User ID</th>
                        <td><input class="form-control"  type="text" name="userid" required value="<?php  echo $row['user_id'];?>" disabled> <td>
                    </tr>                             
                    <tr>
                        <th>Login ID</th>
                        <td ><input class="form-control" type="text" name="loginID" required value="<?php  echo  $row['loginID']; ?>"></td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td ><input class="form-control" type="text" name="password" required value="<?php  echo  $row['password']; ?>"></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td ><input class="form-control" type="text" name="name" required value="<?php  echo  $row['name']; ?>"></td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td ><input class="form-control" type="date" name="dob" required value="<?php  echo  $row['dob']; ?>"></td>
                    </tr>

                    <?php if ($row["role"] == 1) : ?>
                    <tr>
                        <th>Education Stage</th>
                        <td><input class="form-control" type="text" name="education_stage" required value="<?php echo $row['education_stage']; ?>"></td>
                    </tr>
                    <tr>
                        <th>Parent Name</th>
                        <td ><input class="form-control" type="text" name="parentName" required value="<?php echo  $row['parentName']; ?>"></td>
                    </tr>
                    <?php else : ?>
                    <tr hidden>
                        <th>Education Stage</th>
                        <td><input class="form-control" type="text" name="education_stage" required value="<?php echo $row['education_stage']; ?>"></td>
                    </tr>
                    <tr hidden>
                        <th>Parent Name</th>
                        <td ><input class="form-control" type="text" name="parentName" required value="<?php echo  $row['parentName']; ?>"></td>
                    </tr>
                    <?php endif  ?>
                    <tr>
                        <th>Email</th>
                        <td ><input class="form-control" type="text" name="email" required value="<?php  echo  $row['email']; ?>"></td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td ><input class="form-control" type="text" name="contact" required value="<?php  echo  $row['contact']; ?>"></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td ><input class="form-control" type="text" name="address" required value="<?php  echo  $row['address']; ?>"></td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td ><input class="form-control" type="date" name="startDate" required value="<?php  echo  $row['startDate']; ?>"> </td>
                    </tr>

                                  

</table>
  
                    </div>
                </div>

  
</form>
<?php } ?>        </div>



        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>

<?php include_once('includes/footer.php');?>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
