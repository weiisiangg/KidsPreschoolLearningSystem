<?php
require "conn.php";

$mysqli = new mysqli('localhost','root','','preschool_system') or die(mysqli_error($mysqli));        
$update=false;

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
    
    $loginid = $_POST['loginID'];
    $pwd = $_POST['pwd'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $edustage = $_POST['edustage'];
    $pname = $_POST['pname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $sdate = $_POST['sdate'];
    $role = $_POST['role'];
    $status = isset($_GET['status']) ? '2' : '1';
    $createdBy = $_POST['createdBy'];
 
    $user_id = $_POST['user_id'];

    $update=false;

    $mysqli -> query( "UPDATE user SET loginid = '$loginID', password = '$pwd', name = '$name', dob = '$date', education_stage = '$edustage', parentName = '$pname', email = '$email', contact = '$contact', address = '$address', startDate = '$sdate', role = '$role', status = '$status', createdBy = '$createdBy'  WHERE user_id = '$user_id'") or die ($mysqli -> error);
    
  
    $_SESSION['message']="update Successful";
    $_SESSION['msg_type']="success"; 
    header("Location: CRUD.php?insertSuccess");
}


// Edit
//DELETE
if(isset($_GET['delete']))
{
    $id2 =$_GET['delete'];
    $delete_Query = "UPDATE user SET status = '2' WHERE User_ID = $id2";
    try{
        $delete_Result = mysqli_query($con, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($con) > 0)
            {
       
                header("location:CRUD.php");
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
        <title>User Record</title>
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
                                 
                                    <li><a href="CRUD.php">View User</a></li>
                                    <li class="active">Record</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class= "container">
        <div class="justify-content-center">
            <h2> <strong>User Record </strong> <h2><br>
        </div>

    <div class ="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>User ID</th>
                    <th>Login ID</th>
                    <th>Password</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>CreatedBy</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                 $i = 1;
                 $res=mysqli_query($link,"select * from user");
                 while($row=mysqli_fetch_array($res))
                 {
                    if($row["role"] == 1){
                        $role = "Student";
                    }
                    else{
                        $role = "Teacher";
                    }

                    if($row["status"] == 1){
                        $status = "Active";
                    }
                    else{
                        $status = "Inactive";
                    }


                      echo "<tr>";
                      echo "<td>"; echo $i; $i++; echo"</td>";
                      echo "<td>"; echo $row["user_id"]; echo"</td>";
                      echo "<td>"; echo $row["loginID"]; echo"</td>";
                      echo "<td>"; echo $row["password"]; echo"</td>";
                      echo "<td>"; echo $row["name"]; echo"</td>";
                      echo "<td>"; echo $role; echo"</td>";
                      echo "<td>"; echo $status; echo"</td>";
                      echo "<td>"; echo $row["createdBy"]; echo"</td>";
                 ?>
                <td>
                    <a href="viewuser.php?viewid=<?php echo $row["user_id"]?>"class="btn btn-info">View</a>
                    <a href="CRUD.php?delete=<?php echo $row["user_id"]?>"class="btn btn-danger">delete</a>
                </td>
                <?php }?>
            </tr>
                 </tbody>
        </table>
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
