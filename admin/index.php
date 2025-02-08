<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MMS</title>
</head>
<body id="page-top">

    <!-- Header Page Starts Here -->
    <?php include '../components/admin_header.php'; ?>

    <!-- Home Page Starts Here -->
    <div class="bg-image">
        <canvas id="animated-background"></canvas>


        <!-- Earnings (Monthly) Card Example --> 
        <?php
            $select_students = $conn->prepare("SELECT * FROM `add_student`");
            $select_students->execute();
            $number_of_students = $select_students->rowCount()
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="addStudent.php" style="text-decoration: none;">
                <div class="card border-left-primary text-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Total Students
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-800">
                                    <?= $number_of_students; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-graduate fa-2x text-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <?php
            $select_teachers = $conn->prepare("SELECT * FROM `add_teacher`");
            $select_teachers->execute();
            $number_of_teachers = $select_teachers->rowCount()
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="addTeacher.php" style="text-decoration: none;">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body text-info">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Total Teachers
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-800">
                                            <?= $number_of_teachers; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x text-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="#" style="text-decoration: none;">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters text-success align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Dummy Balance
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-800">
                                    215,000/- 
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="#" style="text-decoration: none;">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center text-warning ">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Total subjects</div>
                                <div class="h5 mb-0 font-weight-bold text-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- See Messages Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="messages.php" style="text-decoration: none;">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center text-warning ">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    See Messages
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-800">
                                    18
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- Home Page End Here -->

    <!-- Footer Page Starts Here -->
    <?php include '../components/admin_footer.php'; ?>
</body>
</html>
