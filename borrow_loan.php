<?php
include("database.php");
session_start();
 if($_SESSION['admin']==""){
    header("location:index.php");
  }
?>
<?php
date_default_timezone_set('Africa/Nairobi');
include('database.php');
if(isset($_POST['loan'])){
  $nid=$_POST['nid'];
  $date=date('Y-m-d H:i:s');
  $status="active";
$q=$con->prepare("SELECT nid,membership_type FROM members WHERE nid=:nid");
$q->execute(array(":nid"=>$nid));
$dump=$q->fetch();

$query=$con->prepare("SELECT nid,SUM(amount) AS total FROM shares  WHERE nid=:nid");
$query->execute(array(":nid"=>$nid));
$data=$query->fetch();
$m=$con->prepare("SELECT * FROM loans  WHERE nid=:id");
$m->execute(array(":id"=>$nid));
$c=$m->fetch();
if($c['loan_status']=="active"){
  $error="You have an active loan repay it first before requesting for another one!";
}
else{
  if($dump['membership_type']=='individual'){
  $loan=$data['total']*3;
  $period=3;
  $rate=0.012;
  $amount=$loan+($loan*$rate*$period);
  $interest=($loan+($loan*$rate*$period))/($period*12);
$sql=$con->prepare("INSERT INTO loans(nid,date_awarded,principal,loan_period,interest,amount,loan_status) VALUES(:nid,:date_awarded,:principal,:loan_period,:interest,:amount,:loan_status)");
$sql->execute(array(
  ":nid"=>$nid,
  ":date_awarded"=>$date,
  ":principal"=>$loan,
  ":loan_period"=>$period,
  ":interest"=>$interest,
  ":amount"=>$amount,
  ":loan_status"=>$status
  ));
$error="Loan Awarded successfully!";
}
elseif ($dump['membership_type']=='group') {
  $loan=$data['total']*4;
  $period=4;
  $rate=0.01;
  $amount=$loan+($loan*$rate*$period);
  $interest=($loan+($loan*$rate*$period))/($period*12);
  $dom=$con->prepare("INSERT INTO loans(nid,date_awarded,principal,loan_period,interest,amount,loan_status) VALUES(:nid,:date_awarded,:principal,:loan_period,:interest,:amount,:loan_status)");
$dom->execute(array(
  ":nid"=>$nid,
  ":date_awarded"=>$date,
  ":principal"=>$loan,
  ":loan_period"=>$period,
  ":interest"=>$interest,
  ":amount"=>$amount,
  ":loan_status"=>$status
  ));
$error="Loan Awarded successfully!";
}
else{
  echo "Member Not Found";
}
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
   <h2 class="text-center text-warning"><strong>Individual Loans</strong></h2>
   </div>
   <div class="container-fluid">


   <div class="row">
   <div class="col-sm-6 col-sm-offset-3">
   <div class="well">
   <div class="text-center">
   <h3 class="text-warning">Borrow individual Loans <?php echo $data['mee'];?></h3>
   <small>Fill in the form below with member data</small>
   </div>
   <hr>
   <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
      <div class="form-group">
  <?php
if (isset($error)) {
 echo '<div class="alert alert-dismissible alert-warning text-center">
  <button type="button" class="close" data-dismiss="alert">×</button>'.$error.'
</div>';

}
    ?>
    </div>
    <div class="form-group">
    <label for="full name">National ID No.</label>
    <input type="text" class="form-control" name="nid" placeholder="National ID No." required="">
  </div>
  <button type="submit" class="btn btn-info btn-block btn-lg" name="loan">Request Loan</button>
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