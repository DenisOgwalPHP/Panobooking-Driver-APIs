<?php
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
$taxinos=test_input($_POST['taxinos']);
include_once 'DB_Connect.php';
$sql1="SELECT DriverName,CarSpec,Repayments,CurrentLocation,EmailAddress,TelephoneNumber,DOB,PhotoUri FROM carrentals where TaxiNo ='".$taxinos."' and Approved='Approved'";
$result1=mysqli_query($link,$sql1);
if (mysqli_num_rows($result1) == 1) {
	while ($row = mysqli_fetch_array($result1)) {
		$rowresult1 = $row['DriverName'];
		$rowresult2 = $row['CarSpec'];
		$rowresult3 = $row['Repayments'];
		$rowresult4 = $row['CurrentLocation'];
		$rowresult5 = $row['EmailAddress'];
		$rowresult6 = $row['TelephoneNumber'];
		$rowresult7 = $row['DOB'];
		$rowresult8 = "Rental Car";
		$rowresult9 = $row['PhotoUri'];
		$response = array();
		if ($result1) {
			$messages = 'Correct Info';
			$response['error'] = $messages;
			$response['DriverName'] = $rowresult1;
			$response['CarSpec'] = $rowresult2;
			$response['Repayments'] = $rowresult3;
			$response['CurrentLocation'] = $rowresult4;
			$response['EmailAddress'] = $rowresult5;
			$response['TelephoneNumber'] = $rowresult6;
			$response['DOB'] = $rowresult7;
			$response['CarType'] = $rowresult8;
			$response['PhotoUri'] = $rowresult9;
			echo json_encode($response);
		} else {
			$messages = 'Something Un Expected Happened, Try Again Later';
			$response['error'] = $messages;
			echo json_encode($response);
		}
	}
} else if (mysqli_num_rows($result1) == 0) {
	include_once 'DB_Connect.php';
	$sql1 = "SELECT DriverName,CarSpec,Repayments,CurrentLocation,EmailAddress,TelephoneNumber,Password,PhotoUri,DOB FROM airporttaxi where TaxiNo ='" . $taxinos . "' and Approved='Approved'";
	$result1 = mysqli_query($link, $sql1);
	if (mysqli_num_rows($result1) == 1) {
		while ($row = mysqli_fetch_array($result1)) {
			$rowresult1 = $row['DriverName'];
			$rowresult2 = $row['CarSpec'];
			$rowresult3 = $row['Repayments'];
			$rowresult4 = $row['CurrentLocation'];
			$rowresult5 = $row['EmailAddress'];
			$rowresult6 = $row['TelephoneNumber'];
			$rowresult7 = $row['DOB'];
			$rowresult8 = "Airport Taxi";
			$rowresult9 = $row['PhotoUri'];
			;
			$response = array();
			if ($result1) {
				$messages = 'Correct Info';
				$response['error'] = $messages;
				$response['DriverName'] = $rowresult1;
				$response['CarSpec'] = $rowresult2;
				$response['Repayments'] = $rowresult3;
				$response['CurrentLocation'] = $rowresult4;
				$response['EmailAddress'] = $rowresult5;
				$response['TelephoneNumber'] = $rowresult6;
				$response['DOB'] = $rowresult7;
				$response['CarType'] = $rowresult8;
				$response['PhotoUri'] = $rowresult9;
				echo json_encode($response);
			} else {
				$messages = 'Something Un Expected Happened, Try Again Later';
				$response['error'] = $messages;
				echo json_encode($response);
			}
		}
	} else if (mysqli_num_rows($result1) == 0) {
		include_once 'DB_Connect.php';
		$sql1 = "SELECT DriverName,CarSpec,Repayments,CurrentLocation,EmailAddress,TelephoneNumber,Password,PhotoUri,DOB FROM ambulances where TaxiNo ='" . $taxinos . "' and Approved='Approved'";
		$result1 = mysqli_query($link, $sql1);
		if (mysqli_num_rows($result1) == 1) {
			while ($row = mysqli_fetch_array($result1)) {
				$rowresult1 = $row['DriverName'];
				$rowresult2 = $row['CarSpec'];
				$rowresult3 = $row['Repayments'];
				$rowresult4 = $row['CurrentLocation'];
				$rowresult5 = $row['EmailAddress'];
				$rowresult6 = $row['TelephoneNumber'];
				$rowresult7 = $row['DOB'];
				$rowresult8 = "Airport Taxi";
				$rowresult9 = $row['PhotoUri'];
				;
				$response = array();
				if ($result1) {
					$messages = 'Correct Info';
					$response['error'] = $messages;
					$response['DriverName'] = $rowresult1;
					$response['CarSpec'] = $rowresult2;
					$response['Repayments'] = $rowresult3;
					$response['CurrentLocation'] = $rowresult4;
					$response['EmailAddress'] = $rowresult5;
					$response['TelephoneNumber'] = $rowresult6;
					$response['DOB'] = $rowresult7;
					$response['CarType'] = $rowresult8;
					$response['PhotoUri'] = $rowresult9;
					echo json_encode($response);
				} else {
					$messages = 'Something Un Expected Happened, Try Again Later';
					$response['error'] = $messages;
					echo json_encode($response);
				}
			}
		}
	} else {
		$messages = 'Password User Name Do not Match any Approved Account';
		$response['error'] = $messages;
		echo json_encode($response);
	}
} else {
	$messages = 'Password User Name Do not Match any Approved Account';
	$response['error'] = $messages;
	echo json_encode($response);
}
error_log (json_encode($response));
?>
