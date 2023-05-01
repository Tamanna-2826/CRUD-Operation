<?php
include 'connect.php';

if(isset($_POST['updateid'])){
    $user_id=$_POST['updateid'];

    $sql="select * from `users` where id=$user_id";
    $result=mysqli_query($con,$sql);
    $response=arrar();
    while($row=mysqli_fetch_assoc($result)){
        $response=$row;
    }
    echo json_encode($response);
}
else{
    $response['status']=200;
    $response['message']="Data Not Found ";
}
// Update query
if(isset($_POST['hiddendata'])){
    $uniqueid=$_POST['hiddendata'];
    $name=$_POST['updatename'];
    $email=$_POST['updateemail'];
    $mobile=$_POST['updatemobile'];
    $place=$_POST['updateplace'];
    $sql="update `users` set name='$name',email='$email',mobile='$mobile',place='$place' where id=$uniqueid";
$result=mysqli_query($con,$sql);
}

?>