<?php
  require_once '../../pages/class/connection.php';
  function  iCheckExisting($tbl, $col, $pat, $val)
  {
    $connection = new connection();
    $conn = $connection->connect();
    $st = $conn->prepare("SELECT `$col` FROM `$tbl` WHERE `$pat` = ?");
    if ($st->bind_param("s", $val)) {
      if ($st->execute()) {
        $r = $st->get_result();
        $f = $r->fetch_array();
        if ($f[0] > 0) {
          return true;
        } else {return false;}
      }
    }
  }
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['studentid'])) {
      $studentid = htmlspecialchars(trim($_GET['studentid']));
      $borrowedjuncId = htmlspecialchars(trim($_GET['borrowedjuncId']));
      $t = date('m:d:y');
      $date = date('Y-m-d', strtotime($t));
      if (!iCheckExisting("info_return", "returnId", "returnDate", $date)) {
        $st = $conn->prepare("INSERT INTO `info_return`(`returnDate`) VALUES (?)");
        if ($st->bind_param("s", $date)) {
          $st->execute();
        }
      }
      $st = $conn->prepare("UPDATE `info_borrowedjunc` INNER JOIN  `info_return`
      SET info_borrowedjunc.returnId = (SELECT `returnId` FROM `info_return` WHERE `returnDate` = ?)
      WHERE `borrowedjuncId` = ?");
      if ($st->bind_param("si", $date, $borrowedjuncId)) {
        if ($st->execute()) {
          $st = $conn->prepare("UPDATE `info_book` SET `bookCopy` = (`bookCopy` + 1)
          WHERE `bookId` = (SELECT `bookId` FROM `info_borrowedjunc` WHERE `borrowedjuncId` = ?)");
          if ($st->bind_param("i", $borrowedjuncId)) {
            if ($st->execute()) {
              echo 1;
            } else {echo 0;}
          }
        }
      }
    }
  }
?>
