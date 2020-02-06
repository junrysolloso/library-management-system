<?php
  require_once '../../pages/class/connection.php';
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['go'])) {
      $st = $conn->prepare("TRUNCATE TABLE `info_tmp`");
      if ($st->execute()) {
        echo 1;
      }
    }
  }
?>
