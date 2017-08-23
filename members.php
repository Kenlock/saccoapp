<?php
error_reporting(0);
date_default_timezone_set('Africa/Nairobi');
include('database.php');
$query=$con->prepare("SELECT * FROM members ORDER BY id");
$query->execute();
$data=$query->fetchAll();
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
      <li><a href="index.php">REGISTRATION</a></li>
      <li class="active"><a href="members.php">MEMBERS</a></li>
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
   <h2 class="text-center text-warning"><strong>List of all Members</strong></h2>
   </div>
   <div class="container-fluid">
   <div class="row">
   <div class="col-sm-10 col-lg-offset-1">
   <div class="well">
   <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>National ID</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Membership Type</th>
                    </tr>
                    </thead>
                    <tbody>
                  <?php 
                  foreach ($data as $rows) {
                  ?>
                    <tr>
                        <td class="center"><?php echo $rows['fname'];?></td>
                        <td class="center"><?php echo $rows['nid'];?></td>
                        <td class="center"><?php echo $rows['address'];?></td>
                        <td class="center"><?php echo $rows['phone'];?></td>
                        <td class="center"><?php echo $rows['membership_type'];?></td>
                     
                    </tr>
                    
                    <?php 
                }
                  ?>
                   
                    </tbody>
                    <tfoot>
                   
                    </tfoot>
                    </table>
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

  </body>
</html>