<?php 
	include 'connect.php';
	header('Content-type: application/json');
	$mat_name=$_POST['mat_name'];
	
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }

 $stmt = $conn->prepare("SELECT mat_name,mat_type,klinid,qty_perc from rawmaterial where mat_name='$mat_name'");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($mat_name,$mat_type,$klinid,$qty_perc);
 $products = array(); 

 //traversing through all the result 
 while($stmt->fetch()){
  $temp = array();
 $temp['mat_name'] = $mat_name; 
 $temp['mat_type'] = $mat_type; 
 $temp['klinid'] = $klinid; 
 $temp['qty_perc'] = $qty_perc; 

 array_push($products, $temp);
 }
 
 //displaying the result in json format 
  header('Content-type:application/json;charset=utf-8');

 echo json_encode($products);
 mysqli_close();
 ?>