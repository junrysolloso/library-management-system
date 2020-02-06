  <?php
    session_start();
    if (!isset($_SESSION['userId'])) {
      echo '<script>window.location="login.php"</script>';
    }
  ?>
  <nav class="w3-sidenav w3-collapse w3-white w3-animate-left w3-card-2" style="z-index:5;width:250px;">
    <a href="#" class="w3-border-bottom w3-large w3-center"><img src="<?php echo $dirImage; ?>images/logo.png" style="width:50%;"></a>
    <a href="javascript:void(0)" onclick="w3_close()"
    class="w3-text-teal w3-hide-large w3-closenav w3-large">Close &times;</a>
    <a href="<?php echo $dirIndex; ?>index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
    <a href="<?php echo $dirPage; ?>view/transaction.php"><i class="fa fa-share-square-o"></i> Registration</a>
    <a href="<?php echo $dirPage; ?>view/borrowed.php"><i class="fa fa-reply-all"></i> Transaction</a>
    <div class="w3-accordion">
    <a onclick="myFunc('Demo3')" href="javascript:void(0)"><i class="fa fa-print"></i> Reports</a>
    <div id="Demo3" class="w3-accordion-content w3-animate-left w3-padding">
      <a href="<?php echo $dirPage; ?>view/resources.php"><i class="fa fa-circle-o"></i> Card Catalog</a>
      <a href="#categoryModal" data-toggle="modal"><i class="fa fa-circle-o"></i> Category</a>
      <a href="<?php echo $dirPage; ?>view/printpreview.php"><i class="fa fa-circle-o"></i> Report</a>
    </div>
  </div>

  </nav>
  <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer"></div>
  <div class="w3-main" style="margin-left:250px;">
    <div id="myTop" class="w3-top w3-container w3-padding-16 w3-theme w3-large">
      <i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-right" onclick="w3_open()"></i>
      <span id="myIntro" class="w3-hide">DREESMNHS Library Management System</span>
    </div>
    <header class="w3-container w3-theme w3-padding-16 w3-padding-jumbo w3-card-8">
      <h1 class="w3-xxxlarge w3-padding-16">
        Library Management System
        <a href="<?php echo $dirPage; ?>view/logout.php#" class="w3-btn w3-teal small pull-right"><i class="fa fa-sign-out"></i>Log-out</a>
      </h1>
    </header>
