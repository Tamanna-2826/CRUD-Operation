<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
    <label for="completename">Name</label>
    <input type="text" class="form-control" id="completename" placeholder="Enter Your Name">
  </div>
  <div class="form-group">
    <label for="completeemail">Email</label>
    <input type="email" class="form-control" id="compleemail" placeholder="Enter Your Email">
  </div>
  <div class="form-group">
    <label for="completemobile">Mobile No</label>
    <input type="text" class="form-control" id="completemobile" placeholder="Enter Your Mobile No">
  </div>
  <div class="form-group">
    <label for="completeplace">Place</label>
    <input type="text" class="form-control" id="completeplace" placeholder="Enter Your Place">
  </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn" onclick="adduser()">Add </button>
        <button type="button" class="btn" data-dismiss="modal">Close</button>
 
    </div>
    </div>
  </div>
</div>
<!-- UPDATE MODAL -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
    <label for="updatename">Name</label>
    <input type="text" class="form-control" id="updatename" placeholder="Enter Your Name">
  </div>
  <div class="form-group">
    <label for="updateemail">Email</label>
    <input type="email" class="form-control" id="updateemail" placeholder="Enter Your Email">
  </div>
  <div class="form-group">
    <label for="updatemobile">Mobile No</label>
    <input type="text" class="form-control" id="updatemobile" placeholder="Enter Your Mobile No">
  </div>
  <div class="form-group">
    <label for="updateplace">Place</label>
    <input type="text" class="form-control" id="updateplace" placeholder="Enter Your Place">
  </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn" onclick="updateDetails()">Update </button>
        <button type="button" class="btn" data-dismiss="modal">Close</button>
    <input type="hidden" id="hiddendata"> 
    </div>
    </div>
  </div>
</div>
    <div class="container">
       <h1> PHP CRUD Operation </h1>
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completeModal">
  Add New Users
</button>   
<div id="displaydataTable">
    
</div>
 </div>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        displayData();
    }); // Data will not get venishes after page refresh
    //Display Func
    function displayData()
    {
        var displayData="true"; 
        $.ajax({
            url:"display.php",
            type:'post',
            data:{
                displaySend:displayData
            },
            success:function(data,status){
                $('#displaydataTable').html(data);
            }
        });
    }
    function adduser()
    {
        var nameAdd=$('#completename').val(); //$ means jquery
        var emailAdd=$('#completeemail').val();
        var mobileAdd=$('#completemobile').val();
        var placeAdd=$('#completeplace').val();

        $.ajax({
            url:"insert.php",
            type:'post',
            data:{
                nameSend:nameAdd,
                emailSend:emailAdd,
                mobileSend:mobileAdd,
                placeSend:placeAdd,
            },  
        success:function(data,status){
            //functon to display data
            //  console.log(status);
            $('#completeModal').modal('hide');

            displayData();

        }
       });
    }
    // Function for delete

    function DeleteUser(deleteid)
    {
        $.ajax({
            url:"delete.php",
            type:'post',
            data:{
                dalatasend:deleteid
            },
            success:function(data,status){
                displayData();
            }
        });
    }
    //update function
    function getDetails(updateid)
    {
        $('#hiddendata').val(updateid);
        $.post("update.php",{updateid:updateid},function(data,status)
        {
            var userid=JSON.parse(data);
            $('updatename').val(userid.name);
            $('updateemail').val(userid.email);
            $('updatemobile').val(userid.mobile);
            $('updateplace').val(userid.place);

        });
        $('#updateModal').modal("show");
    }
    function updateDetails()
    {
        var updatename=$('#updatename').val();
        var updateemail=$('#updateemail').val();
        var updatemobile=$('#updatemobile').val();
        var updateplace=$('#updateplace').val();
        var hiddendata=$('#hiddendata').val();
        $.post("update.php",{
            updatename:updatename,
            updateemail:updateemail,
            updatemobile:updatemobile,
            updateplace:updateplace
        },function(data,status){
            $('#updateModal').modal('hide');
            displayData();
        });
    }

    </script>

</body>
</html>