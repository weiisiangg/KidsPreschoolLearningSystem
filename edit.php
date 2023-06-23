<?php
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

    $query = "UPDATE user SET password = '$pwd' WHERE loginID = '$loginid'";

    if (mysqli_query($link, $query)) {
        header("Location: test.php"); // Redirect back to the test.php file
        exit();
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="col-lg-5 form-container">
        <h2>Edit User</h2>
        <form action="test.php" method="post">
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
      <input type="date" class="form-control" id="date" name="date" value="<?php echo $row['date']; ?>" required>
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
      <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $row['contact']; ?>" required>
    </div>
    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" class="form-control" id="address" placeholder="Enter address" name="address"  value="<?php echo $row['address']; ?>"required>
    </div>
    <div class="form-group">
      <label for="sdate">Start Date:</label>
      <input type="date" class="form-control" id="sdate" name="sdate" value="<?php echo $row['startDate']; ?>" required>
    </div>
       <div class="form-group">
        <label for="role">Role:</label>
        <input type="text" class="form-control" id="role" name="role" value="1" readonly>
      </select>
    </div>
    <button type="submit" class="btn btn-primary" name="update">Update</button>
    </form>
    </div>
    
</div>

</body>
</html>
