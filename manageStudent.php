<?php 
include ('conn.php');
session_start();
// LOGIN USER

     $errors = array();
     if(!isset($_SESSION['loginID'])){
          header("Location: login.php");
     }
function connect(){
    $con = mysqli_connect("localhost", "root", "", "preschool_system");
    if(mysqli_connect_errno()){
        echo "Connection Fail" . mysqli_connect_error();
    }
    return $con;
}

$link = connect();

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
        echo "Record updated successfully.";
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>

     <title>Kids Top, Kids Preschool Learning System</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">
     <meta name="description" content="TWT2231 Group Project">
     <meta name="author" content="Lim Wei Siang, Tong Yi Zhong, Cheong Li Sheng, Thin Tian Shun">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <script src="https://kit.fontawesome.com/4a4db7d51e.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="css/style.css">

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>


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
                         <li><a href="teacher.php" class="smoothScroll">Home</a></li>
                         <li><a href="viewprofile.php?profileid=<?php echo $user_id?>" class="smoothScroll">Profile</a></li>
                         <li><a href="manageStudent.php?profileid=<?php echo $user_id?>" class="smoothScroll">Manage Student</a></li>
                         <li><a href="manageCourse.php" class="smoothScroll">Manage Course</a></li>
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
                                   <li><a href="manageStudent.php?profileid=<?php echo $user_id?>">Manage Student</a></li>
                                   <li><a href="manageCourse.php">Manage Course</a></li>
                                   <li><a href="logout.php">Log Out</a></li>
                              </ul>
                    </ul>
               </div>

          </div>
     </section>

     <section id = "manageStudent">
     <div class="container">
          <div id="studentList" class="section">
               <div class="section-center">
                    <div class="row">
                    <h1 style="color:black; text-align:top; margin-top: -10px;">Student Lists</h1>
                    <table class= "table table-boardered table-hover"> 

                         <thead>
                         <tr><br><br>
                              <th>No.</th>
                              <th>Login ID</th>
                              <th>Password</th>
                              <th>Name</th>
                              <th>Dob</th>
                              <th>Education Stage</th>
                              <th>Parent Name</th>
                              <th>Email</th>
                              <th>Contact</th>
                              <th>Address</th>
                              <th>Start Date</th>
                              <th>Action</th>
                         </tr>
                         </thead>

                         <tbody>
                              <?php
                                   $i = 1;
                                   $res=mysqli_query($link,"select * from user WHERE role = 1");
                                   while($row=mysqli_fetch_array($res))
                                   {
                                        echo "<tr>";
                                        echo "<td>"; echo $i; $i++; echo"</td>";
                                        echo "<td>"; echo $row["loginID"]; echo"</td>";
                                        echo "<td>"; echo $row["password"]; echo"</td>";
                                        echo "<td>"; echo $row["name"]; echo"</td>";
                                        echo "<td>"; echo $row["dob"]; echo"</td>";
                                        echo "<td>"; echo $row["education_stage"]; echo"</td>";
                                        echo "<td>"; echo $row["parentName"]; echo"</td>";
                                        echo "<td>"; echo $row["email"]; echo"</td>";
                                        echo "<td>"; echo $row["contact"]; echo"</td>";
                                        echo "<td>"; echo $row["address"]; echo"</td>";
                                        echo "<td>"; echo $row["startDate"]; echo"</td>";
                                        echo "<td>";
                                        $id = htmlspecialchars($row["loginID"] ?? ""); // Sanitize the value and provide a default empty string if it's not set
                                        echo '<a href="edit.php?id=' . $row["loginID"] . '"><button type="button" class="btn btn-success">Edit</button></a>';
                                        echo '<form action="manageStudent.php?status=2" method="post">';
                                        echo '<input type="text" id="loginID" name="loginID" value=' . $row["loginID"] . ' style="display:none;">';
                                        echo '<input type="text" id="password" name="password" value=' . $row["password"] . ' style="display:none;">';
                                        echo '<input type="text" id="name" name="name" value=' . $row["name"] . ' style="display:none;">';
                                        echo '<input type="text" id="dob" name="dob" value=' . $row["dob"] . ' style="display:none;">';
                                        echo '<input type="text" id="education_stage" name="education_stage" value=' . $row["education_stage"] . ' style="display:none;">';
                                        echo '<input type="text" id="parentName" name="parentName" value=' . $row["parentName"] . ' style="display:none;">';
                                        echo '<input type="text" id="email" name="email" value=' . $row["email"] . ' style="display:none;">';
                                        echo '<input type="text" id="contact" name="contact" value=' . $row["contact"] . ' style="display:none;">';
                                        echo '<input type="text" id="address" name="address" value=' . $row["address"] . ' style="display:none;">';
                                        echo '<input type="text" id="startDate" name="startDate" value=' . $row["startDate"] . ' style="display:none;">';
                                        echo '<input type="text" hidden id="role" name="role" value=' . $row["role"] . ' style="display:none; ">';
                                        echo '<input type="text" hidden id="status" name="status" value="2" style="display:none; ">';
                                        echo '<input type="text" id="update" name="update" value="tuna" style="display:none; ">';
                                        echo '<button type="submit"  class="btn btn-danger">Delete</button>';
                                        echo '</form>';
                                        echo "</td>";
                                        echo "</tr>";
                                   }
                              ?>
                         </tbody>
                    </table>
                    </div>
                    <input type="button" class="button-active" style="width:250px; margin-left:35%; margin-bottom:3%; border-radius:20px; border: 1px solid transparent;
                    background: palevioletred; color: #ffffff; text-transform: capitalize; cursor: pointer; font-size: 20px;" onMouseOver="this.style.background='rgba(253,187,45,1)'" 
                    onMouseOut="this.style.background='palevioletred'" onclick="location.href='newStudent.php'" value="Create a new student">     
               </div>
          </div>
     </div>
    </section>     

     <!-- FOOTER -->
     <footer id="footer">
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <div class="section-title">
                                   <h2>Office Location</h2>
                              </div>
                              <address>
                                   <p>Kids Top, Bukit Beruang<br>Ayeh Keroh, Melaka 75450</p>
                              </address>

                              <ul class="social-icon">
                                   <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>

                              <div class="copyright-text"> 
                                   <p>Copyright &copy; 2023 Group Kids Top</p>
                                   
                                   <p>Design: Group Kids Top</p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <div class="section-title">
                                   <h2>Contact Info</h2>
                              </div>
                              <address>
                                   <p>+60-167577211</p>
                                   <p><a href="mailto:youremail.co">kidstop8@gmail.com</a></p>
                              </address>

                              <div class="footer_menu">
                                   <h2>Quick Links</h2>
                                   <ul>
                                        <li><a href="index.html#about">About</a></li>
                                        <li><a href="login.php">Login</a></li>
                                        <li><a href="index.html#unique">Uniqueness</a></li>
                                        <li><a href="index.html#program">Programmes</a></li>
                                        <li><a href="index.html#location">Location</a></li>
                                   </ul>
                              </div>
                         </div>
                    </div>     
               </div>
          </div>
     </footer>


     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>
     
</body>
</html>
</body>
</html>
