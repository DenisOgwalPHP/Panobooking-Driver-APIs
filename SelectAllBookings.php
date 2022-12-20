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
$sql1="SELECT Cost,OrderCode,Date,Facility,Quantity,User,DatesFrom,DatesTo,Taken FROM cart where ProductName ='".$taxinos."' order by IDs Desc";
$result1=mysqli_query($link,$sql1);
if (mysqli_num_rows($result1) >= 1) {
    $response = array();
    while ($row = mysqli_fetch_array($result1)) {
        $rowresult1 = $row['Cost'];
        $rowresult2 = $row['OrderCode'];
        $rowresult3 = $row['Date'];
        $rowresult4 = $row['Facility'];
        $rowresult5 = $row['Quantity'];
        $rowresult6 = $row['User'];
        $rowresult7 = $row['DatesFrom'];
        $rowresult8 = $row['DatesTo'];
        $rowresult9 = $row['Taken'];

        $temp['OrderCode'] = $rowresult2;
        $temp['Cost'] = $rowresult1;
        $temp['Date'] = $rowresult3;
        $temp['Facility'] = $rowresult4;
        $temp['Quantity'] = $rowresult5;
        $temp['User'] = $rowresult6;
        $temp['DatesFrom'] = $rowresult7;
        $temp['DatesTo'] = $rowresult8;
        $temp['Taken'] = $rowresult9;
        array_push($response, $temp);
    }
    echo json_encode(['error' => $response]);
} else {
    $response1 = array();
    $messages = 'No Booking Found for this Vehicle so Far';
    $temp['OrderCode'] = $messages;
    array_push($response1, $temp);
    echo json_encode(['error' => $response1]);
}
error_log (json_encode($response));
?>
