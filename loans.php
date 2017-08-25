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
    <link href="css/datatables.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
<?php include("header.php");?>
   <div class="jumbotron" style="margin-top: -33px;height: 100px;padding-top: 10px;">
   <h2 class="text-center text-warning"><strong>Active Borrowed Loans</strong></h2>
   </div>
   <div class="container">
   <div class="row">
     <div class="col-lg-12">
   <div class="well">
   <div class="text-center">
   <h3 class="text-warning">Active Loans.</h3>
   <hr>
   </div>
   <ul class="nav nav-tabs nav-justified">
  <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Member Loans</a></li>
  <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Group Loans</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home">
  <hr>
    <div class="table-responsive">
                    <table class="table table-striped dataTables-example" >
                    <thead>
                    <tr>
                        <th>National ID</th>
                        <th>Name</th>
                        <th>Date Awarded Loan</th>
                        <th>Principal Amount</th>
                        <th>Amount</th>
                        <th>Monthly Premiums</th>
                        <th>Loan Period</th>
                        <th>Total Interest Expected</th>
                        <th>Loan Status</th>
                         <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                  <?php 
                  $sql=$con->prepare("SELECT l.id,l.nid,l.date_awarded,l.interest,l.amount,l.loan_period,l.loan_status,l.principal,m.nid,m.fname,m.phone,m.membership_type FROM loans l INNER JOIN members m ON l.nid=m.nid WHERE l.loan_status='active' ");
$sql->execute();
$dump=$sql->fetchAll();
                  foreach ($dump as $nums) {
                  ?>
                    <tr>
                        <td class="center"><?php echo $nums['nid'];?></td>
                        <td class="center"><?php echo $nums['fname'];?></td>
                        <td class="center"><?php echo date('F d, Y | H:i:s', strtotime($nums['date_awarded']));?></td>
                        <td class="center"><?php echo $nums['principal'];?></td>
                        <td class="center"><?php echo round($nums['amount'],1);?></td>
                        <td class="center"><?php echo round($nums['interest'],1);?></td>
                        <td class="center"><?php echo $nums['loan_period']*12;?> months</td>
                        <td class="center"><?php echo round($nums['amount']-$nums['principal'],1);?></td>
                        <td class="center"><?php echo $nums['loan_status'];?></td>
                        <td class="center"><a href="" class="btn btn-info btn-block">Clear Loan</a></td>
                     
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
  <div class="tab-pane fade" id="profile">
  <hr>
     <div class="table-responsive">
                    <table class="table table-striped dataTables-example" >
                    <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Date Awarded Loan</th>
                        <th>Principal Amount</th>
                        <th>Amount</th>
                        <th>Monthly Premiums</th>
                        <th>Loan Period</th>
                        <th>Total Interest Expected</th>
                        <th>Loan Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                  <?php 
                  $sql=$con->prepare("SELECT l.id,l.groupname,l.date_awarded,l.interest,l.amount,l.loan_period,l.loan_status,l.principal,g.groupname FROM loans l INNER JOIN groups g ON l.groupname=g.groupname WHERE l.loan_status='active' GROUP BY l.date_awarded");
$sql->execute();
$dump=$sql->fetchAll();
                  foreach ($dump as $nums) {
                  ?>
                    <tr>
                        <td class="center"><?php echo $nums['groupname'];?></td>
                        <td class="center"><?php echo date('F d, Y | H:i:s', strtotime($nums['date_awarded']));?></td>
                        <td class="center"><?php echo $nums['principal'];?></td>
                        <td class="center"><?php echo round($nums['amount'],1);?></td>
                        <td class="center"><?php echo round($nums['interest'],1);?></td>
                        <td class="center"><?php echo $nums['loan_period']*12;?> months</td>
                        <td class="center"><?php echo round($nums['amount']-$nums['principal'],1);?></td>
                        <td class="center"><?php echo $nums['loan_status'];?></td>
                        <td class="center"><a href="" class="btn btn-info btn-block">Clear Loan</a></td>
                     
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