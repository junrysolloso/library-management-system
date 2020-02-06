<?php
  require_once '../../pages/class/connection.php';
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
      $id = htmlspecialchars(trim($_GET['id']));
      $st = $conn->prepare("DELETE FROM `info_borrower` WHERE `borrowerId` = ?");
      if ($st->bind_param("i", $id)) {
        if ($st->execute()) {
          $st = $conn->prepare("DELETE FROM `info_borrowedjunc` WHERE `borrowerId` = ?");
          if ($st->bind_param("i", $id)) {
            if ($st->execute()) {
              $st = $conn->prepare("DELETE FROM `info_borrowerjunc` WHERE `borrowerId` = ?");
              if ($st->bind_param("i", $id)) {
                if ($st->execute()) {
                  echo 1;
                }
              }
            }
          }
        }
      }
    }
  }
?>
