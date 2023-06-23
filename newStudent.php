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

     function connect(){
        $con = mysqli_connect("localhost", "root", "", "preschool_system");
        if(mysqli_connect_errno()){
            echo "Connection Fail" . mysqli_connect_error();
        }
        return $con;
    }
    
    $link = connect();
    
    if (isset($_POST["insert"])) {
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
        $status = isset($_POST['status']) ? $_POST['status'] : '';
    
        $query = "INSERT INTO user (loginID, password, name, dob, education_stage, parentName, email, contact, address, startDate, role, status) VALUES ('$loginid', '$pwd', '$name', '$date', '$edustage', '$pname', '$email', '$contact', '$address', '$sdate', '$role', $status)";
    
    
        if(mysqli_query($link, $query)) {
            echo "<script>alert('Profile record insert successfully!')</script>";
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

     <!-- START -->
     <section id="addStudent">
     <div class="container">
               <div id="profiledetail" class="section">
                    <div class="section-center">
                         <div class="row">
                         <h6><a href="manageStudent.php?profileid=<?php echo $user_id?>">< Back</a></h6>
                            <h1 style="color:black; text-align:top; margin-top: -10px;">Add Student</h1>
                            <form action="newStudent.php" method="post" autocomplete = "off">
                            <div class="form-group">
                                <label for="loginID">Login ID:</label>
                                <input type="text" class="form-control" id="loginID" placeholder="Enter Login ID" name="loginID" required>
                            </div>

                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                            </div>

                        <div class="form-group">
                            <label for="date">Date of Birth:</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>

                        <div class="form-group">
                            <label for="edustage">Education Stage:</label>
                            <select class="form-control" id="edustage" name="edustage">
                                <option value="Pre-K">Pre-K</option>
                                <option value="Kindergarten">Kindergarten</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pname">Parent Name:</label>
                            <input type="text" class="form-control" id="pname" placeholder="Enter parent name" name="pname" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="contact">Contact:</label>
                            <input type="tel" class="form-control" id="contact" name="contact" placeholder="Enter Phone Number" style="background:#ffffff; margin-top: -2px;">
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" required>
                        </div>

                        <div class="form-group">
                            <label for="sdate">Start Date:</label>
                            <input type="date" class="form-control" id="sdate" name="sdate" required>
                        </div>

                        <div class="form-group" hidden>
                            <label for="role" hidden>Role:</label>
                            <input type="text" class="form-control" id="role" name="role" value="1" readonly hidden>
                        </div>

                        <div class="form-group" hidden>
                            <label for="status" hidden>Status:</label>
                            <input type="text" class="form-control" id="status" name="status" value="1" readonly hidden>
                        </div>

                        <button type="submit" class="btn btn-primary" name="insert" style="width:250px;margin-left:35%;margin-bottom:3%;background: palevioletred;border: 1px solid transparent;cursor: pointer;font-size: 20px;" onMouseOver="this.style.background='rgba(253,187,45,1)'" 
                              onMouseOut="this.style.background='palevioletred'">Add Student</button><br><br>
                    </form>
                </div>
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