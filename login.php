<?php 
include ('conn.php');
session_start();

    $errors = array(); 

    //LOGIN USER
    if (isset($_POST['login'])) {
        $loginID =$_POST['loginID'];
        $password =$_POST['password'];
        $user_id='';

        if (count($errors) == 0) {
            $query = "SELECT * FROM user WHERE loginID='$loginID' AND password='$password' AND status = '1'";
            $results = mysqli_query($con, $query);

            if (mysqli_num_rows($results) == 1) {
                while ($row=$results-> fetch_assoc()) { 
                    $_SESSION['loginID'] = $loginID;
                    $_SESSION['user_id']= $row['user_id'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['education_stage'] = $row['education_stage'];
                    $_SESSION['success'] = "You are now logged in";
                }
                if ($_SESSION['role'] == '1'){
                    header('location: student.php');
                }
                else{
                    header('location: teacher.php');
                }
                
            }else {
                array_push($errors, "Wrong username/password combination");
            }
        }
    }

?>

<!DOCTYPE html>
<html>
<head>

     <title>Login</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <script src="https://kit.fontawesome.com/4a4db7d51e.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="css/style.css">

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    <style>
        .error {
            width: 92%; 
            margin: 0px auto; 
            padding: 10px; 
            border: 1px solid #a94442; 
            color: #a94442; 
            background: #f2dede; 
            border-radius: 5px; 
            text-align: left;
        }
    </style>

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
                         <li><a href="index.html" class="smoothScroll">Home</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="login.php"><i class="fa fa-user"></i>Log in</a></li>
                         </div>
                    </ul>
               </div>

          </div>
     </section>

     <!-- Login -->
    <section id="Login">
        <div class="backgroundimg3">
            <div class="form-container">
                <form action="login.php" method="post" autocomplete="off" id="login">
                <?php include('errors.php'); ?>        
                <h3>Login now</h3>
                    <input type="text" name="loginID" required placeholder="User ID">
                    <input type="password" name="password" required placeholder="Password">
                    <input type="submit" name="login" value="login now" class="form-btn">
                </form>
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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>