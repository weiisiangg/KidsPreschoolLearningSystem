<?php
require "conn.php";
$mysqli = new mysqli('localhost','root','','preschool_system') or die(mysqli_error($mysqli));        
$update=false;

$result="SELECT * FROM contact";
$search_Result = mysqli_query($con, $result);

function pre_r($array){
    echo '<pre>';
    print_r($array);
     echo'</pre>';
}

//DELETE
if(isset($_GET['delete']))
{
    $id2 =$_GET['delete'];
    $delete_Query = "DELETE FROM contact WHERE contact_id = $id2";
    try{
        $delete_Result = mysqli_query($con, $delete_Query);
  
   
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

?>


<!DOCTYPE Html>
<html>
    <head>
        <title>Feedback Record</title>
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
    <?php
require_once "conn.php";
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
                                 
                                    <li><a href="feedback.php">View Feedback</a></li>
                                    <li class="active">FeedBack</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





 <div class= "container">
 <div class="justify-content-center">
                               <h2><strong>User </strong>FeedBack  <h2><br>
                            </div>
                           

    <div class ="row justify-content-center">
        <table class="table">
          <thead>
             <tr>
                
                 <th>Name</th>
                 <th>Email</th>
                 <th>Subject</th>
                 <th>Message</th>
                
                 <th colspan="2">Action</th>
            </tr>
         </thead>
        <?php
            while ($row = $search_Result -> fetch_assoc()):?>
                <tr>
                    
                     <td><?php echo $row['name'];?></td>
                     <td><?php echo $row['email'];?></td>
                     <td><?php echo $row['subject'];?></td>
                     <td><?php echo $row['message'];?></td>
                  
                <td>
                   <a href="viewfeedback.php?viewid=<?php echo $row['contact_id'];?>"
                    class="btn btn-success">View</a>
                    <a href="feedback.php?delete=<?php echo $row['contact_id'];?>"
                    class="btn btn-danger">delete</a>
                </td>
                </tr>
            <?php endwhile;?>
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
