<?php
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
include_once 'DB_Connect.php';
$fullnames = test_input($_POST['fullnames']);
$emails=test_input($_POST['emails']);
$phonenumbers=test_input($_POST['phonenumbers']);
$dobs=test_input($_POST['dobs']);
$registrationnumbers=test_input($_POST['registrationnumbers']);
$carspecificationss=test_input($_POST['carspecificationss']);
$parkinglocations=test_input($_POST['parkinglocations']);
$descriptions=test_input($_POST['descriptions']);
$pickers=test_input($_POST['pickers']);
$dob = strtotime(str_replace("/","-",$dobs));       
$tdate = time();
$age = 0;
while( $tdate > $dob = strtotime('+1 year', $dob))
{
    ++$age;
}
if ($pickers == "Airport Taxi") {
  $sql = "UPDATE airporttaxi SET DriverName='$fullnames',DriverAge='$age',CarSpec='$carspecificationss',Repayments='$descriptions',CurrentLocation='$parkinglocations',EmailAddress='$emails',TelephoneNumber='$phonenumbers',DOB='$dobs' WHERE TaxiNo='$registrationnumbers'";
  $result = mysqli_query($link, $sql);
  if ($result) {
    echo "Success";
  } else {
    echo "Failed";
  }
} else if ($pickers == "Rental Car") {
  $sql = "UPDATE carrentals SET DriverName='$fullnames',DriverAge='$age',CarSpec='$carspecificationss',Repayments='$descriptions',CurrentLocation='$parkinglocations',EmailAddress='$emails',TelephoneNumber='$phonenumbers',DOB='$dobs' WHERE TaxiNo='$registrationnumbers'";
  $result = mysqli_query($link, $sql);
  if ($result) {
    echo "Success";
  } else {
    echo "Failed";
  }
}
?>
