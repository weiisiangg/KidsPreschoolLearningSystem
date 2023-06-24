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
    $course_name = $_POST['course_name'];
    $course_video = $_POST['course_video'];
    $course_description = $_POST['course_description'];
    $education_stage = $_POST['education_stage'];
    $admin_id = $_SESSION['vpmsaid'];

     $sql = "INSERT INTO course (course_name, course_video, course_description, education_stage, admin_id) VALUES ('$course_name', '$course_video', '$course_description', '$education_stage', '$admin_id')";
  
  if (mysqli_query($con, $sql)) {
    echo "<script>alert('Record insert successfully')</script>";
  
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }
    
  }?>
      
<!doctype html>

<html class="no-js" lang="">
<head>
   
    <title>Add Teacher</title>
   

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
                                <h1>Add Course</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                
                                    <li><a href="courseRecord.php">Course Record</a></li>
                                    <li class="active">Add Course</li>
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
                    <strong class="card-title">Add Course</strong>
                </div>
                <div class="card-body">
                <form action="newCourse.php" method="post" autocomplete="on"> 

                    <table border="1" class="table table-bordered mg-b-0">
                            
                    <tr>
                        <th>Course Name</th>
                        <td ><input class="form-control" type="text" name="course_name" required ></td>
                    </tr>
                    <tr>
                        <th>Course Video</th>
                        <td ><input class="form-control" type="text" name="course_video" required ></td>
                    </tr>
                    <tr>
                        <th>Course Description</th>
                        <td ><textarea class="form-control" rows="10" type="text" name="course_description" required></textarea></td>
                    </tr>
                    <tr>
                        <th>Education Stage</th>
                        <td ><select class="form-control" id="education_stage" name="education_stage">
                                <option value="Pre-K">Pre-K</option>
                                <option value="Kindergarten">Kindergarten</option>
                            </select></td>
                    </tr>

                    </table>
                    <button type="submit" class="btn btn-primary" name="insert" style="width:250px;margin-left:35%;margin-bottom:3%;background: palevioletred;border: 1px solid transparent;cursor: pointer;font-size: 20px;" onMouseOver="this.style.background='rgba(253,187,45,1)'" 
                              onMouseOut="this.style.background='palevioletred'">Add Course</button>
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
