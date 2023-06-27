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

     $result="SELECT * FROM user";

     $user_id = '';
     $loginID = '';
     $password = '';
     $name = '';
     $dob = '';
     $parentName = '';
     $email = '';
     $contact ='';
     $address = '';
     $startDate = '';

     if(isset($_SESSION['login_id'])){
          $loginID =   $_SESSION['loginID'] ;
          $user_id =   $_SESSION['user_id'] ;
          $name = $_SESSION['name'];
          $role = $_SESSION['role'];
          echo $_SESSION['user_id'];
     }else{
          echo "Session not set"; 
     }

     function connect(){
          $con=mysqli_connect("localhost", "root", "", "preschool_system");
          if(mysqli_connect_errno()){
               echo "Connection Fail".mysqli_connect_error();
          }
     return $con;
     }

     //edit
     if(isset($_POST['update'])){
          $conn = connect();
          $loginID=$_POST['loginID'];
          $password=$_POST['password'];
          $name=$_POST['name'];
          $dob = $_POST['dob'];
          $parentName = $_POST['parentName'];
          $email = $_POST['email'];
          $contact = $_POST['contact'];
          $address = $_POST['address'];
          $startDate = $_POST['startDate'];
     
          $id = $user_id;

          $sql = "UPDATE user SET loginID='$loginID', password='$password', name='$name', dob='$dob', parentName='$parentName', email='$email', contact='$contact', address='$address', startDate='$startDate' WHERE user_id='$id'";

     if (mysqli_query($conn, $sql)) {
          echo "<script>alert('Profile record updated successfully!')</script>";
     } else {
          echo "Error updating record: " . mysqli_error($conn);
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

     <!-- Edit Profile -->
     <section id="profile" >
          <div class="container">
               <div id="profiledetail" class="section">
                    <div class="section-center">
                         <div class="row">
                              <h1 style="color:black; text-align:top; margin-top: -10px;">Profile detail</h1>
                              <form action="viewprofile.php" method="post" autocomplete="no" id="updateForm">
                              <?php
                                   $cid=$_SESSION['user_id'];
                                   $query = "SELECT * FROM user WHERE user_id='$cid'";

                                   $result = mysqli_query($con,$query);
                                   if($result->num_rows ==1){
                                   while ($row=$result-> fetch_assoc()) { 
                              ?>        
                              <table class= "table table-boardered table-hover">                                                  
                                   <tr hidden>
                                         <td style="font-weight:bold;">User ID</td>
                                         <td>
                                             <?php echo $user_id;?>
                                         </td>
                                   </tr>
                                   <?php if ($_SESSION['role'] == '1') : ?>
                                   <tr hidden>
                                         <td style="font-weight:bold;">Parent Name</td>
                                         <td>
                                             <input class="form-control" type="text" name="loginID" required value="<?php echo $row['loginID']; ?>">
                                         </td>
                                   </tr>
                                   <?php else : ?>
                                   <tr>
                                        <td style="font-weight:bold;">Parent Name</td>
                                        <td>
                                             <input class="form-control" type="text" name="loginID" required value="<?php echo $row['loginID']; ?>">
                                        </td>
                                   </tr>  
                                   <?php endif ?>
                                   <tr>
                                         <td style="font-weight:bold;">Password</td>
                                         <td>
                                             <input class="form-control" type="password" name="password" id="password" required value="<?php  echo $row['password']; ?>">
                                             <input type="checkbox" onclick="showpass()"><strong> Show Password</strong>
                                         </td>
                                   </tr>
                                   <tr>
                                         <td style="font-weight:bold;">Name</td>
                                         <td>
                                             <input class="form-control" type="text" name="name" required value="<?php  echo  $row['name']; ?>">
                                         </td>
                                   </tr>
                                   <tr>
                                         <td style="font-weight:bold;">Date of Birth</td>
                                         <td>
                                             <input class="form-control" type="date" name="dob" required value="<?php  echo  $row['dob']; ?>">
                                         </td>
                                   </tr>
                                   <?php if ($_SESSION['role'] == '2') : ?>
                                   <tr hidden>
                                         <td style="font-weight:bold;">Login ID</td>
                                         <td>
                                             <input class="form-control" type="text" name="parentName" required value="<?php echo $row['parentName']; ?>">
                                         </td>
                                   </tr>
                                   <?php else : ?>
                                   <tr>
                                        <td style="font-weight:bold;">Login ID</td>
                                        <td>
                                             <input class="form-control" type="text" name="parentName" required value="<?php echo $row['parentName']; ?>">
                                        </td>
                                   </tr>  
                                   <?php endif ?>
                                   <tr>
                                         <td style="font-weight:bold;">Email</td>
                                         <td>
                                             <input class="form-control" type="email" name="email" required value="<?php echo $row['email']; ?>">
                                         </td>
                                   </tr>
                                   <tr>
                                         <td style="font-weight:bold;">Contact</td>
                                         <td>
                                             <input class="form-control" type="text" name="contact" required value="<?php echo $row['contact']; ?>">
                                         </td>
                                   </tr>
                                   <tr>
                                         <td style="font-weight:bold;">address</td>
                                         <td>
                                             <input class="form-control" type="text" name="address" required value="<?php echo $row['address']; ?>">
                                         </td>
                                   </tr>
                                   <tr>
                                         <td style="font-weight:bold;">Start Date</td>
                                         <td>
                                             <input class="form-control" type="date" name="startDate" required value="<?php echo $row['startDate']; ?>">
                                         </td>
                                   </tr>
                              </table>
                                        <tr align="center">
                                        <td colspan="6">
                                             <input type="submit" id="update" name="update" style="width:250px;margin-left:35%;margin-bottom:3%;" value="Update data">
                                        </td>
                              </form>
                         </div>
                    </div>
                    <?php } }else{
                         echo "<h1>no record found</h1>"; 
                    } ?>
                     
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

     <script> 
          function showpass(){
               var x = document.getElementById("password");
               if(x.type === "password"){
                    x.type = "text";
               } else {
                    x.type="password";
               }
          }
     </script>

</body>
</html>