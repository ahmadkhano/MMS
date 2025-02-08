<?php
include '../components/connect.php';
session_start();

// Check if the delete parameter is set
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // Prepare and execute delete query using PDO
    $delete_student = $conn->prepare("DELETE FROM `fee_menu` WHERE id = ?");
    if ($delete_student->execute([$delete_id])) {
        header('Location:feeMenu.php');
        exit();
    } else {
        echo "<script>alert('Failed to delete fee.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $registration_number = filter_var($_POST['registration_number'], FILTER_SANITIZE_STRING);
    $student_name = filter_var($_POST['student_name'], FILTER_SANITIZE_STRING);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_STRING);
    $admission_fee = filter_var($_POST['admission_fee'], FILTER_SANITIZE_STRING);
    $admission_date = filter_var($_POST['admission_date'], FILTER_SANITIZE_STRING);
    $concision = filter_var($_POST['concision'], FILTER_SANITIZE_STRING);
    $reason_of_concision = filter_var($_POST['reason_of_concision'], FILTER_SANITIZE_STRING);
    $grade = filter_var($_POST['grade'], FILTER_SANITIZE_STRING);

    // Use prepared statement to insert data
    $stmt = $conn->prepare("INSERT INTO fee_menu 
    (`registration_number`, `student_name`, `dob`, `admission_fee`, `admission_date`, `concision`, `reason_of_concision`, `grade`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Execute the statement
    if ($stmt->execute([$registration_number, $student_name, $dob, $admission_fee ,$admission_date, $concision, $reason_of_concision, $grade])) {
        // Redirect after successful form submission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); // Exit to stop further script execution
    } else {
        // Error message if the query fails
        echo "<script>alert('Failed to save data.');</script>";
    }  
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fee Menu</title>
</head>
<body id="page-top">
    
    <!-- Header Page Starts Here -->
    <?php include '../components/admin_header.php'; ?>
    <!-- Header Page End Here -->



    <!-- Add New Fee Page Start Here -->
    <div class="ml-4 mr-4">
        <!-- Add New Student Tittle -->
        <div class="d-sm-flex align-items-center justify-content-between py-4 rounded">
            <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-arrow-left"></i> واپس جائے 
            </a>
            <h1 class="h3 mb-0 text-800">فیس کے اندراج کیجئے</h1>
        </div>
        <!-- Add New Student Tittle -->

        <!-- Add New Fees Form Start Here -->
        <form class="row g-3" enctype="multipart/form-data" action="feeMenu.php" method="POST">    
            <div class="col-md-2">
                <input type="text" class="form-control text-right" name="concision" placeholder="رِعایت" required>
            </div>
            <div class="col-md-2">
                <div class="input-group date" id="datepicker">
                    <input type="date" class="form-control" id="date" name="admission_date" placeholder="تاریخ داخلہ" required/>
                </div>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control text-right" name="admission_fee" placeholder="داخلہ فیس" required>
            </div>    
            <div class="col-md-2">
                <div class="input-group date" id="datepicker">
                    <input type="date" class="form-control" name="dob" placeholder="تاریخ پیدائش" required/>
                </div>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control  text-right" name="student_name" placeholder="نام" required>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control text-right" name="registration_number" placeholder="رجسٹریشن نمبر" required>
            </div>
            <div class="col-md-2 mt-2">
                <input type="text" class="form-control text-right" name="reason_of_concision" placeholder="رِعایت کی وجہ" required>
            </div>
            <div class="col-md-2 mt-2" dir="rtl">
                <select class="form-control text-right" role="button" name="grade" required>
                    <option selected disabled value="">درجہ</option>
                    <?php
                        $select_students = $conn->prepare("SELECT * FROM grades");
                        $select_students->execute();
                        if($select_students->rowCount() > 0) {
                            while($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option>{$row['grade_name']}</option>";
                            }
                        } else {
                            echo "<option>No data found</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-12 mt-2">
                <button class="btn btn-primary" type="submit">محفوظ کرے</button>
            </div>
        </form>
        <!-- Add New Fees Form End Here -->

        <!-- Added New Fees Tittle -->
        <div class="d-sm-flex align-items-center justify-content-between py-4">
            <a href="#" class="mr-4 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> رپورٹ بنائے</a>
            <h1 class="h3 mb-0 ml-4 text-800">درج شدہ طالبات</h1>
        </div>
        <!-- Added New Fees Tittle -->

        <!-- Added New Fees Table Start Here -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="table7" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ایکشن</th>
                                <th>درجہ</th>
                                <th>رِعایت کی وجہ</th>
                                <th>رِعایت</th>
                                <th>تاریخ داخلہ</th>
                                <th>داخلہ فیس</th>
                                <th>تاریخ پیدائش</th>
                                <th>نام</th>
                                <th>رجسٹریشن نمبر</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Assuming you have a database connection in $conn
                                $select_fee = $conn->prepare("SELECT * FROM fee_menu");
                                $select_fee->execute();
                                // Check if the query was successful
                                if($select_fee->rowCount() > 0) {
                                    while($row = $select_fee->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>
                                                <a href='updateFeeMenu.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                <a href='feeMenu.php?delete=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Do You Want To Delete This Student Fees?\");'>Delete</a>
                                            </td>";
                                        // Displaying student information
                                        echo "<td>{$row['grade']}</td>";
                                        echo "<td>{$row['reason_of_concision']}</td>";
                                        echo "<td>{$row['concision']}</td>";
                                        echo "<td>{$row['admission_date']}</td>";
                                        echo "<td>{$row['admission_fee']}</td>";
                                        echo "<td>{$row['dob']}</td>";
                                        echo "<td>{$row['student_name']}</td>";
                                        echo "<td>{$row['registration_number']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='17' class='text-center'>No data found</td></tr>";
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ایکشن</th>
                                <th>درجہ</th>
                                <th>رِعایت کی وجہ</th>
                                <th>رِعایت</th>
                                <th>تاریخ داخلہ</th>
                                <th>داخلہ فیس</th>
                                <th>تاریخ پیدائش</th>
                                <th>نام</th>
                                <th>رجسٹریشن نمبر</th>
                            </tr>
                        </tfoot>                            
                    </table>
                </div>
            </div>
        </div>
        <!-- Added New Fees Table End Here -->
    </div>
    <!-- Add New Fee Page End Here -->



    <!-- Footer Page Starts Here -->
    <?php include '../components/admin_footer.php'; ?>
    <!-- Footer Page End Here -->
</body>
</html>