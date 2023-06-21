<?php 

$connect = mysqli_connect("localhost", "root", "", "preschool_system");

$name = mysqli_real_escape_string($connect, $_POST['name']);
$email = mysqli_real_escape_string($connect, $_POST['email']);
$subject = mysqli_real_escape_string($connect, $_POST['subject']);
$message = mysqli_real_escape_string($connect, $_POST['message']);

$sql = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

mysqli_query($connect, $sql);
mysqli_close($connect);

?>