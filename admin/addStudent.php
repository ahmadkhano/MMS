<?php
include '../components/connect.php';

// Check if the delete parameter is set
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // Prepare and execute delete query using PDO
    $delete_student = $conn->prepare("DELETE FROM `add_student` WHERE id = ?");
    if ($delete_student->execute([$delete_id])) {
        header('Location:addStudent.php');
        exit();
    } else {
        echo "<script>alert('Failed to delete student.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $registration_number = filter_var($_POST['registration_number'], FILTER_SANITIZE_STRING);
    $student_name = filter_var($_POST['student_name'], FILTER_SANITIZE_STRING);
    $father_name = filter_var($_POST['father_name'], FILTER_SANITIZE_STRING);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_STRING);
    $admission_date = filter_var($_POST['admission_date'], FILTER_SANITIZE_STRING);
    $current_address = filter_var($_POST['current_address'], FILTER_SANITIZE_STRING);
    $permanent_address = filter_var($_POST['permanent_address'], FILTER_SANITIZE_STRING);
    $contact_number = filter_var($_POST['contact_number'], FILTER_SANITIZE_STRING);
    $admission_fee = filter_var($_POST['admission_fee'], FILTER_SANITIZE_STRING);
    $guardian_relation = filter_var($_POST['guardian_relation'], FILTER_SANITIZE_STRING);
    $guardian_noc = filter_var($_POST['guardian_noc'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
    $previous_grade = filter_var($_POST['previous_grade'], FILTER_SANITIZE_STRING);
    $current_grade = filter_var($_POST['current_grade'], FILTER_SANITIZE_STRING);
    $year = filter_var($_POST['year'], FILTER_SANITIZE_STRING);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);

    // Use prepared statement to insert data
    $stmt = $conn->prepare("INSERT INTO add_student 
    (`registration_number`, `student_name`, `father_name`, `dob`, `admission_date`, `current_address`, 
    `permanent_address`, `contact_number`, `admission_fee`, `guardian_relation`, `guardian_noc`, `status`, 
    `previous_grade`, `current_grade`, `year`, `gender`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Execute the statement
    if ($stmt->execute([
        $registration_number, $student_name, $father_name, $dob, $admission_date, $current_address, 
        $permanent_address, $contact_number, $admission_fee, $guardian_relation, $guardian_noc, $status, 
        $previous_grade, $current_grade, $year, $gender
    ])) {
        // Redirect after successful form submission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); // Exit to stop further script execution
    } else {
        // Error message if the query fails
        echo "<script>alert('Failed to save data.');</script>";
    }  
    // Close the statement
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student</title>
    <script src="../js/demo/html2pdf.bundle.js"></script>
</head>
<body id="page-top">

    <!-- Header Page Starts Here -->
    <?php include '../components/admin_header.php'; ?>



    <!-- Add New Student Page Start Here -->
    <div class="ml-4 mr-4">

        <!-- Add New Student Tittle -->
        <!-- <div class="d-sm-flex align-items-center justify-content-between py-4 rounded">
            <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-arrow-left"></i> واپس جائے 
            </a>
            <h1 class="h3 mb-0 text-800">طالبات کے اندراج کیجئے</h1>
        </div> -->
        <!-- Add New Student Tittle -->

        <!-- Add New Students Form Start Here -->
        <!-- <form class="row g-3" enctype="multipart/form-data" action="addStudent.php" method="POST" dir="rtl"> 
            <div class="col-md-2 mt-2">
                <input type="text" class="form-control" name="registration_number"  placeholder="رجسٹریشن نمبر"  required>
            </div>
            <div class="col-md-2 mt-2">
                <input type="text" class="form-control" name="student_name"  placeholder="نام" required>
            </div>
            <div class="col-md-2 mt-2">
                <input type="text" class="form-control" name="father_name" placeholder="والد کا نام" required>
            </div>
            <div class="col-md-2 mt-2">
                <div class="input-group date">
                    <input type="date" class="form-control" role="button" name="dob" placeholder="تاریخ پیدائش" required/>
                </div>
            </div>
            <div class="col-md-2 mt-2">
                <input type="text" class="form-control" name="current_address" id="validationDefault01" placeholder="موجودہ پتہ" required/>
            </div> 
            <div class="col-md-2 mt-2">
                <div class="input-group date">
                    <input type="date" class="form-control" role="button" name="admission_date" placeholder="تاریخ داخلہ" required/>
                </div>
            </div>
            <div class="col-md-2 mt-2">
                <input type="text" class="form-control" name="permanent_address"  placeholder="مستقل پتہ" required>
            </div>
            <div class="col-md-2 mt-2">
                <input type="tel" class="form-control" name="contact_number" placeholder="رابطہ نمبر" required>
            </div>
            <div class="col-md-2 mt-2">
                <input type="text" class="form-control" name="admission_fee"  placeholder="داخلہ فیس" required>
            </div>
            <div class="col-md-2 mt-2">
                <input type="text" class="form-control" name="guardian_relation"  placeholder="سرپرست رشتہ" required>
            </div>
            <div class="col-md-2 mt-2">
                <input type="text" class="form-control" name="guardian_noc" placeholder="سرپرست این او سی" required>
            </div>
            <div class="col-md-2 mt-2">
                <select class="form-control" role="button" name="status" required>
                    <option selected disabled value="">سٹیٹس</option>
                    <option>جدیده</option>
                    <option>قدیمہ</option>
                    <option>فارغ</option>
                    <option>غیر موجود</option>
                </select>
            </div>
            <div class="col-md-2 mt-2">
                <select class="form-control" role="button" name="previous_grade" required>
                    <option selected disabled value="">سابقہ درجہ</option>
                    <option>Grade A</option>
                    <option>Grade B</option>
                    <option>Grade C</option>
                    <option>Grade D</option>
                </select>
            </div>
            <div class="col-md-2 mt-2">
                <select class="form-control" role="button" name="current_grade" required>
                    <option selected disabled value="">موجودہ درجہ</option>
                    <option>Grade A</option>
                    <option>Grade B</option>
                    <option>Grade C</option>
                    <option>Grade D</option>
                </select>
            </div>
            <div class="col-md-2 mt-2">
                <select class="form-control" role="button" name="year" required>
                    <option selected disabled value="">سال</option>
                    <?php
                        $select_students = $conn->prepare("SELECT * FROM years");
                        $select_students->execute();
                        if($select_students->rowCount() > 0) {
                            while($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option>{$row['year_name']}</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-check mt-2 mr-3">
                <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="طالب العلم" checked>
                <label class="form-check-label mr-4" for="exampleRadios1">طالب العلم</label>
            </div>
            <div class="form-check mt-2">
                <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="طالب العلمہ">
                <label class="form-check-label mr-4" for="exampleRadios2">طالب العلمہ</label>
            </div>
            <div class="col-12 mt-2">
                <button class="btn btn-primary" type="submit">محفوظ کرے</button>
            </div>
        </form> -->
        <!-- Add New Students Form End Here -->

        <!-- Added New Students Tittle -->
        <div class="d-flex align-items-center justify-content-between py-2">
            <a id="generateReport" class="mr-4 d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> رپورٹ بنائے
            </a>
            <a href="" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"data-toggle="modal" data-target="#addStudent">
                <i class="fas fa-user-plus fa-sm text-white-50"></i> نئے طالبعلم کو شامل کریں
            </a>
        </div>
        <!-- Added New Students Tittle -->

        <!-- Added New Students Table Start Here -->
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="table6" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="hide-action-column">ایکشن</th>
                                <th>جنس</th>
                                <th>سال</th>
                                <th>موجودہ درجہ</th>
                                <th>سابقہ درجہ</th>
                                <th>سٹیٹس</th>
                                <th>سرپرست این او سی</th>
                                <th>سرپرست رشتہ</th>
                                <th>داخلہ فیس</th>
                                <th>رابطہ نمبر</th>
                                <th>مستقل پتہ</th>
                                <th>تاریخ داخلہ</th>
                                <th>موجودہ پتہ</th>
                                <th>تاریخ پیدائش</th>
                                <th>والد کا نام</th>
                                <th>نام</th>
                                <th>آئی ڈی</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Assuming you have a database connection in $conn
                                $select_students = $conn->prepare("SELECT * FROM add_student");
                                $select_students->execute();
                                // Check if the query was successful
                                if($select_students->rowCount() > 0) {
                                    while($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td class='hide-action-column'>
                                                <a href='updateAddStudent.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                <a href='addStudent.php?delete=" . $row['id'] . "' class='btn btn-danger btn-sm mt-1' onclick='return confirm(\"Do You Want To Delete This Student?\");'>Delete</a>
                                            </td>";
                                        echo "<td>{$row['gender']}</td>";
                                        echo "<td>{$row['year']}</td>";
                                        echo "<td>{$row['current_grade']}</td>";
                                        echo "<td>{$row['previous_grade']}</td>";
                                        echo "<td>{$row['status']}</td>";
                                        echo "<td>{$row['guardian_noc']}</td>";
                                        echo "<td>{$row['guardian_relation']}</td>";
                                        echo "<td>{$row['admission_fee']}</td>";
                                        echo "<td>{$row['contact_number']}</td>";
                                        echo "<td>{$row['permanent_address']}</td>";
                                        echo "<td>{$row['admission_date']}</td>";
                                        echo "<td>{$row['current_address']}</td>";
                                        echo "<td>{$row['dob']}</td>";
                                        echo "<td>{$row['father_name']}</td>";
                                        echo "<td>{$row['student_name']}</td>";
                                        echo "<td>{$row['registration_number']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='17' class='text-center'>No data found</td></tr>";
                                }
                            ?>
                        </tbody>
                        <tfoot class="hide-action-column">
                            <tr>
                                <th class="hide-action-column">ایکشن</th>
                                <th>جنس</th>
                                <th>سال</th>
                                <th>موجودہ درجہ</th>
                                <th>سابقہ درجہ</th>
                                <th>سٹیٹس</th>
                                <th>سرپرست این او سی</th>
                                <th>سرپرست رشتہ</th>
                                <th>داخلہ فیس</th>
                                <th>رابطہ نمبر</th>
                                <th>مستقل پتہ</th>
                                <th>تاریخ داخلہ</th>
                                <th>موجودہ پتہ</th>
                                <th>تاریخ پیدائش</th>
                                <th>والد کا نام</th>
                                <th>نام</th>
                                <th>آئی ڈی</th>
                            </tr>
                        </tfoot>                            
                    </table>
                </div>
            </div>
        </div>
        <!-- Added New Students Table End Here -->
    </div>
    <!-- Add New Student Page End Here -->


<!-- Add Student Modal-->
<div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="row g-3 p-4" enctype="multipart/form-data" action="addStudent.php" method="POST" dir="rtl"> 
                <div class="col-md-4 mt-2">
                    <input type="text" class="form-control" name="registration_number"  placeholder="رجسٹریشن نمبر"  required>
                </div>
                <div class="col-md-4 mt-2">
                    <input type="text" class="form-control" name="student_name"  placeholder="نام" required>
                </div>
                <div class="col-md-4 mt-2">
                    <input type="text" class="form-control" name="father_name" placeholder="والد کا نام" required>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="input-group date">
                        <input type="date" class="form-control" role="button" name="dob" placeholder="تاریخ پیدائش" required/>
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <input type="text" class="form-control" name="current_address" id="validationDefault01" placeholder="موجودہ پتہ" required/>
                </div> 
                <div class="col-md-4 mt-2">
                    <div class="input-group date">
                        <input type="date" class="form-control" role="button" name="admission_date" placeholder="تاریخ داخلہ" required/>
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <input type="text" class="form-control" name="permanent_address"  placeholder="مستقل پتہ" required>
                </div>
                <div class="col-md-4 mt-2">
                    <input type="tel" class="form-control" name="contact_number" placeholder="رابطہ نمبر" required>
                </div>
                <div class="col-md-4 mt-2">
                    <input type="text" class="form-control" name="admission_fee"  placeholder="داخلہ فیس" required>
                </div>
                <div class="col-md-4 mt-2">
                    <input type="text" class="form-control" name="guardian_relation"  placeholder="سرپرست رشتہ" required>
                </div>
                <div class="col-md-4 mt-2">
                    <input type="text" class="form-control" name="guardian_noc" placeholder="سرپرست این او سی" required>
                </div>
                <div class="col-md-4 mt-2">
                    <select class="form-control" role="button" name="status" required>
                        <option selected disabled value="">سٹیٹس</option>
                        <option>جدیده</option>
                        <option>قدیمہ</option>
                        <option>فارغ</option>
                        <option>غیر موجود</option>
                    </select>
                </div>
                <div class="col-md-4 mt-2">
                    <select class="form-control" role="button" name="previous_grade" required>
                        <option selected disabled value="">سابقہ درجہ</option>
                        <option>Grade A</option>
                        <option>Grade B</option>
                        <option>Grade C</option>
                        <option>Grade D</option>
                    </select>
                </div>
                <div class="col-md-4 mt-2">
                    <select class="form-control" role="button" name="current_grade" required>
                        <option selected disabled value="">موجودہ درجہ</option>
                        <option>Grade A</option>
                        <option>Grade B</option>
                        <option>Grade C</option>
                        <option>Grade D</option>
                    </select>
                </div>
                <div class="col-md-4 mt-2">
                    <select class="form-control" role="button" name="year" required>
                        <option selected disabled value="">سال</option>
                        <?php
                            $select_students = $conn->prepare("SELECT * FROM years");
                            $select_students->execute();
                            if($select_students->rowCount() > 0) {
                                while($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option>{$row['year_name']}</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-check mt-2 mr-3">
                    <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="طالب العلم" checked>
                    <label class="form-check-label mr-4" for="exampleRadios1">طالب العلم</label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="طالب العلمہ">
                    <label class="form-check-label mr-4" for="exampleRadios2">طالب العلمہ</label>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn btn-primary" type="submit">محفوظ کرے</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Footer Page Starts Here -->
    <?php include '../components/admin_footer.php'; ?>
     
    <script src="../js/demo/html2pdf.js"></script>

</body>
</html>