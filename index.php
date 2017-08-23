<?php
error_reporting(0);
date_default_timezone_set('Africa/Nairobi');
include('database.php');
if(isset($_POST['individual'])){
  $fname=htmlentities($_POST['fname']);
  $nid=htmlentities($_POST['nid']);
  $address=htmlentities($_POST['address']);
  $phone=htmlentities($_POST['phone']);
  $type='individual';
$sql=$con->prepare("INSERT INTO members(fname,nid,address,phone,membership_type) VALUES(:fname,:nid,:address,:phone,:type)");
$sql->execute(array(":fname"=>$fname,":nid"=>$nid,":address"=>$address,":phone"=>$phone,"type"=>$type));
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
      <li class="active"><a href="index.php">REGISTRATION</a></li>
      <li ><a href="members.php">MEMBERS</a></li>
      <li><a href="shares.php">SHARES</a></li>

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
   <h2 class="text-center text-warning"><strong>Membership</strong></h2>
   </div>
   <div class="container-fluid">


   <div class="row">
   <div class="col-sm-4">
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
   <div class="col-sm-8">
   <div class="panel panel-body">
   <div class="text-center">
   <h3 class="text-warning">Group Membership</h3>
   <small>Fill in the form below to register a group and its members</small>
   </div>
   <hr>
   <form id="add_me" action="register_group.php" method="post">
  <div class="form-group">
       <div id="result"></div>
    </div>
  <div class="form-group">
    <label for="full name">Group Name</label>
    <input type="text" class="form-control" name="groupname" placeholder="Group Name" required="">
  </div>
    <div class="form-group">
  <label for="full name">Member Details</label>
 <table id="dynamic" class="table">
   <tr>
   <td><input type="text" name="fname[]" class="form-control" placeholder="Full Name" required></td>
   <td><input type="text" name="nid[]" class="form-control" placeholder="National ID" required></td>
   <td><input type="text" name="address[]" class="form-control" placeholder="Address" required></td>
   <td><input type="text" name="phone[]" class="form-control" placeholder="Phone Number" required></td>
   <td><button type="button" name="add" class="btn btn-success" id="add_input"><span class="glyphicon glyphicon-plus"></span> Member</button></td>
   </tr>
 </table>
 </div>
 <div class="form-group">
  <button type="submit" class="btn btn-default" name="submit" id="submit">Save Details</button>
  </div>
</form>
</div>
   </div>
   <!--end second row-->
   </div><!--end row-->
   </div><!--end container-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/datatables.min.js"></script>
 <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

    </script>

    <script type="text/javascript">
      $(document).ready(function(){
var i=1;
$('#add_input').click(function(){
  i++;
  $('#dynamic').append('<tr id="row'+i+'"><td><input type="text" name="fname[]" class="form-control" placeholder="Full Name" required></td><td><input type="text" name="nid[]" class="form-control" placeholder="National ID" required></td><td><input type="text" name="address[]" class="form-control" placeholder="Address" required></td><td><input type="text" name="phone[]" class="form-control" placeholder="Phone Number" required></td><td><button type="button" name="remove" class="btn btn-danger btn_remove" id="'+i+'"><span class="glyphicon glyphicon-remove"></span> Member</button></td></tr>');
});
$(document).on('click','.btn_remove',function(){
  var button_id=$(this).attr("id");
  $('#row'+button_id+'').remove();
});
$('#submit').click(function(){
   $.post($("#add_me").attr("action"),
   $("#add_me :input").serializeArray(),
   function(info){
    $("#result").empty();
  //adding a 'x' button if the user wants to close manually
 $("#result").html('<div class="alert alert-success"><button type="button" class="close">×</button>'+info+'</div>');

 //timing the alert box to close after 5 seconds
 window.setTimeout(function () {
     $(".alert").fadeTo(500, 0).slideUp(500, function () {
         $(this).remove();
     });
 }, 5000);

 //Adding a click event to the 'x' button to close immediately
 $('.alert .close').on("click", function (e) {
     $(this).parent().fadeTo(500, 0).slideUp(500);
 });
 clear();
   });
   $("#add_me").submit(function(){
    return false;
   });
});
function clear(){
  $("#add_me :input").each(function(){
    $(this).val("");
  });
}

      });

    </script>
  </body>
</html>