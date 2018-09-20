<?php
session_start();
$username = "";
$password  = "";
$dbName="student";

$db = mysqli_connect('localhost', 'root', '', $dbName);
 
$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);

$user_check_query = "SELECT * FROM userlogin WHERE username='$username' AND password='$password'";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
  
if ($user) {
  $_SESSION['userid'] = $user['userid'];
  header('Location: adminmainpage.php');
  return;
}
$user = null;

$user_check_query = "SELECT * FROM teacherlogin WHERE username='$username' AND password='$password'";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
  
echo '<h2>Here</h2>';
if ($user) {
  $_SESSION['teacherid'] = $user['teacherid'];
  echo '<h2>Found Teacher</h2>';
  header('Location: teacher.php');
  return;
}
$user = null;

$user_check_query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
  
if ($user) {
  $_SESSION['studentid'] = $user['studentid'];
  header('Location: mainpage.php');
}
else{
  $_SESSION['errMsg'] = 'Invalid Username or Password';
  header('Location: En.php');
}


?>
