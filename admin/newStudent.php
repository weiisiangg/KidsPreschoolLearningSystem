<?php
session_start();
error_reporting(0);
include('conn.php');

if(isset($_POST['login']))
  {
    $adminuser=$_POST['username'];
    $password=($_POST['password']);
    $query=mysqli_query($con,"select admin_id from admin where username='$adminuser' && password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
        $_SESSION['vpmsaid']=$ret['admin_id'];
        $_SESSION['username']= $adminuser;
     header('location:CRUD.php');
    }
    else{
    $msg="Invalid Details.";
    }
  }

function connect()
{
    $con=mysqli_connect("localhost", "root", "", "preschool_system");
    if(mysqli_connect_errno()){
    echo "Connection Fail".mysqli_connect_error();
    }
    return $con;
}
  if(isset($_POST["insert"]))
  {
    $loginid = $_POST['loginID'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $education_stage = $_POST['education_stage'];
    $parentName = $_POST['parentName'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $sdate = $_POST['startDate'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $createdBy =  $_SESSION['vpmsaid'];

    $sql = "INSERT INTO user (loginID, password, name, dob, education_stage, parentName, email, contact, address, startDate, role, status, createdBy) VALUES ('$loginid', '$password', '$name', '$dob', '$education_stage', '$parentName', '$email', '$contact', '$address', '$sdate', '$role', '$status', '$createdBy')";
  
  if (mysqli_query($con, $sql)) {
    echo "<script>alert('Record insert successfully')</script>";
  
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }
    
  }?>
      
<!doctype html>

<html class="no-js" lang="">
<head>
   
    <title>Add Student</title>
   

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
                                <h1>Add Student</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                
                                    <li><a href="studentRecord.php">Student Record</a></li>
                                    <li class="active">Add Student</li>
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
                    <strong class="card-title">Add Student</strong>
                </div>
                <div class="card-body">
                <form action="newStudent.php" method="post" autocomplete="on"> 

                    <table border="1" class="table table-bordered mg-b-0">
                            
                    <tr>
                        <th>Login ID</th>
                        <td ><input class="form-control" type="text" name="loginID" required ></td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td ><input class="form-control" type="password" name="password" required ></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td ><input class="form-control" type="text" name="name" required ></td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td ><input class="form-control" type="date" name="dob" required ></td>
                    </tr>
                    <tr>
                        <th>Education Stage</th>
                        <td ><input class="form-control" type="text" name="education_stage" required ></td>
                    </tr>
                    <tr>
                        <th>Parent Name</th>
                        <td ><input class="form-control" type="text" name="parentName" required ></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td ><input class="form-control" type="text" name="email" required ></td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td ><input class="form-control" type="text" name="contact" required ></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td ><input class="form-control" type="text" name="address" required ></td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td ><input class="form-control" type="date" name="startDate" required > </td>
                    </tr>

                    <tr hidden>
                        <th>Role:</th>
                        <td><input type="text" class="form-control" id="role" name="role" value="1" readonly hidden></td>
                    </tr>

                    <tr hidden>
                        <th>Status</th>
                        <td><input type="text" class="form-control" id="status" name="status" value="1" readonly hidden></td> 
                    </tr>

                    </table>
                    <button type="submit" class="btn btn-primary" name="insert" style="width:250px;margin-left:35%;margin-bottom:3%;background: palevioletred;border: 1px solid transparent;cursor: pointer;font-size: 20px;" onMouseOver="this.style.background='rgba(253,187,45,1)'" 
                              onMouseOut="this.style.background='palevioletred'">Add Student</button>
                    </div>
                </div> 
</form>

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
