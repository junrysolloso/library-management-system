  <?php
    $page = basename($_SERVER['PHP_SELF']);
    $dirImage = "upload/";
    $dirAssets = "assets/";
    $dirPage = "pages/";
    $dirIndex = "";
    if ($page !== "index.php" && $page !== "login.php") {
      $dirImage = "../../upload/";
      $dirAssets = "../../assets/";
      $dirPage = "../../pages/";
      $dirIndex = "../../";
    }
    include_once $dirPage.'class/connection.php';
  ?>
  <title>Library Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image" href="<?php echo $dirImage; ?>images/icon.png">
  <link rel="stylesheet" href="<?php echo $dirAssets; ?>css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo $dirAssets; ?>font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo $dirAssets; ?>bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo $dirAssets; ?>datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $dirAssets; ?>css/w3.css">
  <link rel="stylesheet" href="<?php echo $dirAssets; ?>css/w3Teal.css">
  <style>
    html, body, h1, h2, h3, h4, h5 {font-family: "RobotoDraft","Roboto",sans-serif;}
    .w3-sidenav a {padding:16px;font-weight:bold}
  </style>
