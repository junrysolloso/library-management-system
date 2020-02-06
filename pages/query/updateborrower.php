<?php
  require_once '../../pages/class/connection.php';
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['borrowerId'])) {
      extract($_GET);
      $st = $conn->prepare("UPDATE `info_borrower` SET `studentid` = ?, `firstname` = ?, `middlename` = ?,
      `lastname` = ?, `phone` = ?, `address` = ? WHERE `borrowerId` = ?");
      if ($st->bind_param("ssssssi", $studentid, $firstname, $middlename, $lastname, $phone, $address, $borrowerId)) {
        if ($st->execute()) {
          $st = $conn->prepare("UPDATE `info_borrowerjunc` INNER JOIN `info_borrower` SET `levelId` = (SELECT `levelId` FROM `info_level` WHERE `levelName` = ?) WHERE info_borrowerjunc.borrowerId = ?");
          if ($st->bind_param("si", $levelName, $borrowerId)) {
            if ($st->execute()) {
              echo 1;
            } else {echo 0;}
          }
        }
      }
    }
  }
?>
