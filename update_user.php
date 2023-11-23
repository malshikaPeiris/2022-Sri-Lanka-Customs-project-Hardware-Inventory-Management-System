<?php 
include('connection.php');

$id = $_POST['id'];
$serial_no = $_POST['serial_no'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$status = $_POST['status'];
$description = $_POST['description'];
$directorate = $_POST['directorate'];
$quantity = $_POST['quantity'];
$purchase_date = $_POST['purchase_date'];

$sql = "UPDATE `item` set id=$id,serial_no='$serial_no', brand='$brand',model='$model',status='$status',description='$description',directorate='$directorate',quantity='$quantity',purchase_date='$purchase_date'
where id=$id ";
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