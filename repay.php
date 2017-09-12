<?php
include("database.php");
session_start();
 if($_SESSION['admin']==""){
    header("location:index.php");
  }
?>
<?php
date_default_timezone_set('Africa/Nairobi');

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
   <h2 class="text-center text-warning"><strong>Repay Loans</strong></h2>
   </div>
   <div class="container">
   <div class="row">
     <div class="col-lg-12">
   <div class="well">
   <div class="text-center">
   <h3 class="text-warning">Repay Loans.</h3>
   <hr>
    </div>
   </div>
   <ul class="nav nav-tabs nav-justified">
  <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Repay individual loan</a></li>
  <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Repay group loan</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home">
  <h2 class="text-center">Individual Member Loans Repayment</h2>
     <?php 
     if(isset($_POST['personal'])){
      $nid=$_POST['nid'];
  $sql1=$con->prepare("SELECT l.id,l.nid,l.date_awarded,l.interest,l.amount,l.loan_period,l.loan_status,l.principal,m.nid FROM loans l INNER JOIN members m ON l.nid=m.nid WHERE l.nid=:id AND l.loan_status='active' GROUP BY l.date_awarded");
$sql1->execute(array(":id"=>$nid));
$dump1=$sql1->fetch();
$nid=$dump1['id'];
$premium1=$dump1['interest'];
$date=date('Y-m-d H:i:s');
$m1=$con->prepare("SELECT SUM(amount) AS total FROM loans WHERE loan_id='$nid'");
$m1->execute();
$nums1=$m1->fetch();
$total1=$nums1['total'];
$final1=($dump1['interest'])*($dump1['loan_period']*12);
if($final1==$total1){
  $status1='paid';
  $update1=$con->prepare("UPDATE loans SET status='$status1' WHERE id='$nid'");
  $update1->execute();
  $error="You do not have an active loan";
}
else{
$insert1=$con->prepare("INSERT INTO loan_repayments(loan_id,amount,date_paid) VALUES(:id,:amount,:date_paid)");
$insert1->execute(array(':id'=>$nid,':amount'=>$premium1,':date_paid'=>$date));
$error="Monthly fees paid successfully!";

}
}
 ?>
  <hr>
     <div class="row">
  <div class="col-sm-8 col-sm-offset-2">
   <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
      <div class="form-group">
       <?php
if (isset($error)) {
 echo '<div class="alert alert-dismissible alert-success text-center">
  <button type="button" class="close" data-dismiss="alert">×</button>'.$error.'
</div>';

}
    ?>
    </div>
    <div class="form-group">
    <label for="full name">National ID No.</label>
    <input type="text" class="form-control" name="nid" placeholder="National ID No." required="">
  </div>
  <button type="submit" class="btn btn-primary btn-block btn-lg" name="personal">Pay Loan</button>
</form>
</div>
</div>
  </div>
  <div class="tab-pane fade" id="profile">
  <h2 class="text-center">Group Loans Repayment</h2>
  <hr>
   <?php 
     if(isset($_POST['group_repay'])){
      $id=$_POST['groupname'];
  $sql=$con->prepare("SELECT l.id,l.groupname,l.date_awarded,l.interest,l.amount,l.loan_period,l.loan_status,l.principal,g.groupname FROM loans l INNER JOIN groups g ON l.groupname=g.groupname WHERE l.groupname=:id AND l.loan_status='active' GROUP BY l.date_awarded");
$sql->execute(array(":id"=>$id));
$dump=$sql->fetch();
$id=$dump['id'];
$premium=$dump['interest'];
$date=date('Y-m-d H:i:s');
$m=$con->prepare("SELECT SUM(amount) AS total FROM loans WHERE loan_id='$id'");
$m->execute();
$nums=$m->fetch();
$total=$nums['total'];
$final=($dump['interest'])*($dump['loan_period']*12);
if($final==$total){
  $status='paid';
  $update=$con->prepare("UPDATE loans SET status='$status' WHERE id='$id'");
  $update->execute();
  $msg="You do not have an active loan";
}
else{
$insert=$con->prepare("INSERT INTO loan_repayments(loan_id,amount,date_paid) VALUES(:id,:amount,:date_paid)");
$insert->execute(array(':id'=>$id,':amount'=>$premium,':date_paid'=>$date));
$msg="Monthly fees paid successfully!";
}
}
 ?>
  <div class="row">
  <div class="col-sm-8 col-sm-offset-2">
   <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
      <div class="form-group">
       <?php
if (isset($msg)) {
 echo '<div class="alert alert-dismissible alert-success text-center">
  <button type="button" class="close" data-dismiss="alert">×</button>'.$msg.'
</div>';

}
    ?>
    </div>
     <div class="form-group">
    <label for="full name">Group Name</label>
    <select class="form-control" name="groupname" required="" autofocus="">
    <option value="">------Select Group ------</option>
    <?php
$dog=$con->prepare("SELECT DISTINCT(groupname) AS name FROM groups");
$dog->execute();
$cat=$dog->fetchAll();
     foreach($cat as $val){?>
      <option value="<?php echo $val['name']?>"><?php echo $val['name']?></option>
      <?php }?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary btn-block btn-lg" name="group_repay">Pay Loan</button>
</form>
</div>
</div>
  </div>
</div>
  
</div>
   </div>
   <!--end first row-->
   <!--end second row-->
   </div><!--end row-->
   </div><!--end container-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
         <script type="text/javascript">
        var hash = window.location.hash;
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');



  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
  });
    </script>


  </body>
</html>