<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Madrasa.com</title>
  <link href="vendor/user_assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/user_assets/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
</head>
<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top shadow">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">Madarsa.com</h1>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>"><a href="index.php">Home</a></li>
          <li class="<?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>"><a href="about.php">About</a></li>
          <li class="<?= basename($_SERVER['PHP_SELF']) == 'courses.php' ? 'active' : '' ?>"><a href="courses.php">Courses</a></li>
          <li class="<?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : '' ?>"><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="admin/index.php">Login</a>
    </div>
  </header>

  <!-- Main JS File -->
  <script src="js/main.js"></script>
</body>
</html>