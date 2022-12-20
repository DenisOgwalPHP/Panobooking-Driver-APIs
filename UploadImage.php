<?php
try {
    $uploaddir = 'FileUpload/';
    $fileName = basename($_FILES['fileToUpload']['name']);
    $uploadfile = $uploaddir . basename($_FILES['fileToUpload']['name']);

    //CHECK IF ITS AN IMAGE OR NOT
    $allowed_types = array('image/jpeg', 'image/png', 'image/bmp', 'image/gif');
    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $detected_type = finfo_file($fileInfo, $_FILES['fileToUpload']['tmp_name']);
    if (!in_array($detected_type, $allowed_types)) {
        die('{"status" : "Bad", "reason" : "Not a valid image"}');
    }
    //

    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
        $taxinos = substr($fileName, 0, 7);
        include_once 'DB_Connect.php';
        $sql1 = "SELECT PhotoUri FROM carrentals where TaxiNo like '" . $taxinos . "%'";
        $result1 = mysqli_query($link, $sql1);
        if (mysqli_num_rows($result1) == 1) {
            $row = mysqli_fetch_array($result1);
            $imageurl = $row['PhotoUri'] + 1;
            $sql = "UPDATE carrentals SET PhotoUri='$imageurl' where TaxiNo like '" . $taxinos . "%'";
            mysqli_query($link, $sql);
            echo 'Successful Uploaded Photo No. ' . $imageurl;
        } else {
            $sql1 = "SELECT PhotoUri FROM airporttaxi where TaxiNo like '" . $taxinos . "%'";
            $result1 = mysqli_query($link, $sql1);
            if (mysqli_num_rows($result1) == 1) {
                $row = mysqli_fetch_array($result1);
                $imageurl = $row['PhotoUri'] + 1;
                $sql = "UPDATE airporttaxi SET PhotoUri='" . $imageurl . "' where TaxiNo like '" . $taxinos . "%'";
                mysqli_query($link, $sql);
                echo 'Successful Uploaded Photo No. ' . $imageurl;
            } else {
                $sql2 = "SELECT PhotoUri FROM ambulances where TaxiNo like '" . $taxinos . "%'";
                $result2 = mysqli_query($link, $sql2);
                if (mysqli_num_rows($result2) == 1) {
                    $row = mysqli_fetch_array($result2);
                    $imageurl = $row['PhotoUri'] + 1;
                    $sql = "UPDATE ambulances SET PhotoUri='" . $imageurl . "' where TaxiNo like '" . $taxinos . "%'";
                    mysqli_query($link, $sql);
                    echo 'Successful Uploaded Photo No. ' . $imageurl;
                }
            }
        }
        $isGood = true;
    } else {
        //echo "Possible file upload attack!\n";
        echo 'Failed';
    }
} catch (Exception $e) {
    echo '{"status" : "Failed", "reason" : "' . $e->getMessage() . '"}';
}
?>