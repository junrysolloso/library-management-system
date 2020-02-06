<?php
  require_once '../../pages/class/connection.php';
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['q'])) {
      $id = htmlspecialchars(trim($_GET['q']));
      $st = $conn->prepare("DELETE FROM `info_tmp` WHERE `bookId` = ?");
      if ($st->bind_param("i", $id)) {
        if ($st->execute()) {
          echo "<script>window.location='resources.php?q=done';</script>";
        }
      }
    }
  }
?>
