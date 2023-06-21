<?php 
    $con = mysqli_connect("localhost", "root", "", "preschool_system");
    if (mysqli_connect_errno()){
        echo "Connection Fail".mysqli_connect.error();
    }
?>