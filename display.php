<?php
include 'connect.php';
if(isset($_POST['displaySend'])){
    $table = '<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Mobile</th>
        <th scope="col">Place</th>
        <th scope="col">Operations</th>
      </tr>
    </thead>';
    $sql="select * from `users`";
    $result=mysqli_query($con,$sql);
    $number=1;
    while($row=mysqli_fetch_assoc($result)){
        $id=$row['id'];
        $name=$row['name'];
        $email=$row['email'];
        $mobile=$row['mobile'];
        $place=$row['place'];
        $table.='<tr>
        <td scope="row">'.$number.'</td>
        <td>'.$name.'</td>
        <td>'.$email.'</td>
        <td>'.$mobile.'</td>
        <td>'.$place.'</td>
        <td> 
    <input type="button" value="Update" onclick="getDetails('.$id.')">
    <input type="button" value="Delete" onclick="DeleteUser('.$id.')">
  </td>
      </tr>';
      $number++;
    }
    $table.='</table>';
    echo $table;
}


?>
