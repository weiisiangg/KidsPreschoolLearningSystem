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
     $username = '';

     if(isset($_SESSION['loginID'])){
          $loginID = $_SESSION['loginID'] ;
          $user_id = $_SESSION['user_id'] ;
          echo $_SESSION['user_id'];
     }else{
          echo "Session not set"; 
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
          </div>
     </section>

     <!-- START -->
     <section id="viewCourse">
     <div class="container">
               <div id="profiledetail" class="section">
                    <div class="section-center">
                         <div class="row">
                         <h6><a href="manageCourse.php">< Back</a></h6>
                         <h1 style="color:black; text-align:top; margin-top: -10px;">Add Course</h1>
          <?php
               // The update POST message with create course flag
                if (isset($_POST) && isset($_GET["new"])) {
                    $course_name = $_POST["course-name"];
                    $course_video = $_POST["course-video"];
                    $course_description = $_POST["course-description"];
                    $teacher_id = $_SESSION['user_id'];
                    $education_stage = $_POST["education_stage"];

                    // A random number.
                    $random_offset = 10;
                    // Calculate course_id based on row amount
                    $course_id = mysqli_query($con, "SELECT COUNT(*) as amount FROM course;")->fetch_assoc()["amount"] + $random_offset;
                    
                    $query = "INSERT INTO course (course_id, course_name, course_video, course_description, education_stage, teacher_id, admin_id)
                              VALUES ('$course_id', '$course_name', '$course_video', '$course_description', '$education_stage', '$teacher_id', NULL);";
                    
                    if(mysqli_query($con, $query)){
                         echo "<script>alert('Course record updated successfully!')</script>";
                    }else{
                         echo "Error: " . mysqli_error($con);
                    }
                }
          ?>
                <!-- The course new form -->
                
            <form action="newCourse.php?new=true" method="post">
            <table class= "table table-boardered table-hover">
               <tr>
                    <td style="font-weight:bold;">The course name:</td>
                    <td>
                         <input class="form-control" type="text" name="course-name" id="course-name" placeholder="Enter your course name here.." required>
                    </td>
               </tr>

               <tr>
                    <td style="font-weight:bold;">The course video:</td>
                    <td>
                         <input class="form-control" type="text" name="course-video" id="course-video" placeholder="Enter your youtube video ID here.." required>
                    </td>
               </tr>

               <tr>
                    <td style="font-weight:bold;">The course description:</td>
                    <td>
                    <textarea name="course-description" cols="110" rows="10" required placeholder="Enter your description here.." style="resize:none;"></textarea>
                    </td>
               </tr>

               <tr>
                    <td style="font-weight:bold;">Education Stage:</td>
                    <td>
                    <select class="form-control" id="education_stage" name="education_stage">
                                <option value="Pre-K">Pre-K</option>
                                <option value="Kindergarten">Kindergarten</option>
                    </select>                    
               </td>
               </tr>
          </table>

               <tr align="center">
               <td colspan="6">
                    <button type="submit" class="btn btn-primary" style="width:250px;margin-left:35%;margin-bottom:3%;background: palevioletred;border: 1px solid transparent;cursor: pointer;font-size: 20px;" onMouseOver="this.style.background='rgba(253,187,45,1)'" 
                              onMouseOut="this.style.background='palevioletred'">Create new course</button>
               </td>
            </form>
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