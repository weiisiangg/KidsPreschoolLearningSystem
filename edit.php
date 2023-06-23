<?php

include ('conn.php');
session_start();
// LOGIN USER

$errors = array();
if(!isset($_SESSION['loginID'])){
  header("Location: login.php");
}

// session_start();

$user_id='';
$loginID = '';

if(isset($_SESSION['loginID'])){
  $login_id = $_SESSION['loginID'] ;
  $user_id = $_SESSION['user_id'] ;
  $name = $_SESSION['name'];
  $role = $_SESSION['role'];
  echo $_SESSION['user_id'];
}else{
  echo "Session not set"; 
}

function connect()
{
    $con = mysqli_connect("localhost", "root", "", "preschool_system");
    if (mysqli_connect_errno()) {
        echo "Connection Fail" . mysqli_connect_error();
    }
    return $con;
}

$link = connect();

$id = $_GET["id"]; // Retrieve the "id" parameter from the URL

if (isset($_POST["update"])) {
  $loginid = isset($_POST['loginID']) ? $_POST['loginID'] : '';
  $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $date = isset($_POST['date']) ? $_POST['date'] : '';
  $edustage = isset($_POST['edustage']) ? $_POST['edustage'] : '';
  $pname = isset($_POST['pname']) ? $_POST['pname'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
  $address = isset($_POST['address']) ? $_POST['address'] : '';
  $sdate = isset($_POST['sdate']) ? $_POST['sdate'] : '';
  $role = isset($_POST['role']) ? $_POST['role'] : '';
  $status = isset($_GET['status']) ? '2' : '1';
  

  $query = "UPDATE user SET password = '$pwd', name = '$name', dob = '$date', education_stage = '$edustage', parentName = '$pname', email = '$email', contact = '$contact', address = '$address', startDate = '$sdate', role = '$role', status = '$status' WHERE loginID = '$loginid'";
   echo "$query";
  if(mysqli_query($link, $query)) {
      echo "<script>alert('Profile record updated successfully!')</script>";
  } else {
      echo "Error: " . mysqli_error($link);
  }
}

$query = "SELECT * FROM user WHERE loginID = '$id'";
$result = mysqli_query($link, $query);

if (!$result) {
    die("Error: " . mysqli_error($link));
}

$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <title>Edit User</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4a4db7d51e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">


     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!--lOGO-->
                    <a href="#top" class="navbar-brand">kids top</a>
               </div>

               <!--navbar-->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <?php if ($_SESSION['role'] == '1') : ?>
                              <li><a href="student.php" class="smoothScroll">Home</a></li>
                              <li><a href="viewprofile.php?profileid=<?php echo $user_id?>" class="smoothScroll">Profile</a></li>
                              <li><a href="courseList.php" class="smoothScroll">Course</a></li>
                         <?php else : ?>
                              <li><a href="teacher.php" class="smoothScroll">Home</a></li>
                              <li><a href="viewprofile.php?profileid=<?php echo $user_id?>" class="smoothScroll">Profile</a></li>
                              <li><a href="manageStudent.php?profileid=<?php echo $user_id?>" class="smoothScroll">Manage Student</a></li>
                              <li><a href="manageCourse.php?profileid=<?php echo $user_id?>" class="smoothScroll">Manage Course</a></li>
                         <?php endif ?>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">   
                          
                         <li class="dropdown">   
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>
                                   <?php if (isset($_SESSION['loginID'])) : ?>
                                   <b><?php echo $_SESSION['loginID']; ?></b>
                                   <?php endif ?>
                              </a> 
                              <ul class="dropdown-menu">
                                   <li style="margin-top: 10px; margin-bottom: 20px; margin-left: 15px;">Hi, <?php  echo $_SESSION['loginID'];?></li>         
                                   <li role="separator" class="divider"></li>
                                   <li><a href ="viewprofile.php?profileid=<?php echo $user_id?>">User Profile</a></li>
                                   <?php if ($_SESSION['role'] == '1') : ?>
                                             <li><a href="courseList.php">My course</a></li>
                                   <?php else : ?>
                                        <li><a href="manageStudent.php?profileid=<?php echo $user_id?>" class="smoothScroll">Manage Student</a></li>
                                        <li><a href="manageCourse.php?profileid=<?php echo $user_id?>" class="smoothScroll">Manage Course</a></li>
                                    <?php endif ?>
                                   
                                   <li><a href="logout.php">Log Out</a></li>
                              </ul>
                    </ul>
               </div>
          </div>
     </section>
     
     <section id="editProfile" >
          <div class="container">
               <div id="profiledetail" class="section">
                    <div class="section-center">
                         <div class="row">
                          <h6><a href="manageStudent.php?profileid=<?php echo $user_id?>">< Back</a></h6>
                              <h1 style="color:black; text-align:top; margin-top: -10px;">Edit User</h1>
                              <form action="" method="post" autocomplete="no" id = "updateForm">
                              <!-- Display the fetched record in an editable form -->
                                
                              <div class="form-group">
                                  <label for="loginID">Login ID:</label>
                                  <input type="text" class="form-control" id="loginID" placeholder="Enter Login ID"  value="<?php echo $row['loginID']; ?>" name="loginID" required>
                                </div>

                                <div class="form-group">
                                  <label for="pwd">Password:</label>
                                  <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" value="<?php echo $row['password']; ?>" required>
                                </div>

                                <div class="form-group">
                                  <label for="name">Name:</label>
                                  <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo $row['name']; ?>" required>
                                </div>

                                <div class="form-group">
                                  <label for="date">Date of Birth:</label>
                                  <input type="date" class="form-control" id="date" name="date" value="<?php echo $row['dob']; ?>" required>
                                </div>

                                <div class="form-group">
                                  <label for="edustage">Education Stage:</label>
                                  <select class="form-control" id="edustage" name="edustage" value="<?php echo $row['education_stage']; ?>" required>
                                    <option value="Pre-K">Pre-K</option>
                                    <option value="Kindergarten">Kindergarten</option>
                                  </select>
                                </div>
    
                                <div class="form-group">
                                  <label for="pname">Parent Name:</label>
                                  <input type="text" class="form-control" id="pname" placeholder="Enter parent name" name="pname" value="<?php echo $row['parentName']; ?>" required>
                                </div>

                                <div class="form-group">
                                  <label for="email">Email:</label>
                                  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $row['email']; ?>" required>
                                </div>

                                <div class="form-group">
                                  <label for="contact">Contact:</label>
                                  <input type="text" class="form-control" id="contact" name="contact" style="background: #ffffff" value="<?php echo $row['contact']; ?>" required>
                                </div>

                                <div class="form-group">
                                  <label for="address">Address:</label>
                                 <input type="text" class="form-control" id="address" placeholder="Enter address" name="address"  value="<?php echo $row['address']; ?>"required>
                                </div>

                                <div class="form-group">
                                  <label for="sdate">Start Date:</label>
                                  <input type="date" class="form-control" id="sdate" name="sdate" value="<?php echo $row['startDate']; ?>" required>
                                </div>

                                <div class="form-group" hidden>
                                  <label for="role" hidden>Role:</label>
                                  <input type="text" class="form-control" id="role" name="role" value="1" readonly hidden>
                                </div>

                                <button type="submit" class="btn btn-primary" name="update">Update</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
</body>
</html>
