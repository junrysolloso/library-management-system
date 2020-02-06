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
  if (isset($_GET['id'])) {
    $id = htmlspecialchars(trim($_GET['id']));
    $flag = 0;
    $t = date('m:d:y');
    $date = date('Y-m-d', strtotime($t));
      $st = $conn->prepare("SELECT COUNT(tmpId) FROM `info_tmp`");
      if ($st->execute()) {
        $r = $st->get_result();
        $f = $r->fetch_array();
      }
      if ($f[0] > 0) {
        if (iCheckExisting("info_borrower", "borrowerId", "studentid", $id)) {
          $st = $conn->prepare("SELECT `bookId` FROM `info_tmp`");
          if ($st->execute()) {
            $r = $st->get_result();
            while ($f = $r->fetch_array()) {
              // Update no of copies
              $st = $conn->prepare("UPDATE `info_book` SET `bookCopy` = (`bookCopy` - 1) WHERE `bookId` = ?");
              if ($st->bind_param("i", $f["bookId"])) {
                $st->execute();
              }
              // Insert Date
              if (!iCheckExisting("info_borrowed", "borrowedId", "borrowedDate", $date)) {
                $st = $conn->prepare("INSERT INTO `info_borrowed` (`borrowedDate`) VALUES (?)");
                if ($st->bind_param("s", $date)) {
                  $st->execute();
                }
              }
              // Insert Borrowed
              $st = $conn->prepare("INSERT INTO `info_borrowedjunc` (`borrowedId`, `borrowerId`, `bookId`)
              SELECT `borrowedId`, (SELECT `borrowerId` FROM `info_borrower` WHERE `studentid` = ?), ? FROM `info_borrowed` WHERE `borrowedDate` = ? ");
              if ($st->bind_param("sss", $id, $f["bookId"], $date)) {
                if ($st->execute()) {
                  $st = $conn->prepare("TRUNCATE TABLE `info_tmp`");
                  if ($st->execute()) {
                    $flag++;
                  }
                }
              }
            }
            if ($flag > 0) {
              echo 1;
            }
          }
        } else {
          echo 2;
        }
      } else {
        echo 3;
      }
    }
  }
?>
