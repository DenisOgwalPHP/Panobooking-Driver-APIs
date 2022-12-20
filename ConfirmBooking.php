<?php
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}	
$ordercode=test_input($_POST['ordercode']);
$taxinos=test_input($_POST['taxinos']);
include_once 'DB_Connect.php';
$sql1="UPDATE cart SET Confirmed='Confirmed', ConfirmReason='I will be Available' where ProductName ='".$taxinos."' and OrderCode='".$ordercode."'";
$result1=mysqli_query($link,$sql1);

if ($result1) {
  echo "Success";
} else {
  echo "Failed";
}
?>
