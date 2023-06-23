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
     $name = '';

     if(isset($_SESSION['loginID'])){
          $loginID = $_SESSION['loginID'] ;
          $user_id = $_SESSION['user_id'] ;
          $name = $_SESSION['name'];
          $role = $_SESSION['role'];
          echo $_SESSION['user_id'];
     }else{
          echo "Session not set"; 
     }

     function connect(){
          $con = mysqli_connect("localhost", "root", "", "preschool_system");
          if(mysqli_connect_errno()){
              echo "Connection Fail" . mysqli_connect_error();
          }
          return $con;
      }
      
      $link = connect();

     // if there is a post message (with delete flag on)
     if (isset($_REQUEST["delete"])) {
          $course_id = $_REQUEST["course_id"];
          $query = "DELETE FROM course WHERE course_id = $course_id";

          // TODO: Test if it actually delete the course
          mysqli_query($con, $query);
     }

     $query = "SELECT * FROM course";
     $results = mysqli_query($con, $query);

     while ($row = $results->fetch_assoc()) {
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
                         <li><a href="manageCourse.php?profileid=<?php echo $user_id?>" class="smoothScroll">Manage Course</a></li>
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
                                   <li><a href="manageCourse.php?profileid=<?php echo $user_id?>">Manage Course</a></li>
                                   <li><a href="logout.php">Log Out</a></li>
                              </ul>
                    </ul>
               </div>

          </div>
     </section>

    <section id="manageCourse">
     <div class="container">
          <div id="courseList" class="section">
               <div class="section-center">
                    <div class="row">
                    <h1 style="color:black; text-align:top; margin-top: -10px;">Course Lists</h1>
                    <table class= "table table-boardered table-hover"> 
                         <thead>
                         <tr><br><br>
                              <th>No.</th>
                              <th>Course Name</th>
                              <th>Course Video</th>
                              <th>Course Description</th>
                              <th>Education Stage</th>
                              <th>Created by</th>
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
                               echo "<td>"; echo $row["course_name"]; echo"</td>";
                               echo "<td>"; echo $row["course_video"]; echo"</td>";
                               echo "<td>"; echo $row["course_description"]; echo"</td>";
                               echo "<td>"; echo $row["education_stage"]; echo"</td>";
                               echo "<td>"; echo $row["teacher_id"]; echo"</td>";
                          }
                         ?>
                         <td><a href="editCourse.php?course_id=<?php echo $row["course_id"] ?>" style="color:black;"><button type="button">Edit</button></a></td>
                         <td><a href="viewCourse.php?course_id=<?php echo $row["course_id"] ?>" style="color:black;"><button type="button">View</button></a></td>
                         <td><form action="manageCourse.php?delete=true&&course_id=<?php echo $row["course_id"] ?>" method="post">
                         <button type="submit">Delete</button>
                         </form></td>
                         </tbody>
                         </table>
         

                    <!-- TODO: Include CSS -->
                         <input type="button" class="button-active" style="width:250px; margin-left:35%; margin-bottom:3%; border-radius:20px; border: 1px solid transparent;
                              background: palevioletred; color: #ffffff; text-transform: capitalize; cursor: pointer; font-size: 20px;" onMouseOver="this.style.background='rgba(253,187,45,1)'" 
                              onMouseOut="this.style.background='palevioletred'" onclick="location.href='newCourse.php'" value="Create a new course">     
                    </div>
               </div>
          </div>
     </div>
     </section>
     <?php
          }
     ?>

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
     </div>
     </footer>

     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>
     
</body>
</html>