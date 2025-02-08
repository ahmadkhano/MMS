<?php
include '../components/connect.php';

// Check if the delete parameter is set
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $delete_student = $conn->prepare("DELETE FROM `teacher_designation` WHERE id = ?");
    if ($delete_student->execute([$delete_id])) {
        header('Location:teacherDesignation.php');
        exit();
    } else {
        echo "<script>alert('Failed to delete Grade, please try again.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $designation = filter_var($_POST['designation'], FILTER_SANITIZE_STRING);
    $stmt = $conn->prepare("INSERT INTO teacher_designation (`designation`) VALUES (?)");

    if ($stmt->execute([$designation])) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
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
    <title>Teacher Designation</title>
</head>
<body id="page-top">
    <!-- Header Page Starts Here -->
    <?php include '../components/admin_header.php'; ?>
    <!-- Header Page End Here -->

    <!-- Add Teacher Designation Page Start Here -->
    <div class="ml-4 mr-4">

        <!-- Add Teacher Designation Tittle -->
        <div class="d-sm-flex align-items-center justify-content-between py-4 rounded">
            <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-arrow-left"></i> واپس جائے 
            </a>
            <h1 class="h3 mb-0 text-800">اساتذہ کے عھدہ کے اندراج کیجئے</h1>
        </div>
        <!-- Add Teacher Designation Tittle -->

        <!-- Add New Students Form Start Here -->
        <form class="row g-3" enctype="multipart/form-data" action="teacherDesignation.php" method="POST" dir="rtl"\>
            <div class="col-md-2">
                <input type="text" class="form-control text-right" name="designation" placeholder="عھدہ" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" type="submit">محفوظ کرے</button>
            </div>
        </form>
        <!-- Add Teacher Designation Form End Here -->

        <!-- Added Teacher Designation Tittle -->
        <div class="d-sm-flex align-items-center justify-content-between py-4">
            <a href="#" class="mr-4 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> رپورٹ بنائے
            </a>
            <h1 class="h3 mb-0 ml-4 text-800">درج شدہ عھدے</h1>
        </div>
        <!-- Added Teacher Designation Tittle -->

        <!-- Added Teacher Designation Table Start Here -->
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="table11" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ایکشن</th>
                                <th>عھدہ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $select_students = $conn->prepare("SELECT * FROM teacher_designation");
                                $select_students->execute();
                                if($select_students->rowCount() > 0) {
                                    while($row = $select_students->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>
                                                <a href='updateAddStudent.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                                <a href='teacherDesignation.php?delete=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Do You Want To Delete This Grade?\");'>Delete</a>
                                            </td>";
                                        echo "<td>{$row['designation']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='2' class='text-center'>No data found</td></tr>";
                                }
                            ?>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th>ایکشن</th>
                                <th>عھدہ</th>
                            </tr>
                        </tfoot>                            
                    </table>
                </div>
            </div>
        </div>
        <!-- Added Teacher Designation Table End Here -->
    </div>
    <!-- Add Teacher Designation Page End Here -->

    <!-- Footer Page Starts Here -->
    <?php include '../components/admin_footer.php'; ?>
    <!-- Footer Page End Here -->
</body>
</html>