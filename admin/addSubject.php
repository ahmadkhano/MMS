<?php
include '../components/connect.php';

// Handle Delete Action
if (isset($_GET['delete']) && isset($_GET['table'])) {
    $delete_id = $_GET['delete'];
    $table = $_GET['table'];

    // Validate table name to prevent SQL injection
    $valid_tables = ['add_subject', 'assign_subject'];
    if (in_array($table, $valid_tables)) {
        // Use prepared statements for secure deletion
        $delete_subject = $conn->prepare("DELETE FROM `$table` WHERE id = ?");
        if ($delete_subject->execute([$delete_id])) {
            header('Location: addSubject.php');
            exit();
        } else {
            echo "<script>alert('Failed to delete record.');</script>";
        }
    } else {
        echo "<script>alert('Invalid table.');</script>";
    }
}

// Function to insert data into any table
function insertData($conn, $table, $columns, $values) {
    $columns_str = implode(',', $columns); // Convert array to string
    $placeholders = implode(',', array_fill(0, count($values), '?'));
    $sql = "INSERT INTO $table ($columns_str) VALUES ($placeholders)";
    
    $stmt = $conn->prepare($sql);

    foreach ($values as $key => $value) {
        $stmt->bindValue($key + 1, $value, PDO::PARAM_STR);
    }

    if ($stmt->execute()) {
        return "Data inserted successfully.";
    } else {
        $error = $stmt->errorInfo();
        return "Error: " . $error[2];
    }
}


// Handle Add Subject Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject_name'])) {
    $subject_name = $_POST['subject_name'];
    echo insertData($conn, 'add_subject', ['subject_name'], [$subject_name]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle Assign Subject Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign_subject_grade'])) {
    $assign_subject_grade = $_POST['assign_subject_grade'];
    $assign_subject_subject = $_POST['assign_subject_subject'];
    $assign_subject_teacher = $_POST['assign_subject_teacher'];
    $assign_subject_total_marks = $_POST['assign_subject_total_marks'];

    $result = insertData(
        $conn,
        'assign_subject',
        ['assign_subject_grade', 'assign_subject_subject', 'assign_subject_teacher', 'assign_subject_total_marks'],
        [$assign_subject_grade, $assign_subject_subject, $assign_subject_teacher, $assign_subject_total_marks]
    );
    // Redirect with a success message
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Subject</title>
<body id="page-top">

    <!-- Header Page Starts Here -->
    <?php include '../components/admin_header.php'; ?>
    <!-- Header Page End Here -->

    <!-- Add Subject Tabs Tittle -->
    <nav class="d-flex justify-content-center mt-4">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link" id="nav-assign-subject-tab" data-bs-toggle="tab" data-bs-target="#nav-assign-subject" type="button" role="tab" aria-controls="nav-assign-subject" aria-selected="true">مضمون سپرد کرے</button>
            <button class="nav-link active" id="nav-add-subject-tab" data-bs-toggle="tab" data-bs-target="#nav-add-subject" type="button" role="tab" aria-controls="nav-add-subject" aria-selected="true">مضمون کی اندراج</button>
        </div>
    </nav>
    <!-- Add Subject Tabs Tittle --> 

    <!-- Add Subject Form And Table -->
    <div class="tab-content" id="nav-tabContent">
        <!-- Add Subject Start Here -->
        <div class="tab-pane fade show active" id="nav-add-subject" role="tabpanel" aria-labelledby="nav-add-subject-tab" tabindex="0">
            <form class="row g-3 ml-4 mr-4 mt-4" enctype="multipart/form-data" action="addSubject.php" method="POST" dir="rtl">
                <div class="col-md-2">
                    <input type="text" class="form-control text-right" name="subject_name" placeholder="مضمون" required>      
                </div>        
                <div class="col-md-2">
                    <button class="btn btn-primary" type="submit">محفوظ کرے</button>
                </div>
            </form>
            <div class="d-flex align-items-center justify-content-between mr-4 ml-4 py-2">
                <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-50"></i> رپورٹ بنائے
                </a>
                <h1 class="h3 mb-0 text-800">درج شدہ مضمون</h1>
            </div>
            <div class="card shadow mb-4 ml-4 mr-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ایکشن</th>
                                    <th>مضمون</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // Assuming you have a database connection in $conn
                                    $select_subject = $conn->prepare("SELECT * FROM add_subject");
                                    $select_subject->execute();
                                    // Check if the query was successful
                                    if($select_subject->rowCount() > 0) {
                                        while($row = $select_subject->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr>";
                                            echo "<td>
                                                <a href='updateAddSubject.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                <a href='addSubject.php?delete=" . $row['id'] . "&table=add_subject' class='btn btn-danger btn-sm' onclick='return confirm(\"Do You Want To Delete This Subject?\");'>Delete</a>
                                            </td>";
                                            echo "<td>{$row['subject_name']}</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>
                                            <td colspan='17'>No data found</td>
                                        </tr>";
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ایکشن</th>
                                    <th>مضمون</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Subject End Here -->
                    
        <!-- Assign Subject Start Here -->
        <div class="tab-pane fade text-center" id="nav-assign-subject" role="tabpanel" aria-labelledby="nav-assign-subject-tab" tabindex="0">
            <form class="row g-3 ml-3 mr-3 mt-4" enctype="multipart/form-data" action="addSubject.php" method="POST" dir="rtl">
                <div class="col-md-2">
                    <select class="form-control" name="assign_subject_grade" required>
                        <option selected disabled value="">درجہ</option>
                        <?php
                            $select_students = $conn->prepare("SELECT * FROM grades");
                            $select_students->execute();
                            if($select_students->rowCount() > 0) {
                                while($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option>{$row['grade_name']}</option>";
                                }
                            } else {
                                echo "<tr>
                                    <td colspan='17'>No data found</td>
                                </tr>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="assign_subject_subject" required>
                        <option selected disabled value="">مضمون </option>
                        <?php
                            $select_students = $conn->prepare("SELECT * FROM add_subject");
                            $select_students->execute();
                            if($select_students->rowCount() > 0) {
                                while($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option>{$row['subject_name']}</option>";
                                }
                            } else {
                                echo "<tr>
                                    <td colspan='17'>No data found</td>
                                </tr>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="assign_subject_teacher" required>
                        <option selected disabled value="">استاد</option>
                        <?php
                            $select_students = $conn->prepare("SELECT * FROM add_teacher");
                            $select_students->execute();
                            if($select_students->rowCount() > 0) {
                                while($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option>{$row['teacher_name']}</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="assign_subject_total_marks" placeholder="ٹوٹل نمبر" required>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" type="submit">محفوظ کرے</button>
                </div>
            </form>
            <div class="d-sm-flex align-items-center justify-content-between mt-4 p-3">
                <a href="#" class="mr-4 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> رپورٹ بنائے
                </a>
                <h1 class="h3 mb-0 ml-4 text-800">سپرد شدہ مضمون</h1>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ایکشن</th>
                                    <th>ٹوٹل نمبر</th>
                                    <th>استاد</th>
                                    <th>مضمون</th>
                                    <th>درجہ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // Assuming you have a database connection in $conn
                                    $select_students = $conn->prepare("SELECT * FROM assign_subject");
                                    $select_students->execute();
                                    // Check if the query was successful
                                    if($select_students->rowCount() > 0) {
                                        while($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr>";
                                                echo "<td>
                                                        <a href='updateAddStudent.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                        <a href='addSubject.php?delete=" . $row['id'] . "&table=assign_subject' class='btn btn-danger btn-sm' onclick='return confirm(\"Do You Want To Delete This Student?\");'>Delete</a>
                                                    </td>";
                                                echo "<td>{$row['assign_subject_total_marks']}</td>";
                                                echo "<td>{$row['assign_subject_teacher']}</td>";
                                                echo "<td>{$row['assign_subject_subject']}</td>";
                                                echo "<td>{$row['assign_subject_grade']}</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ایکشن</th>
                                    <th>ٹوٹل نمبر</th>
                                    <th>استاد</th>
                                    <th>مضمون</th>
                                    <th>درجہ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Assign Subjet End Here -->
    </div>
    <!-- Add Subject Form And Table -->

    <!-- Footer Page Starts Here -->    
     <?php include '../components/admin_footer.php'; ?>

    <!-- For Grade Page Tabs -->
    <script src="../js/demo/grade-page-tabs.js"></script>
</body>
</html>