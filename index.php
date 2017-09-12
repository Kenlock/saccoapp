<?php
error_reporting(0);
include("database.php");
session_start();
if ($_SESSION["admin"]!="") {
  header("location:individual.php");
}
 if (isset($_POST['login'])) {
$username=$_POST['username'];
$password=$_POST['password'];
if ($username=="" || $password=="") {
 $error="Username or Password should not be left empty";
}
else{
   $STM = $con->prepare("SELECT * FROM users WHERE username = :username AND password = :password");

   $STM->bindParam(':username', $username);
   $STM->bindParam(':password', $password);

   $STM->execute();
// Count no. of records
$count = $STM->rowCount();

if($count==1)

 {
   $row  = $STM ->fetch(PDO::FETCH_ASSOC);
     $_SESSION['admin']=$row['username'];
      header( "location:individual.php");
}
else {
$error="Wrong Username or Password!";
}
}

}
/**
$url=file_get_contents("http://localhost/bank/public/api/customer_balances");
$data=json_decode($url);
print_r($data);
*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Mwanzo Baraka Information Management system</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/datatables.min.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
   <div class="jumbotron" style="margin-top: -23px;height: 100px;padding-top: 10px;">
   <h2 class="text-center text-warning"><strong>MWANZO BARAKA INFORMATION MANAGEMENT SYSTEM</strong></h2>
   </div>
   <div class="container">


   <div class="row">
   <div class="col-sm-4 col-sm-offset-4">
   <div class="well">
   <div class="text-center">
   <h3 class="text-warning">Login</h3>
   <small>Provide Login details below to access the system </small>
   </div>
   <hr>
   <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">

    <div class="form-group">
    <label for="full name">Username</label>
    <input type="text" class="form-control" name="username" placeholder="Username" required="">
  </div>
    <div class="form-group">
    <label for="full name">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password" required="">
  </div>
  <button type="submit" class="btn btn-warning btn-lg col-sm-offset-4" name="login">LOGIN</button>
</form>
</div>
   </div>
   <!--end first row-->
 
   </div><!--end row-->
   </div><!--end container-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>