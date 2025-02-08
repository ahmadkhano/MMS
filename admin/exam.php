<?php
include '../components/connect.php';

// Check if the delete parameter is set
if (isset($_GET['delete']) && isset($_GET['table'])) {
    $delete_id = $_GET['delete'];
    $table = $_GET['table'];

    // Check if the table name is valid (you can extend this list to other tables if needed)
    $valid_tables = ['exam', 'datesheet'];

    if (in_array($table, $valid_tables)) {
        // Prepare and execute delete query using PDO
        $delete_student = $conn->prepare("DELETE FROM `$table` WHERE id = ?");
        
        if ($delete_student->execute([$delete_id])) {
            header('Location: exam.php');
            exit();
        } else {
            echo "<script>alert('Failed to delete record.');</script>";
        }
    } else {
        echo "<script>alert('Invalid table.');</script>";
    }
}

// Handle exam data
if (isset($_POST['exam_name']) && isset($_POST['exam_status'])) {
    $exam_name = $_POST['exam_name'];
    $exam_status = $_POST['exam_status'];
    echo insertData($conn, 'exam', 'exam_name, exam_status', [$exam_name, $exam_status]);
    // Redirect to prevent form resubmission on page refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
// Handle datesheet data
if (isset($_POST['datesheet_grade']) && isset($_POST['datesheet_subject']) && isset($_POST['datesheet_date'])){
    $datesheet_grade = $_POST['datesheet_grade'];
    $datesheet_subject = $_POST['datesheet_subject'];
    $datesheet_date = $_POST['datesheet_date'];
    echo insertData($conn, 'datesheet', 'datesheet_grade, datesheet_subject, datesheet_date', 
    [$datesheet_grade, $datesheet_subject, $datesheet_date]);
    // Redirect to prevent form resubmission on page refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Function to insert data into any table
function insertData($conn, $table, $columns, $values) {
    $placeholders = implode(',', array_fill(0, count($values), '?'));
    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    
    $stmt = $conn->prepare($sql);

    // Bind the values using bindValue for PDO
    foreach ($values as $key => $value) {
        $stmt->bindValue($key + 1, $value, PDO::PARAM_STR);
    }

    // Execute the statement and return the result
    if ($stmt->execute()) {
    } else {
        return "Error: " . $stmt->errorInfo()[2];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Exam</title>
</head>
<body id="page-top">

    <!-- Header Page Starts Here -->
    <?php include '../components/admin_header.php'; ?>
    <!-- Header Page End Here -->



    <!-- Exam Page Start Here -->
    <nav class="d-flex justify-content-center">
        <div class="nav nav-tabs bg-grey" id="nav-tab" role="tablist">
            <button class="nav-link" id="nav-add-marks-tab" data-bs-toggle="tab" data-bs-target="#nav-add-marks" type="button" role="tab" aria-controls="nav-add-marks" aria-selected="false">نمبرز کے اندراج کرے</button>
            <button class="nav-link" id="nav-add-datesheet-tab" data-bs-toggle="tab" data-bs-target="#nav-add-datesheet" type="button" role="tab" aria-controls="nav-add-datesheet" aria-selected="false">ڈیٹشیٹ بنائے</button>
            <button class="nav-link active" id="nav-add-exam-name-tab" data-bs-toggle="tab" data-bs-target="#nav-add-exam-name" type="button" role="tab" aria-controls="nav-add-exam-name" aria-selected="true">امتحان کو نام دیجئے</button>
        </div>
    </nav>
                
    <div class="tab-content" id="nav-tabContent">
        <!-- Add Exam Name Start Here -->
        <div class="tab-pane fade show active" id="nav-add-exam-name" role="tabpanel" aria-labelledby="nav-add-exam-name-tab" tabindex="0">
            <form class="row g-3 ml-3 mr-3 mt-2" enctype="multipart/form-data" action="exam.php" method="POST" dir="rtl">
                <div class="col-md-2">
                    <input type="text" class="form-control text-right" name="exam_name" placeholder="امتحان کا نام" required>
                </div>
                <div class="col-md-2">
                    <select class="form-control text-right" role="button" name="exam_status" required>
                        <option selected disabled value="">سٹیٹس</option>
                        <option>جاری</option>
                        <option>ختم</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" type="submit">محفوظ کرے</button>
                </div>
            </form>
            <div class="d-flex align-items-center justify-content-between ml-4 mr-4 py-2">
                <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> رپورٹ بنائے
                </a>
                <h1 class="h3 mb-0 text-800">درج شدہ امتحان</h1>
            </div>
            <div class="card shadow ml-4 mr-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="table12" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ایکشن</th>
                                    <th>سٹیٹس</th>
                                    <th>امتحان کا نام</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $select_fee = $conn->prepare("SELECT * FROM exam");
                                    $select_fee->execute();
                                    if($select_fee->rowCount() > 0) {
                                        while($row = $select_fee->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr class='text-center'>";
                                                echo "<td>
                                                        <a href='updateFeeMenu.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                        <a href='exam.php?delete=" . $row['id'] . "&table=exam' class='btn btn-danger btn-sm' onclick='return confirm(\"Do You Want To Delete The Exam?\");'>Delete</a>
                                                    </td>";
                                                echo "<td>{$row['exam_status']}</td>";
                                                echo "<td>{$row['exam_name']}</td>";
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
                                    <th>سٹیٹس</th>
                                    <th>امتحان کا نام</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Exam Name End Here -->
                    
        <!-- Add Datesheet Start Here -->
        <div class="tab-pane fade" id="nav-add-datesheet" role="tabpanel" aria-labelledby="nav-add-datesheet-tab" tabindex="0">
            <form class="row g-3 ml-3 mr-3 mt-2 text-right" enctype="multipart/form-data" action="exam.php" method="POST" dir="rtl">
                <div class="col-md-2 mt-2">
                    <select class="form-control" role="button" name="datesheet_grade" required>
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
                <div class="col-md-2 mt-2">
                    <select class="form-control text-right" role="button" name="datesheet_subject" required>
                            <option selected disabled value="">مضمون</option>
                            <?php
                                $select_students = $conn->prepare("SELECT * FROM add_subject");
                                $select_students->execute();
                                if($select_students->rowCount() > 0) {
                                    while($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option>{$row['subject_name']}</option>";
                                    }
                                } else {
                                    echo "<option>No data found</option>";
                                }
                            ?>
                        </select>
                </div>
                <div class="col-md-2 mt-2">
                    <div class="input-group date">
                          <input type="date" class="form-control" name="datesheet_date" role="button" placeholder="تاریخ"/>
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <button class="btn btn-primary" type="submit">محفوظ کرے</button>
                </div>
            </form>
            <div class="d-sm-flex align-items-center justify-content-between mt-4 p-3">
                <a href="#" class="mr-4 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> رپورٹ بنائے
                </a>
                <h1 class="h3 mb-0 ml-4 text-800">درج شدہ ڈیٹشیٹ</h1>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="table13" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ایکشن</th>
                                    <th>تاریخ</th>
                                    <th>مضمون</th>
                                    <th>درجہ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm">Update</button>
                                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                    <td>06/07/1999</td>
                                    <td>HTML</td>
                                    <td>Daraja A</td>
                                </tr> -->
                                <?php
                                    $select_fee = $conn->prepare("SELECT * FROM datesheet");
                                    $select_fee->execute();
                                    if($select_fee->rowCount() > 0) {
                                        while($row = $select_fee->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr class='text-center'>";
                                                echo "<td>
                                                        <a href='updateFeeMenu.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                        <a href='exam.php?delete=" . $row['id'] . "&table=datesheet' class='btn btn-danger btn-sm' onclick='return confirm(\"Do You Want To Delete The Datesheet?\");'>Delete</a>
                                                    </td>";
                                                echo "<td>{$row['datesheet_date']}</td>";
                                                echo "<td>{$row['datesheet_subject']}</td>";
                                                echo "<td>{$row['datesheet_grade']}</td>";
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
                                    <th>تاریخ</th>
                                    <th>مضمون</th>
                                    <th>درجہ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Datesheet End Here -->
                    
        <!-- Add Marks Start Here -->
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade" id="nav-add-marks" role="tabpanel" aria-labelledby="nav-add-marks-tab">
            <div class="d-sm-flex align-items-center justify-content-between ml-3 mr-3 rounded">
                <a href="index.php" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-arrow-left"></i>  واپس جائے 
                </a>
                <h1 class="h3 mb-0 text-800">نمبرز کے اندراج کرے</h1>
            </div>
            <div class="d-sm-flex align-items-center justify-content-center">
                <h1>Page Under Construction!</h1>
            </div>
            </div>
        </div>

        <!-- Add Marks Start Here -->

    </div>
    <!-- Exam Page End Here -->



    <!-- Footer Page Starts Here -->
    <?php include '../components/admin_footer.php'; ?>

    <!-- For Grade Page Tabs -->
    <script src="../js/demo/grade-page-tabs.js"></script>
</body>
</html>