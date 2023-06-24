<?php
require "conn.php";

$mysqli = new mysqli('localhost','root','','preschool_system') or die(mysqli_error($mysqli));        
$update=false;

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

function pre_r($array){
    echo '<pre>';
    print_r($array);
     echo'</pre>';
}

function connect(){
    $con = mysqli_connect("localhost", "root", "", "preschool_system");
    if(mysqli_connect_errno()){
        echo "Connection Fail" . mysqli_connect_error();
    }
    return $con;
}

$link = connect();

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
    
  
    $_SESSION['message']="update Successful";
    $_SESSION['msg_type']="success"; 
    header("Location: courseRecord.php?insertSuccess");
}


// Edit
//DELETE
if(isset($_GET['delete']))
{
    $id2 =$_GET['delete'];
    $delete_Query = "DELETE FROM course WHERE course_id = $id2";
    try{
        $delete_Result = mysqli_query($con, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($con) > 0)
            {
       
                header("location:courseRecord.php");
                alert("");
                
            }else{
                echo 'Data Not Deleted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

?>

<!DOCTYPE Html>
<html>
    <head>
        <title>Course Record</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="form.css">
    </head>
    <body>
    <?php include_once('panel.php');?>
    <?php include_once('header.php');?>
    <?php require_once "conn.php";
        $mysqli = new mysqli('localhost','root','','preschool_system') or die(mysqli_error($mysqli));
    ?>
     
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
                                 
                                    <li><a href="courseRecord.php">View course</a></li>
                                    <li class="active">Course Record</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class= "container">
        <div class="justify-content-center">
            <h2> <strong>Course Record</strong> <h2><br>
        </div>

    <div class ="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Course Video</th>
                    <th>Course Description</th>
                    <th>Education Stage</th>
                    <th colspan="2">CreatedBy</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                 $i = 1;
                 $res=mysqli_query($link,"select * from course");
                 while($row=mysqli_fetch_array($res))
                 {
                      echo "<tr>";
                      echo "<td>"; echo $i; $i++; echo"</td>";
                      echo "<td>"; echo $row["course_id"]; echo"</td>";
                      echo "<td>"; echo $row["course_name"]; echo"</td>";
                      echo "<td>"; echo $row["course_video"]; echo"</td>";
                      echo "<td>"; echo $row["course_description"]; echo"</td>";
                      echo "<td>"; echo $row["education_stage"]; echo"</td>";
                      echo "<td>"; echo $row["teacher_id"]; echo"</td>";
                      echo "<td>"; echo $row["admin_id"]; echo"</td>";
                 ?>
                <td>
                    <a href="viewCourse.php?viewid=<?php echo $row["course_id"]?>"class="btn btn-info">View</a>
                    <a href="courseRecord.php?delete=<?php echo $row["course_id"]?>"class="btn btn-danger">delete</a>
                </td>
                <?php }?>
                </tr>
            </tbody>
        </table>

        <input type="button" class="button-active" style="width:250px; margin-left:5%; margin-bottom:3%; border-radius:5px; border: 1px solid transparent;
                    background: palevioletred; color: #ffffff; text-transform: capitalize; cursor: pointer; font-size: 20px;" onMouseOver="this.style.background='rgba(253,187,45,1)'" 
                    onMouseOut="this.style.background='palevioletred'" onclick="location.href='newCourse.php'" value="Create a new course">    
    </div>
</div>

</div>    
 <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="form.js"></script>
    </body>
</html>
