<?php
include("database.php");
session_start();
 if($_SESSION['admin']==""){
    header("location:index.php");
  }
?>
<?php
date_default_timezone_set('Africa/Nairobi');
$sql=$con->prepare("SELECT l.id,l.nid,l.groupname,l.interest,l.principal,r.loan_id,r.amount,r.date_paid FROM loans l JOIN loan_repayments r ON l.id=r.loan_id");
$sql->execute();
$data=$sql->fetchAll();
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
   <h2 class="text-center text-warning"><strong>Monthly Repayments</strong></h2>
   </div>
   <div class="container-fluid">
   <div class="row">
     <div class="col-lg-10 col-sm-offset-1">
   <div class="well">
   <div class="text-center">
   <h3 class="text-warning"></h3>
   <small>Monthly loan repayments.</small>
   </div>
   <hr>
    <div class="table-responsive">
                    <table class="table table-striped table-condensed  dataTables-example" >
                    <thead>
                    <tr>
                        <th>National ID/Group Name</th>
                        <th>Principal Amount</th>
                        <th>Monthly Premiums</th>
                        <th>Amount Paid</th>
                        <th>Date Paid</th>
                    </tr>
                    </thead>
                    <tbody>
                  <?php 
                  foreach ($data as $nums) {
                  ?>
                    <tr>
                        <td class="center"><?php 
                        if(isset($nums['nid'])){
                        	echo $nums['nid'];
                        }
                        else{
                        	echo $nums['groupname'];
                        }
                       ?></td>
                        <td class="center"><?php echo round($nums['principal'],1);?></td>
                        <td class="center"><?php echo round($nums['interest'],1);?></td>
                        <td class="center"><?php echo round($nums['amount'],1);?></td>
                        <td class="center"><?php echo $nums['date_paid'];?></td>
                     
                     
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