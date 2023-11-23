<?php 
include('connection.php');
$serial_no = $_POST['serial_no'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$status = $_POST['status'];
$description = $_POST['description'];
$directorate = $_POST['directorate'];
$quantity = $_POST['quantity'];
$purchase_date = $_POST['purchase_date'];


$sql = "INSERT INTO `item` (`serial_no`,`brand`,`model`,`status`,`description`,`directorate`,`quantity`,`purchase_date`)  values('$serial_no','$brand','$model','$status','$description','$directorate','$quantity','$purchase_date')";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    // $data = array(
    //     'status'=>'true',
       
    // );

    // echo json_encode($data);
    header('location:index.php');
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>