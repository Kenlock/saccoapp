<?php
error_reporting(0);
include("database.php");
session_start();
 if($_SESSION['admin']==""){
    header("location:index.php");
  }
?>
<?php
date_default_timezone_set('Africa/Nairobi');
include('database.php');
if(isset($_POST['individual'])){
  $fname=htmlentities($_POST['fname']);
  $nid=htmlentities($_POST['nid']);
  $address=htmlentities($_POST['address']);
  $phone=htmlentities($_POST['phone']);
  $type='individual';
$sql=$con->prepare("INSERT INTO members(fname,nid,address,phone,membership_type) VALUES(:fname,:nid,:address,:phone,:type)");
$sql->execute(array(":fname"=>$fname,":nid"=>$nid,":address"=>$address,":phone"=>$phone,":type"=>$type));
$query=$con->prepare("SELECT nid FROM members ORDER BY nid DESC LIMIT 1");
$query->execute();
$data=$query->fetch();
$id=$data['nid'];
$amount=2000;
$date=date('Y-m-d H:i:s');
$query2=$con->prepare("INSERT INTO fees(nid,amount,date_paid)VALUES(:id,:amount,:date_paid)");
$query2->execute(array(":id"=>$id,":amount"=>$amount,":date_paid"=>$date));
if($query2){
  header("location:index.php?member_registered");
}
}
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
 <?php include("header.php");?>
   <div class="jumbotron" style="margin-top: -33px;height: 100px;padding-top: 10px;">
   <h2 class="text-center text-warning"><strong>Individual Membership</strong></h2>
   </div>
   <div class="container-fluid">


   <div class="row">
   <div class="col-sm-8 col-sm-offset-2">
   <div class="well">
   <div class="text-center">
   <h3 class="text-warning">Individual Membership</h3>
   <small>Fill in the form below with your personal data</small>
   </div>
   <hr>
   <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
      <div class="form-group">
       <?php
if (isset($_GET['member_registered'])) {
 echo '<div class="alert alert-dismissible alert-success text-center">
  <button type="button" class="close" data-dismiss="alert">×</button>'.'Member registered successfully'.'
</div>';

}
    ?>
    </div>
    <div class="form-group">
    <label for="full name">Full Name</label>
    <input type="text" class="form-control" name="fname" placeholder="Full Name" required="">
  </div>
    <div class="form-group">
    <label for="full name">National ID No.</label>
    <input type="text" class="form-control" name="nid" placeholder="National ID No." required="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" class="form-control" name="address" placeholder="Address" required="">
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Phone number</label>
    <input type="text" class="form-control" name="phone" placeholder="phone" required="">
  </div>
  <button type="submit" class="btn btn-default" name="individual">Submit Details</button>
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