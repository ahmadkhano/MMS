<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../components/connect.php';
$admin_id = $_SESSION['admin_id'] ?? null;
if (!isset($admin_id)) {
    header('location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Header</title>
    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="..\vendor\datatables\dataTables.bootstrap4.min.css">
    <!-- Printing Page scripts -->
    <script src="../js/demo/html2pdf.bundle.js"></script>
</head>
<body id="page-top">

    <!-- Header Page Start Here -->
    <div id="content-wrapper" class="d-flex flex-column">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light topbar static-top shadow">

                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control border-1 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 small"
                                        placeholder="Search for..." aria-label="Search"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Night Mode -->
                    <li class="nav-item no-arrow mx-1">
                        <a class="nav-link " id="nightModeToggle" onclick="toggleNightMode()" role="button">
                            <i class="fas fa-moon"></i>
                        </a>                        
                    </li>

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">1</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="../img/undraw_profile_1.svg"alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                        problem I've been having.</div>
                                    <div class="small text-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-500" href="messages.php">Read More Messages</a>
                        </div>
                    </li>
                    
                    <!-- Nav Item - Divider -->
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <?php
                            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
                            $select_profile->execute([$admin_id]);
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-600 small"><?= $fetch_profile['name']; ?></span>
                            <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <a class="dropdown-item" href="../components/logout.php" onclick="return confirm('Logout From The Madrasa Website?');">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>

            </nav>
            <!-- End of Topbar -->


            
            <!-- Header -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-primary shadow">
                <div class="container-fluid">
                    <!-- Madrasa Brand -->
                    <a class="navbar-brand d-flex align-items-center" href="/MMS/admin/">
                        <i class="fas fa-laugh-wink"></i>
                        <span class="mx-3">احمد</span>
                    </a>

                    <!-- Toggler for mobile view -->
                    <button class="navbar-toggler" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Toggler for mobile view -->


                    <!-- Navigation Links -->
                    <div class="collapse navbar-collapse" id="navbarContent">
                        <ul class="navbar-nav ml-auto">
                            
                            <!-- Reports -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="componentsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                رپورٹ بنائے
                                </a>
                                <div class="dropdown-menu mr-4" aria-labelledby="componentsDropdown">
                                    <a class="dropdown-item d-flex align-items-center" href="../admin/addStudent.php">
                                        <span class="ml-auto"> طالبات</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="../admin/addTeacher.php">
                                        <span class="ml-auto"> اساتذہ</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="/MMS/admin/feeMenu.php">
                                        <span class="ml-auto">داخلہ فارم</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="/MMS/admin/grade.php">
                                        <span class="ml-auto">Shanakhat nama</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="/MMS/admin/passFail.php">
                                        <span class="ml-auto">Kashfu aldarajat</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="/MMS/admin/passFail.php">
                                        <span class="ml-auto">Fazlaat</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="/MMS/admin/passFail.php">
                                        <span class="ml-auto">Tamam Mujood Talbaat</span>
                                    </a>
                                </div>
                            </li>

                            <!-- Subjects and Exams -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="subjectsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                مزمون اور امتحان
                                </a>
                                <div class="dropdown-menu" aria-labelledby="subjectsDropdown">
                                    <a class="dropdown-item" href="/MMS/admin/addSubject.php">
                                        <i class="fas fa-user-plus"></i>
                                        <span class="ml-auto">مزمون کے اندراج</span>
                                    </a>
                                    <a class="dropdown-item" href="/MMS/admin/exam.php">
                                        <i class="fas fa-user-plus"></i>
                                        <span class="ml-auto">امتحان</span>
                                    </a>
                                </div>
                            </li>

                            <!-- Teachers -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="teachersDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                اساتذہ
                                </a>
                                <div class="dropdown-menu" aria-labelledby="teachersDropdown">
                                    <a class="dropdown-item d-flex align-items-center" href="/MMS/admin/addTeacher.php">
                                        <i class="fas fa-user-plus"></i>
                                        <span class="ml-auto">اساتذہ اندراج</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="/MMS/admin/teacherDesignation.php">
                                        <i class="fas fa-male"></i>
                                        <span class="ml-auto">اساتذہ کا عہدہ</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="/MMS/admin/teacherSalary.php">
                                        <i class="fas fa-hand-holding-usd"></i>
                                        <span class="ml-auto">اساتذہ کی تنخواہ</span>
                                    </a>
                                </div>
                            </li>

                            <!-- Components -->
                            <li class="nav-item dropdown students">
                                <a class="nav-link dropdown-toggle" href="#" id="componentsDropdown" 
                                    role="button" data-toggle="dropdown" aria-haspopup="true" 
                                    aria-expanded="false">
                                    طلبات  
                                </a>
                                <div class="dropdown-menu mr-8" aria-labelledby="componentsDropdown">
                                    <a class="dropdown-item d-flex align-items-center" href="/MMS/admin/addStudent.php">
                                        <i class="fas fa-user-plus"></i>
                                        <span class="ml-auto">طالِبات</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="/MMS/admin/feeMenu.php">
                                        <i class="fas fa-signal"></i>
                                        <span class="ml-auto">اِنْدِراج فِیس</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="/MMS/admin/grade.php">
                                        <i class="fas fa-fw fa-cog"></i>
                                        <span class="ml-auto">درجہ بنائے</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="/MMS/admin/passFail.php">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="ml-auto">طالِبات سرفرازی</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End of Header -->
        </div>
    </div>
    <!-- Header Page End Here -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
    $('.dropdown-toggle').dropdown();
    });    
</script>




    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../js/sb-admin-2.js"></script>
    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>
