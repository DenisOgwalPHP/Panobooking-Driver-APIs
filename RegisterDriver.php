<?php

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}	
$fullnames = test_input($_POST['fullnames']);
$password=test_input($_POST['password']);
$emails=test_input($_POST['emails']);
$phonenumbers=test_input($_POST['phonenumbers']);
$dobs=test_input($_POST['dobs']);
$registrationnumbers=test_input($_POST['registrationnumbers']);
$carspecificationss=test_input($_POST['carspecificationss']);
$parkinglocations=test_input($_POST['parkinglocations']);
$descriptions=test_input($_POST['descriptions']);
$pickers=test_input($_POST['pickers']);
$hashed_password = md5($password);
$dob = strtotime(str_replace("/","-",$dobs));       
$tdate = time();
$age = 0;
while( $tdate > $dob = strtotime('+1 year', $dob))
{
    ++$age;
}
if ($pickers == "Airport Taxi") {
        include_once 'DB_Connect.php';
        $sql1 = "SELECT TaxiNo FROM airporttaxi where  TaxiNo ='" . $registrationnumbers . "'";
        $result1 = mysqli_query($link, $sql1);
        while ($row = mysqli_fetch_array($result1)) {
                $rowresult = $row['TaxiNo'];
        }
        if ($rowresult != $registrationnumbers) {
                $sql = "INSERT into airporttaxi(DriverName,DriverAge,TaxiNo,CarSpec,Repayments,CurrentLocation,EmailAddress,TelephoneNumber,DOB,Password)VALUES('$fullnames','$age','$registrationnumbers','$carspecificationss','$descriptions','$parkinglocations','$emails','$phonenumbers','$dobs','$hashed_password')";
                $result = mysqli_query($link, $sql);
                if ($result) {
                        echo "Success";
                } else {
                        echo "Failed";
                }
        } else {
                echo "Email already Exists";

        }
} else if ($pickers == "Rental Car") {
        include_once 'DB_Connect.php';
        $sql1 = "SELECT TaxiNo FROM carrentals where  TaxiNo ='" . $registrationnumbers . "'";
        $result1 = mysqli_query($link, $sql1);
        while ($row = mysqli_fetch_array($result1)) {
                $rowresult = $row['TaxiNo'];
        }
        if ($rowresult != $registrationnumbers) {
                $sql = "INSERT into carrentals(DriverName,DriverAge,TaxiNo,CarSpec,Repayments,CurrentLocation,EmailAddress,TelephoneNumber,DOB,Password)VALUES('$fullnames','$age','$registrationnumbers','$carspecificationss','$descriptions','$parkinglocations','$emails','$phonenumbers','$dobs','$hashed_password')";
                $result = mysqli_query($link, $sql);
                if ($result) {
                        echo "Success";
                } else {
                        echo "Failed";
                }
        } else {
                echo "Email already Exists";

        }
} else if ($pickers == "Ambulance") {
        include_once 'DB_Connect.php';
        $sql1 = "SELECT TaxiNo FROM ambulances where  TaxiNo ='" . $registrationnumbers . "'";
        $result1 = mysqli_query($link, $sql1);
        while ($row = mysqli_fetch_array($result1)) {
                $rowresult = $row['TaxiNo'];
        }
        if ($rowresult != $registrationnumbers) {
                $sql = "INSERT into ambulances(DriverName,DriverAge,TaxiNo,CarSpec,Repayments,CurrentLocation,EmailAddress,TelephoneNumber,DOB,Password)VALUES('$fullnames','$age','$registrationnumbers','$carspecificationss','$descriptions','$parkinglocations','$emails','$phonenumbers','$dobs','$hashed_password')";
                $result = mysqli_query($link, $sql);
                if ($result) {
                        echo "Success";
                } else {
                        echo "Failed";
                }
        } else {
                echo "Email already Exists";

        }
}
?>
