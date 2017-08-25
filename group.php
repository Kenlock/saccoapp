<?php
error_reporting(0);
include("database.php");
session_start();
 if($_SESSION['admin']==""){
    header("location:index.php");
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
   <h2 class="text-center text-warning"><strong>Membership</strong></h2>
   </div>
   <div class="container-fluid">


   <div class="row">
   <!--end first row-->
   <div class="col-sm-8 col-sm-offset-2">
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
    <input type="text" class="form-control" name="groupname" placeholder="Group Name" required>
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