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
if(isset($_POST['share'])){
$nid=$_POST['nid'];
$amount=$_POST['amount'];
$query=$con->prepare("SELECT * FROM members WHERE nid=:nid");
$query->execute(array(":nid"=>$nid));
$data=$query->fetch();
if($data['membership_type']=="group"){
  $stm=$con->prepare("SELECT groupname FROM groups WHERE nid=:nid LIMIT 1");
  $stm->execute(array(":nid"=>$nid));
  $rows=$stm->fetch();
  $fees=$amount*0.8;
  $shares=$amount*0.2;
  $contribution=$amount;
  $date=date('Y-m-d H:i:s');
  $sql=$con->prepare("INSERT INTO shares(nid,date_paid,amount,contribution)VALUES(:nid,:date_paid,:amount,:contribution)");
  $sql->execute(array(":nid"=>$nid,":date_paid"=>$date,":amount"=>$fees,":contribution"=>$contribution));
  $q=$con->prepare("INSERT INTO shares(group_name,date_paid,amount,contribution)VALUES(:group,:date_paid,:amount,:contribution)");
  $q->execute(array(":group"=>$rows['groupname'],":date_paid"=>$date,":amount"=>$shares,":contribution"=>$contribution));
  }
else{
   $date=date('Y-m-d H:i:s');
  $m=$con->prepare("INSERT INTO shares(nid,date_paid,amount,contribution)VALUES(:nid,:date_paid,:amount,:contribution)");
  $m->execute(array(":nid"=>$nid,":date_paid"=>$date,":amount"=>$amount,":contribution"=>$amount));
}
header("location:shares.php?contributed");
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
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
  <?php include("header.php");?>
   <div class="jumbotron" style="margin-top: -33px;height: 100px;padding-top: 10px;">
   <h2 class="text-center text-warning"><strong>Monthly Contributions</strong></h2>
   </div>
   <div class="container-fluid">
   <div class="row">
   <div class="col-lg-8 col-sm-offset-2">
   <div class="well">
   <div class="text-center">
   <h3 class="text-warning"></h3>
   <small>Enter member national id and the amount he/she is contributing.</small>
   </div>
   <hr>
   <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
      <div class="form-group">
       <?php
if (isset($_GET['contributed'])) {
 echo '<div class="alert alert-dismissible alert-success text-center">
  <button type="button" class="close" data-dismiss="alert">×</button>'.'Contribution made successfully'.'
</div>';

}
    ?>
    </div>
    <div class="form-group">
    <label for="full name">National ID No. <star class="text-danger">*</star></label>
    <input type="text" class="form-control" name="nid" placeholder="National ID No." required="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Amount to be contributed <star class="text-danger">*</star></label>
    <input type="number" class="form-control" name="amount" placeholder="Amount" required="" min="1000">
  </div>
  <button type="submit" class="btn btn-success btn-lg" name="share">Submit Details</button>
</form>
</div>
   </div>
   <!--end first row-->
   
   </div>
   <!--end first row-->
   <!--end second row-->
   </div><!--end row-->
   </div><!--end container-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>


  </body>
</html>