<?php include('connection.php');

$output= array();
$sql = "SELECT * FROM item";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'serial_no',
	2 => 'brand',
	3 => 'model',
	4 => 'status',
	5 => 'description',
	6 => 'directorate',
	7 => 'quantity',
	8 => 'purchase_date',
	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE serial_no like '%".$search_value."%'";
	$sql .= " OR brand like '%".$search_value."%'";
	$sql .= " OR model like '%".$search_value."%'";
	$sql .= " OR status like '%".$search_value."%'";
	$sql .= " OR description like '%".$search_value."%'";
	$sql .= " OR directorate like '%".$search_value."%'";
	$sql .= " OR quantity like '%".$search_value."%'";
	$sql .= " OR purchase_date like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['serial_no'];
	$sub_array[] = $row['brand'];
	$sub_array[] = $row['model'];
	$sub_array[] = $row['status'];
	$sub_array[] = $row['description'];
	$sub_array[] = $row['directorate'];
	$sub_array[] = $row['quantity'];
	$sub_array[] = $row['purchase_date'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
