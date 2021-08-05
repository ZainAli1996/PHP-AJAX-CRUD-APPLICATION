<?php
$con = mysqli_connect('localhost', 'root', '', 'ajaxcrud');

// Data Insert START
extract($_POST);

if (
    isset($_POST['firstname'])
    && isset($_POST['lastname'])
    && isset($_POST['email'])
    && isset($_POST['mobile'])
) {

    $InsertQuery = "INSERT into ajax_table (firstname, lastname, email, mobile)
    values ('$firstname', '$lastname', '$email', '$mobile')";
    mysqli_query($con, $InsertQuery);
}
// Data Insert END

// Data Select START
if (isset($_POST['RecordKey'])) {

    $TableData = '<table class="table table-bordered table-striped text-center">
        <tr>
            <th>ID</th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>EMAIL</th>
            <th>MOBILE</th>
            <th>EDIT</th>
            <th>DELETE</th>
        </tr>';

    $SelectQuery = "SELECT * FROM ajax_table";
    $query = mysqli_query($con, $SelectQuery);
    $CheckData = mysqli_num_rows($query);

    if ($CheckData > 0) {

        $id = 1;
        while ($row = mysqli_fetch_array($query)) {

            $TableData .= '<tr>
                    <td>' . $id . '</td>
                    <td>' . $row['firstname'] . '</td>
                    <td>' . $row['lastname'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['mobile'] . '</td>
                    <td><button class="btn btn-success" onclick="UpdateData(' . $row['id'] . ')"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></button></td>
                    <td><button class="btn btn-danger" onclick="DeleteData(' . $row['id'] . ')"><i class="fa fa-trash text-dark" aria-hidden="true"></i></button></td>
                </tr>';
            $id++;
        }
    }

    $TableData .= '</table>';

    echo $TableData;
}
// Data Select END

// Data Delete START
if (isset($_POST['DeleteIdKey'])) {

    $ID = $_POST['DeleteIdKey'];

    $DeleteQuery = "DELETE FROM `ajax_table` WHERE id = '$ID' ";
    $query = mysqli_query($con, $DeleteQuery);
}
// Data Delete END

// Get Id To Fetch Data START

if (isset($_POST['Update_Id_Key']) && isset($_POST['Update_Id_Key']) != "") {

    $UpdateId = $_POST['Update_Id_Key'];
    $SelectQuery = "SELECT * FROM ajax_table WHERE id = '$UpdateId'"  or die(mysqli_error($con));
    $Query = mysqli_query($con, $SelectQuery);
    $Data = mysqli_num_rows($Query);

    if ($Data > 0) {
        while ($Row = mysqli_fetch_assoc($Query)) {
            $Response = $Row;
        }
    } else {
        $Response['status'] = 200; // Means Successful response
        $Response['message'] = "DATA NOT FOUND";
    }

    echo json_encode($Response);
} else {
    $Response['status'] = 200; // Means Successful response
    $Response['message'] = "Invalid Request";
}
// Get Id To Fetch Data END

// Get Id To Update Data START

if (isset($_POST['UPD_ID_Key'])) {

    $UpdateID = $_POST['UPD_ID_Key'];
    $UpdateFN = $_POST['UPD_FirstName_Key'];
    $UpdateLN = $_POST['UPD_LastName_Key'];
    $UpdateEM = $_POST['UPD_Email_Key'];
    $UpdateMB = $_POST['UPD_Mobile_Key'];

    $UpdateQuery = "UPDATE `ajax_table` SET `firstname`='$UpdateFN',`lastname`='$UpdateLN',`email`='$UpdateEM',`mobile`='$UpdateMB' WHERE id = '$UpdateID' ";

    $Query = mysqli_query($con, $UpdateQuery);
}

// Get Id To Update Data END
