<?php
include '../components/connect.php';

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // Prepare and execute delete query using PDO
    $delete_teacher = $conn->prepare("DELETE FROM `add_teacher` WHERE id = ?");
    if ($delete_teacher->execute([$delete_id])) {
        header('Location:addTeacher.php');
        exit();
    } else {
        echo "<script>alert('Failed to delete teacher.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $registration_number = filter_var($_POST['registration_number'], FILTER_SANITIZE_STRING);
    $teacher_name = filter_var($_POST['teacher_name'], FILTER_SANITIZE_STRING);
    $father_name = filter_var($_POST['father_name'], FILTER_SANITIZE_STRING);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_STRING);
    $admission_date = filter_var($_POST['admission_date'], FILTER_SANITIZE_STRING);
    $complete_address = filter_var($_POST['complete_address'], FILTER_SANITIZE_STRING);
    $contact_number = filter_var($_POST['contact_number'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
    $designation = filter_var($_POST['designation'], FILTER_SANITIZE_STRING);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);

    $stmt = $conn->prepare("INSERT INTO add_teacher (`registration_number`, `teacher_name`, `father_name`, `dob`,
    `admission_date`, `complete_address`, `contact_number`, `status`, `designation`, `gender`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?,?, ?)");

    // Execute the statement
    if ($stmt->execute([
        $registration_number, $teacher_name, $father_name, $dob, $admission_date, $complete_address, 
        $contact_number, $status, $designation, $gender
    ])) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); 
    } else {
        echo "<script>alert('Failed to save data.');</script>";
    }  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Teacher</title>
</head>
<body id="page-top">
    <?php include '../components/admin_header.php'; ?> <!-- Header Page Link -->
    
    <!-- Teacher Page -->
    <div class="ml-4 mr-4">

        <!-- Tittle -->
        <div class="d-flex align-items-center justify-content-between py-2">
            <a id="generateReport" class="mr-4 d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> رپورٹ بنائے
            </a>
            <a class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" 
                data-target="#addTeacher">
                <i class="fas fa-user-plus fa-sm text-white-50"></i> اساتذہ کو شامل کریں
            </a>
        </div>  <!-- Tittle -->

        <!-- Table -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="table8" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="hide-action-column">ایکشن</th>
                                <th>جنس</th>
                                <th>عھدہ</th>
                                <th>سٹیٹس</th>
                                <th>رابطہ نمبر</th>
                                <th>مدرسہ آنے کی تاریخ </th>
                                <th>مکمّل پتہ</th>
                                <th>تاریخ پیدائش</th>
                                <th>والد کا نام</th>
                                <th>نام</th>
                                <th>آئی ڈی</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $select_students = $conn->prepare("
                                    SELECT 
                                        add_teacher.id,
                                        add_teacher.registration_number, 
                                        add_teacher.teacher_name, 
                                        add_teacher.father_name, 
                                        add_teacher.dob, 
                                        add_teacher.admission_date, 
                                        add_teacher.complete_address, 
                                        add_teacher.contact_number, 
                                        add_teacher.status, 
                                        teacher_designation.designation AS designation,
                                        add_teacher.gender
                                    FROM 
                                        add_teacher
                                    LEFT JOIN 
                                        teacher_designation
                                    ON 
                                        add_teacher.designation = teacher_designation.designation
                                ");
                                $select_students->execute();

                                if ($select_students->rowCount() > 0) {
                                    while ($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td class='hide-action-column'>
                                                <a href='updateAddTeacher.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                <a href='addTeacher.php?delete=" . $row['id'] . "' class='btn btn-danger btn-sm mt-1' onclick='return confirm(\"Do You Want To Delete This Teacher?\");'>Delete</a>
                                            </td>";
                                        echo "<td>{$row['gender']}</td>";
                                        echo "<td>{$row['designation']}</td>"; //showing from another table
                                        echo "<td>{$row['status']}</td>";
                                        echo "<td>{$row['contact_number']}</td>";
                                        echo "<td>{$row['admission_date']}</td>";
                                        echo "<td>{$row['complete_address']}</td>";
                                        echo "<td>{$row['dob']}</td>";
                                        echo "<td>{$row['father_name']}</td>";
                                        echo "<td>{$row['teacher_name']}</td>";
                                        echo "<td>{$row['registration_number']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>
                                        <td colspan='17'>No data found</td>
                                    </tr>";
                                }
                            ?>
                        </tbody>
                        <tfoot class="hide-action-column">
                            <tr>
                                <th>ایکشن</th>
                                <th>جنس</th>
                                <th>عھدہ</th>
                                <th>سٹیٹس</th>
                                <th>رابطہ نمبر</th>
                                <th>مدرسہ آنے کی تاریخ </th>
                                <th>مکمّل پتہ</th>
                                <th>تاریخ پیدائش</th>
                                <th>والد کا نام</th>
                                <th>نام</th>
                                <th>آئی ڈی</th>
                            </tr>
                        </tfoot>                            
                    </table>
                </div>
            </div>
        </div>  <!-- Table -->
        
    </div>  <!-- Teacher Page -->
    

    <!-- Add Teacher Modal -->
    <div class="modal fade" id="addTeacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-xl">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="row g-3 ml-1 mr-1 p-4" enctype="multipart/form-data" action="addTeacher.php" method="POST" dir="rtl">
                    <div class="col-md-4 mt-2">
                        <input type="text" class="form-control" name="registration_number" placeholder="رجسٹریشن نمبر">
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="text" class="form-control" name="teacher_name" placeholder="نام">
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="text" class="form-control" name="father_name" placeholder="والد کا نام" >
                    </div>
                    <div class="col-md-4 mt-2">
                        <div class="input-group date" id="datepicker">
                            <input type="date" class="form-control" role="button" name="dob" placeholder="تاریخ پیدائش"/>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="text" class="form-control" name="complete_address" placeholder="مکمّل پتہ" >
                    </div>
                    <div class="col-md-4 mt-2">
                        <div class="input-group date" id="datepicker">
                            <input type="date" class="form-control" role="button" name="admission_date" placeholder="تاریخ داخلہ"/>
                        </div>
                    </div>   
                    <div class="col-md-4 mt-2">
                        <input type="tel" class="form-control" name="contact_number" placeholder="رابطہ نمبر">
                    </div>
                    <div class="col-md-4 mt-2">
                        <select class="form-control" role="button" name="status">
                            <option selected disabled value="">سٹیٹس</option>
                            <option>جدیده</option>
                            <option>قدیمہ</option>
                            <option>فارغ</option>
                            <option>غیر موجود</option>
                        </select>
                    </div>
                    <div class="col-md-4 mt-2">
                        <select class="form-control" role="button" name="designation">
                            <option selected disabled value="">عھدہ</option>
                            <?php
                                $select_students = $conn->prepare("SELECT * FROM teacher_designation");
                                $select_students->execute();
                                if($select_students->rowCount() > 0) {
                                    while($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option>{$row['designation']}</option>";
                                    }
                                } else {
                                    echo "<tr>
                                        <td colspan='17'>No data found</td>
                                    </tr>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-check mt-3 mr-3">
                        <input class="form-check-input" type="radio" name="gender"  value="قاری صاحب" role="button" checked>
                        <label class="form-check-label mr-4" for="exampleRadios2">قاری صاحب</label>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="radio" name="gender" value="قاری صاحبہ" role="button">
                        <label class="form-check-label mr-4" for="exampleRadios1">قاری صاحبہ</label>
                    </div>
                    <div class="col-12 mt-2">
                        <button class="btn btn-primary" type="submit">محفوظ کرے</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  <!-- Add Teacher Modal -->
    
    <!-- Footer Page Link -->
    <?php include '../components/admin_footer.php'; ?>  
    
    <script src="../js/demo/html2pdf.js"></script>
</body>
</html>