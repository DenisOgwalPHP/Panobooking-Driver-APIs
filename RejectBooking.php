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
$reason=test_input($_POST['reason']);
include_once 'DB_Connect.php';
$sql1="UPDATE cart SET Confirmed='Rejected', ConfirmReason='".$reason."' where ProductName ='".$taxinos."' and OrderCode='".$ordercode."'";
$result1=mysqli_query($link,$sql1);

if ($result1) {
  $sql2 = "UPDATE ambulances SET Availability='Available' WHERE TaxiNo='" . $taxinos . "'";
  $result2 = mysqli_query($link, $sql2);

  $sql3 = "UPDATE carrentals SET Availability='Available' WHERE TaxiNo='" . $taxinos . "'";
  $result3 = mysqli_query($link, $sql3);

  $sql4 = "UPDATE airporttaxi SET Availability='Available' WHERE TaxiNo='" . $taxinos . "'";
  $result4 = mysqli_query($link, $sql4);

  echo "Success";
} else {
  echo "Failed";
}
?>
