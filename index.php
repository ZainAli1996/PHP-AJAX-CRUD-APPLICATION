<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME PAGE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h1 class="text-primary text-uppercase text-center">AJAX CRUD OPERATION</h1>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
                INSERT NEW DATA
            </button>
        </div>

        <h2 class="text-danger">All Records</h2>
        <div id="records"></div>


        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">AJAX CRUD OPERATION</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="firstname"><b>FIRST NAME :</b></label>
                            <input type="text" class="form-control" id="firstname" name="" placeholder="Enter First Name" maxlength="30" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname"><b>LAST NAME :</b></label>
                            <input type="text" class="form-control" id="lastname" name="" placeholder="Enter Last Name" maxlength="30" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><b>EMAIL :</b></label>
                            <input type="email" class="form-control" id="email" name="" placeholder="Enter Email" maxlength="30" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile"><b>MOBILE :</b></label>
                            <input type="tel" class="form-control" id="mobile" name="" placeholder="Valid Pattern 01111111111" maxlength="30" required pattern="[0]{1}[0-9]{10}">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addRecord()">Save</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- UPDATE MODEL SECTION START -->
        <!-- The Modal -->
        <div class="modal" id="update_myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">AJAX CRUD OPERATION</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <input type="hidden" id="update_id" name="">

                        <div class="form-group">
                            <label for="update_firstname"><b>UPDATE FIRST NAME :</b></label>
                            <input type="text" class="form-control" id="update_firstname" name="" placeholder="Enter First Name" maxlength="30" required>
                        </div>
                        <div class="form-group">
                            <label for="update_lastname"><b>UPDATE LAST NAME :</b></label>
                            <input type="text" class="form-control" id="update_lastname" name="" placeholder="Enter Last Name" maxlength="30" required>
                        </div>
                        <div class="form-group">
                            <label for="update_email"><b>UPDATE EMAIL :</b></label>
                            <input type="email" class="form-control" id="update_email" name="" placeholder="Enter Email" maxlength="30" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile"><b>UPDATE MOBILE :</b></label>
                            <input type="tel" class="form-control" id="update_mobile" name="" placeholder="Valid Pattern 01111111111" maxlength="30" required pattern="[0]{1}[0-9]{10}">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="UpdateRecord()">Update</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- UPDATE MODEL SECTION END -->
    </div>

    <script>
        $(document).ready(function() {

            readRecords();

        });

        function addRecord() {

            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var email = $('#email').val();
            var mobile = $('#mobile').val();

            $.ajax({

                url: "backend.php",
                type: 'post',
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    mobile: mobile
                },

                success: function(data) {
                    swal({
                        title: "Data Inserted !",
                        text: "NEW RECORD HAS INSERTED SUCCESSFULLY",
                        icon: "success",
                        button: "OK",
                    });
                    readRecords();
                }

            });

        } // addRecord() END

        function readRecords() {
            var ReadRecord = ""
            $.ajax({
                url: "backend.php",
                type: "post",
                data: {
                    RecordKey: ReadRecord
                },
                success: function(data) {
                    $('#records').html(data);
                }
            });
        } // readRecords() END

        function DeleteData(DeleteId) { //defined DeleteId as variable that contains $row['id']
            var confirmation = confirm("Are You Sure To Delete");
            if (confirmation == true) {
                $.ajax({
                    url: "backend.php",
                    type: "post",
                    data: {
                        DeleteIdKey: DeleteId
                    },

                    success: function(data) {
                        swal({
                            title: "Data Deleted !",
                            text: "SELECTED DATA HAS BEEN DELETED SUCCESSFULLY",
                            icon: "success",
                            button: "OK",
                        });
                        readRecords();

                    }

                });

            } else {
                swal({
                    title: "Data Deletion Cancelled !",
                    text: "YOUR DATA IS SAFE NOW :)",
                    icon: "error",
                    button: "OK",
                });
            }
        } //DeleteData(DeleteId) END

        function UpdateData(Update_Id) { //defined UpdateId as variable that contains $row['id']
            $('#update_id').val(Update_Id)

            $.post("backend.php", {
                    Update_Id_Key: Update_Id
                },
                function(data) {
                    var user = JSON.parse(data);
                    $('#update_firstname').val(user.firstname);
                    $('#update_lastname').val(user.lastname);
                    $('#update_email').val(user.email);
                    $('#update_mobile').val(user.mobile);
                }
            );
            $('#update_myModal').modal("show");

        } // UpdateData() Fetch END

        function UpdateRecord() {

            var UPD_ID = $('#update_id').val();
            var UPD_FirstName = $('#update_firstname').val();
            var UPD_LastName = $('#update_lastname').val();
            var UPD_Email = $('#update_email').val();
            var UPD_Mobile = $('#update_mobile').val();

            $.post("backend.php", {
                    UPD_ID_Key: UPD_ID,
                    UPD_FirstName_Key: UPD_FirstName,
                    UPD_LastName_Key: UPD_LastName,
                    UPD_Email_Key: UPD_Email,
                    UPD_Mobile_Key: UPD_Mobile
                },
                function(data) {
                    $('#update_myModal').modal("hide");
                    swal({
                        title: "Data Updated !",
                        text: "SELECTED DATA HAS BEEN UPDATED SUCCESSFULLY",
                        icon: "success",
                        button: "OK",
                    });
                    readRecords();
                }

            );

        } // UpdateRecord() END
    </script>

</body>

</html>