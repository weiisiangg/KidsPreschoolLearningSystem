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
    $course_name = $_POST['course_name'];
    $course_video = $_POST['course_video'];
    $course_description = $_POST['course_description'];
    $education_stage = $_POST['education_stage'];
    $admin_id = $_POST['admin_id'];

    $course_id = $_POST['course_id'];

    $update=false;

    $mysqli -> query( "UPDATE course SET course_name = '$course_name', course_video = '$course_video', course_description = '$course_description', education_stage = '$education_stage', admin_id = '$admin_id' WHERE course_id = '$course_id'") or die ($mysqli -> error);
  
  if (mysqli_query($con, $sql)) {
    echo "";
  
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }
    
  }?>
      
<!doctype html>

<html class="no-js" lang="">
<head>
   
    <title>View course</title>
   

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
                
                                    <li><a href="courseRecord.php">View Course</a></li>
                                    <li class="active">Course Record</li>
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
                            <strong class="card-title">View Course</strong>
                        </div>
                        <div class="card-body">
                        <form  action="" method="post" autocomplete="on"> 
              <?php 
                    $cid=$_GET['viewid'];
                    $ret=mysqli_query($con,"select * from course where course_id='$cid'");

                    while ($row=mysqli_fetch_array($ret)) {
                ?>  

                <table border="1" class="table table-bordered mg-b-0">
                    <tr>
                        <th>Course ID</th>
                        <td><input class="form-control"  type="text" name="course_id" required value="<?php  echo $row['course_id'];?>" disabled> <td>
                    </tr>                             
                    <tr>
                        <th>Course Name</th>
                        <td ><input class="form-control" type="text" name="course_name" required value="<?php  echo  $row['course_name']; ?>"></td>
                    </tr>
                    <tr>
                        <th>Course Description</th>
                        <td ><textarea class="form-control" rows="10" type="text" name="course_description" required><?php  echo  $row['course_description']; ?></textarea></td>
                    </tr>
                    <tr>
                        <th>Education Stage</th>
                        <td ><input class="form-control" type="text" name="education_stage" required value="<?php  echo  $row['education_stage']; ?>"></td>
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
