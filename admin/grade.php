<?php
include '../components/connect.php';

// Check if the delete parameter is set
if (isset($_GET['delete']) && isset($_GET['table'])) {
    $delete_id = $_GET['delete'];
    $table = $_GET['table'];

    // Check if the table name is valid (you can extend this list to other tables if needed)
    $valid_tables = ['grades', 'sections', 'grade_sections', 'years', 'grade_fees'];

    if (in_array($table, $valid_tables)) {
        // Prepare and execute delete query using PDO
        $delete_student = $conn->prepare("DELETE FROM `$table` WHERE id = ?");
        
        if ($delete_student->execute([$delete_id])) {
            header('Location: grade.php');
            exit();
        } else {
            echo "<script>alert('Failed to delete record.');</script>";
        }
    } else {
        echo "<script>alert('Invalid table.');</script>";
    }
}



// Handle Grade Data
if (isset($_POST['grade_name'])) {
    $grade = $_POST['grade_name'];
    echo insertData($conn, 'grades', 'grade_name', [$grade]);
    // Redirect to prevent form resubmission on page refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
// Handle Section Data
if (isset($_POST['section_name'])) {
    $section = $_POST['section_name'];
    echo insertData($conn, 'sections', 'section_name', [$section]);
    // Redirect to prevent form resubmission on page refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
// Handle Grade and Section Data
if (isset($_POST['grade_id']) && isset($_POST['section_id'])) {
    $grade_id = $_POST['grade_id'];
    $section_id = $_POST['section_id'];
    echo insertData($conn, 'grade_sections', 'grade_id, section_id', [$grade_id, $section_id]);
    // Redirect to prevent form resubmission on page refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
// Handle Year Data
if (isset($_POST['year_name'])) {
    $year = $_POST['year_name'];
    echo insertData($conn, 'years', 'year_name', [$year]);
    // Redirect to prevent form resubmission on page refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
// Handle Fees Data
if (isset($_POST['fees'])) {
    $fees = $_POST['fees'];
    $grade_id = $_POST['grade_id'];
    echo insertData($conn, 'grade_fees', 'grade_id, fees', [$grade_id, $fees]);
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
    <title>Grade</title>
</head>
<body id="page-top">

    <!-- Header Page Starts Here -->
    <?php include '../components/admin_header.php'; ?>
    <!-- Header Page End Here -->



    <!-- Grade Components Page Start Here -->
    
    <!-- Components Tittle Start -->
    <nav class="d-flex justify-content-center ">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link" id="nav-fees-in-grade-tab" data-bs-toggle="tab" data-bs-target="#nav-fees-in-grade" type="button" role="tab" aria-controls="nav-fees-in-grade" aria-selected="false">فیس منتخب کرے</button>
            <button class="nav-link" id="nav-add-year-tab" data-bs-toggle="tab" data-bs-target="#nav-add-year" type="button" role="tab" aria-controls="nav-add-year" aria-selected="false">سال کے اندراج</button>
            <button class="nav-link" id="nav-section-in-grade-tab" data-bs-toggle="tab" data-bs-target="#nav-section-in-grade" type="button" role="tab" aria-controls="nav-section-in-grade" aria-selected="false">درجہ میں سیکشن</button>
            <button class="nav-link" id="nav-section-tab" data-bs-toggle="tab" data-bs-target="#nav-section" type="button" role="tab" aria-controls="nav-section" aria-selected="false">سیکشن کی اندراج</button>
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">درجہ کی اندراج</button>
        </div>
    </nav>
    <!-- Components Tittle End -->

    <!-- All Components Start Here -->
    <div class="tab-content ml-4 mr-4" id="nav-tabContent">
        
        <!-- Grade Section Start Here -->
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <form class="row g-3 mt-2" enctype="multipart/form-data" action="grade.php" method="POST" dir="rtl"> 
                <div class="col-md-2 mt-2">
                    <input type="text" class="form-control text-right" name="grade_name" placeholder="درجہ بنائے"  required>
                </div>
                <div class="col-md-2 mt-2">
                    <button class="btn btn-primary" type="submit">محفوظ کرے</button>
                </div>
            </form>
            <div class="d-flex align-items-center justify-content-between py-2">
                <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> رپورٹ بنائے
                </a>
                <h1 class="h3 mb-0 text-800">درج شدہ درجہ</h1>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="table1" width="100%" cellspacing="0">
                            <thead>
                                <tr class='text-center'>
                                    <th>ایکشن</th>
                                    <th>درجہ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $select_fee = $conn->prepare("SELECT * FROM grades");
                                    $select_fee->execute();
                                    if($select_fee->rowCount() > 0) {
                                        while($row = $select_fee->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr class='text-center'>";
                                            echo "<td>
                                                    <a href='updateFeeMenu.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                    <a href='grade.php?delete=" . $row['id'] . "&table=grades' class='btn btn-danger btn-sm' onclick='return confirm(\"Do You Want To Delete The Grade?\");'>Delete</a>
                                                </td>";
                                            echo "<td>{$row['grade_name']}</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                    echo "<tr><td colspan='17' class='text-center'>No data found</td></tr>";
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr class='text-center'>
                                    <th>ایکشن</th>
                                    <th>درجہ</th>
                                </tr>
                            </tfoot>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
         <!-- Grade Section End Here -->
                    
        <!-- Section Start Here -->
        <div class="tab-pane fade" id="nav-section" role="tabpanel" aria-labelledby="nav-section-tab" tabindex="0">
            <form class="row g-3 ml-3 mr-3 mt-2" enctype="multipart/form-data" action="grade.php" method="POST" dir="rtl"> 
                <div class="col-md-2 mt-2">
                    <input type="text" class="form-control text-right" name="section_name" placeholder="سیکشن بنائے"  required>
                </div>
                <div class="col-md-2 mt-2">
                    <button class="btn btn-primary" type="submit">محفوظ کرے</button>
                </div>
            </form>
            <div class="d-sm-flex align-items-center justify-content-between mt-4 p-3">
                <a href="#" class="mr-4 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> رپورٹ بنائے
                </a>
                <h1 class="h3 mb-0 ml-4 text-800"> درج شدہ سیکشن</h1>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center display" id="table2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ایکشن</th>
                                    <th>سیکشن</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $select_fee = $conn->prepare("SELECT * FROM sections");
                                    $select_fee->execute();
                                    if($select_fee->rowCount() > 0) {
                                        while($row = $select_fee->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr>";
                                            echo "<td>
                                                    <a href='updateFeeMenu.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                    <a href='grade.php?delete=" . $row['id'] . "&table=sections' class='btn btn-danger btn-sm' onclick='return confirm(\"Do You Want To Delete The Section?\");'>Delete</a>
                                                </td>";
                                            echo "<td>{$row['section_name']}</td>";
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
                                    <th>سیکشن</th>
                                </tr>
                            </tfoot>                            
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- Section End Here -->
                    
        <!-- Section in Grade Start Here -->
        <div class="tab-pane fade" id="nav-section-in-grade" role="tabpanel" aria-labelledby="nav-section-in-grade-tab" tabindex="0">
            <form class="row g-3 ml-3 mr-3 mt-2" enctype="multipart/form-data" action="grade.php" method="POST" dir="rtl">
                <div class="col-md-2 mt-2">
                    <select class="form-control" role="button" name="grade_id" required>
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
                <div class="col-md-2 mt-2">
                    <select class="form-control" role="button" name="section_id" required>
                        <label class=""></label>                        
                        <option selected disabled value="">سیکشن</option>
                        <?php
                            $select_students = $conn->prepare("SELECT * FROM sections");
                            $select_students->execute();
                            if($select_students->rowCount() > 0) {
                                while($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option>{$row['section_name']}</option>";
                                }
                            } else {
                                echo "<tr>
                                    <td colspan='17'>No data found</td>
                                </tr>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2 mt-2">
                    <button class="btn btn-primary" type="submit">محفوظ کرے</button>
                </div>
            </form>
            <div class="d-sm-flex align-items-center justify-content-between mt-4 p-3">
                <a href="#" class="mr-4 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> رپورٹ بنائے
                </a>           
                <h1 class="h3 mb-0 ml-4 text-800">درج شدہ درجہ میں سیکشن</h1>           
            </div>
            <div class="card shadow mb-4">           
                <div class="card-body">
                    <div class="table-responsive">            
                        <table class="table table-bordered text-center" id="table3" width="100%" cellspacing="0">            
                            <thead>           
                                <tr>           
                                    <th>ایکشن</th>
                                    <th>سیکشن</th>
                                    <th>درجہ</th>           
                                </tr>        
                            </thead>         
                            <tbody>
                                <?php
                                    $select_fee = $conn->prepare("SELECT * FROM grade_sections");
                                    $select_fee->execute();
                                    if($select_fee->rowCount() > 0) {
                                        while($row = $select_fee->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr>";
                                            echo "<td>
                                                    <a href='updateFeeMenu.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                    <a href='grade.php?delete=" . $row['id'] . "&table=grade_sections' class='btn btn-danger btn-sm' onclick='return confirm(\"Do You Want To Delete The Section in Grade?\");'>Delete</a>
                                                </td>";
                                            echo "<td>{$row['section_id']}</td>";
                                            echo "<td>{$row['grade_id']}</td>";

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
                                    <th>سیکشن</th>
                                    <th>درجہ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>        
            </div>            
        </div>
        <!-- Section in Grade Start Here -->

        <!-- Add Year Start Here -->
        <div class="tab-pane fade" id="nav-add-year" role="tabpanel" aria-labelledby="nav-add-year-tab" tabindex="0">       
            <form class="row g-3 ml-3 mr-3 mt-2" enctype="multipart/form-data" action="grade.php" method="POST" dir="rtl">       
                <div class="col-md-2 mt-2">
                    <input type="text" class="form-control text-right" name="year_name" placeholder="سال"  required>
                </div>       
                <div class="col-md-2 mt-2">
                    <button class="btn btn-primary" type="submit">محفوظ کرے</button>
                </div>
            </form>
            <div class="d-sm-flex align-items-center justify-content-between mt-4 p-3">
                <a href="#" class="mr-4 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> رپورٹ بنائے
                </a>
                <h1 class="h3 mb-0 ml-4 text-800">درج شدہ سال</h1>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="table4" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ایکشن</th>
                                    <th>سال</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $select_fee = $conn->prepare("SELECT * FROM years");
                                    $select_fee->execute();
                                    if($select_fee->rowCount() > 0) {
                                        while($row = $select_fee->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr>";
                                            echo "<td>
                                                    <a href='updateFeeMenu.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                    <a href='grade.php?delete=" . $row['id'] . "&table=years' class='btn btn-danger btn-sm' onclick='return confirm(\"Do You Want To Delete The Year?\");'>Delete</a>
                                                </td>";
                                            echo "<td>{$row['year_name']}</td>";

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
                                    <th>سال</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Year End Here -->
         
        <!-- Fees in Grade Start Here -->
        <div class="tab-pane fade" id="nav-fees-in-grade" role="tabpanel" aria-labelledby="nav-fees-in-grade-tab" tabindex="0">
            <form class="row g-3 ml-3 mr-3 mt-2" enctype="multipart/form-data" action="grade.php" method="POST" dir="rtl">
                <div class="col-md-2 mt-2">
                    <select class="form-control" role="button" name="grade_id" required>                       
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
                <div class="col-md-2 mt-2">
                    <input type="text" class="form-control" name="fees" placeholder="فیس" required>
                </div>
                <div class="col-md-2 mt-2">
                <button class="btn btn-primary" type="submit">محفوظ کرے</button>
                </div>
            </form>
            <div class="d-sm-flex align-items-center justify-content-between mt-4 p-3">
                <a href="#" class="mr-4 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> رپورٹ بنائے
                </a>
                <h1 class="h3 mb-0 ml-4 text-800">درج شدہ فیس</h1>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="table5" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ایکشن</th>
                                    <th>درجہ</th>
                                    <th>فیس</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $select_fee = $conn->prepare("SELECT * FROM grade_fees");
                                    $select_fee->execute();
                                    if($select_fee->rowCount() > 0) {
                                        while($row = $select_fee->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr>";
                                            echo "<td>
                                                    <a href='updateFeeMenu.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                    <a href='grade.php?delete=" . $row['id'] . "&table=grade_fees' class='btn btn-danger btn-sm' onclick='return confirm(\"Do You Want To Delete The Grade Fees?\");'>Delete</a>
                                                </td>";
                                            echo "<td>{$row['fees']}</td>";
                                            echo "<td>{$row['grade_id']}</td>";

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
                                    <th>فیس</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fees in Grade Start Here -->
    </div>
    <!-- All Components End Here -->
    <!-- Grade Components Page End Here -->


    <!-- Footer Page Starts Here -->
    <?php include '../components/admin_footer.php'; ?>
    <!-- Footer Page End Here -->


    <!-- For Grade Page Tabs -->
    <script src="../js/demo/grade-page-tabs.js"></script>
</body>
</html>