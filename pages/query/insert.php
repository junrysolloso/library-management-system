<?php
  require_once '../../pages/class/connection.php';
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
      $id = htmlspecialchars(trim($_GET['id']));
      $action = htmlspecialchars(trim($_GET['action']));
      if ($action == "insert") {
        $st = $conn->prepare("INSERT INTO `info_tmp` (`bookId`) VALUES (?)");
        if ($st->bind_param("i", $id)) {
          $st->execute();
        }
      } else {
        $st = $conn->prepare("DELETE FROM `info_tmp` WHERE `bookId` = ?");
        if ($st->bind_param("i", $id)) {
          $st->execute();
        }
      }
    }
  }
?>
