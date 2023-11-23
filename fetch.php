
<?php

//fetch.php

include('connection.php');

$column = array('id', 'serial_no','brand','model','status','description','directorate','quantity','purchase_date');

$query = "SELECT * FROM item ";

if(isset($_POST['search']['value']))
{
 $query .= '
 WHERE serial_no LIKE "%'.$_POST['search']['value'].'%" 
 OR brand LIKE "%'.$_POST['search']['value'].'%" 
 OR model LIKE "%'.$_POST['search']['value'].'%" 
 OR status LIKE "%'.$_POST['search']['value'].'%" 
 OR description LIKE "%'.$_POST['search']['value'].'%" 
 OR directorate LIKE "%'.$_POST['search']['value'].'%" 
 OR quantity LIKE "%'.$_POST['search']['value'].'%"
 OR purchase_date LIKE "%'.$_POST['search']['value'].'%"
 ';
}

if(isset($_POST['order']))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY serial_no DESC ';
}

$query1 = '';

if($_POST['length'] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['serial_no'];
 $sub_array[] = $row['brand'];
 $sub_array[] = $row['model'];
 $sub_array[] = $row['status'];
 $sub_array[] = $row['description'];
 $sub_array[] = $row['directorate'];
 $sub_array[] = $row['quantity'];
 $sub_array[] = $row['purchase_date'];
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM item";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'    => intval($_POST['draw']),
 'recordsTotal'  => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'    => $data
);

echo json_encode($output);

?>
