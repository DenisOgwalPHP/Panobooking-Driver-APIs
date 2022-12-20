<?php
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
$registrationnumbers=test_input($_POST['registrationnumbers']);
$pickers=test_input($_POST['pickers']);
$password=test_input($_POST['password']);
$hashed_password = md5($password);

$newpassword=test_input($_POST['newpassword']);
$hashed_newpassword = md5($newpassword);
include_once 'DB_Connect.php';
if($pickers=="Airport Taxi"){
$sql1="SELECT TaxiNo FROM airporttaxi where  TaxiNo ='".$registrationnumbers."' and Password='".$hashed_password."'";
$result1=mysqli_query($link,$sql1);
  if ($result1) {
    $sql = "UPDATE airporttaxi SET Password='$hashed_newpassword' WHERE TaxiNo='$registrationnumbers'";
    $result = mysqli_query($link, $sql);
    if ($result) {
      echo "Success";
    } else {
      echo "Failed";
    }
  } else {
    echo "Wrong Old Password";
  }
} else if ($pickers == "Rental Car") {
  $sql1 = "SELECT TaxiNo FROM carrentals where  TaxiNo ='" . $registrationnumbers . "' and Password='" . $hashed_password . "'";
  $result1 = mysqli_query($link, $sql1);
  if ($result1) {
    $sql = "UPDATE carrentals SET Password='$hashed_newpassword' WHERE TaxiNo='$registrationnumbers'";
    $result = mysqli_query($link, $sql);
    if ($result) {
      echo "Success";
    } else {
      echo "Failed";
    }
  } else {
    echo "Wrong Old Password";

  }
}
?>
