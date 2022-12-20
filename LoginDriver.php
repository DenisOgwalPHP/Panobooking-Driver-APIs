<?php
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}	
$passwords=test_input($_POST['passwords']);
$taxinos=test_input($_POST['taxinos']);
$hashed_password = md5($passwords);

include_once 'DB_Connect.php';
$sql1="SELECT DriverName,TaxiNo FROM carrentals where TaxiNo ='".$taxinos."' and Password='".$hashed_password."' and Approved='Approved'";
$result1=mysqli_query($link,$sql1);
if (mysqli_num_rows($result1) == 1) {
	while ($row = mysqli_fetch_array($result1)) {
		$rowresult1 = $row['DriverName'];
		$rowresult2 = $row['TaxiNo'];
		$response = array();
		if ($result1) {
			$messages = 'Correct Info';
			$response['error'] = $messages;
			$response['DriverName'] = $rowresult1;
			$response['TaxiNo'] = $rowresult2;
			echo json_encode($response);
		} else {
			$messages = 'Something Unexpected Happened, Try Again Later';
			$response['error'] = $messages;
			echo json_encode($response);
		}
	}
} else if (mysqli_num_rows($result1) == 0) {
	$sql2 = "SELECT DriverName,TaxiNo FROM airporttaxi where TaxiNo ='" . $taxinos . "' and Password='" . $hashed_password . "' and Approved='Approved'";
	$result2 = mysqli_query($link, $sql2);
	if (mysqli_num_rows($result2) == 1) {
		while ($row = mysqli_fetch_array($result2)) {
			$rowresult1 = $row['DriverName'];
			$rowresult2 = $row['TaxiNo'];
			$response = array();
			if ($result2) {
				$messages = 'Correct Info';
				$response['error'] = $messages;
				$response['DriverName'] = $rowresult1;
				$response['TaxiNo'] = $rowresult2;
				echo json_encode($response);
			} else {
				$messages = 'Something Unexpected Happened, Try Again Later';
				$response['error'] = $messages;
				echo json_encode($response);
			}
		}
	} else if (mysqli_num_rows($result2) == 0) {
		$sql3 = "SELECT DriverName,TaxiNo FROM ambulances where TaxiNo ='" . $taxinos . "' and Password='" . $hashed_password . "' and Approved='Approved'";
		$result3 = mysqli_query($link, $sql3);
		if (mysqli_num_rows($result3) == 1) {
			while ($row = mysqli_fetch_array($result3)) {
				$rowresult1 = $row['DriverName'];
				$rowresult2 = $row['TaxiNo'];
				$response = array();
				if ($result3) {
					$messages = 'Correct Info';
					$response['error'] = $messages;
					$response['DriverName'] = $rowresult1;
					$response['TaxiNo'] = $rowresult2;
					echo json_encode($response);
				} else {
					$messages = 'Something Unexpected Happened, Try Again Later';
					$response['error'] = $messages;
					echo json_encode($response);
				}
			}
		} else {
			$messages = 'Password User Name Do not Match any Approved Account';
			$response['error'] = $messages;
			echo json_encode($response);
		}
	}
} else {
	$messages = 'Account Logins Provided are Wrong';
	$response['error'] = $messages;
	echo json_encode($response);
}
error_log (json_encode($response));
?>
