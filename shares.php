<?php
error_reporting(0);
date_default_timezone_set('Africa/Nairobi');
include('database.php');
if(isset($_POST['share'])){
  $nid=htmlentities($_POST['nid']);
  $amount=htmlentities($_POST['amount']);
$query=$con->prepare("SELECT * FROM members WHERE nid=:nid");
$query->execute(array(":nid"=>$nid));
$data=$query->fetchAll();
var_dump($data);

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
  </head>
  <body>
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">MWANZO BARAKA INFORMATION SYSTEM</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <li><a href="index.php">REGISTRATION</a></li>
      <li><a href="members.php">MEMBERS</a></li>
      <li class="active"><a href="shares.php">SHARES</a></li>

            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">LOANS<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">BORROW LOAN</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">REPAY LOAN</a></li>
          </ul>
        </li>
      </ul>
  
      <ul class="nav navbar-nav navbar-right">
       <li><a href="#">INCOME</a></li>
       <li><a href="#">PENALTIES</a></li>
       
      
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
   <div class="jumbotron" style="margin-top: -33px;height: 100px;padding-top: 10px;">
   <h2 class="text-center text-warning"><strong>Monthly Contributions</strong></h2>
   </div>
   <div class="container">
   <div class="row">
   <div class="col-sm-8 col-lg-offset-2">
   <div class="well">
   <div class="text-center">
   <h3 class="text-warning"></h3>
   <small>Fill in the form below with your personal data</small>
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
    <label for="full name">Full Name</label>
    <input type="text" class="form-control" name="fname" placeholder="Full Name" required="">
  </div>
    <div class="form-group">
    <label for="full name">National ID No. <star class="text-danger">*</star></label>
    <input type="text" class="form-control" name="nid" placeholder="National ID No." required="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Amount to be contributed <star class="text-danger">*</star></label>
    <input type="text" class="form-control" name="amount" placeholder="Amount" required="">
  </div>
  <button type="submit" class="btn btn-success" name="share">Submit Details</button>
</form>
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

  </body>
</html>