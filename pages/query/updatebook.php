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
    if (isset($_GET['bookNo'])) {
      extract($_GET);
      $st = $conn->prepare("UPDATE `info_book` SET `bookNo` = ?, `bookName`= ?, `bookISBN` = ?, `bookPlace` = ?, `bookCopy` = ? WHERE `bookId` = ?");
      if ($st->bind_param("ssssii", $bookNo, $bookName, $bookISBN, $bookPlace, $bookCopy, $bookId)) {
        if ($st->execute()) {

          // Insert Book Author
          if (!iCheckExisting("info_bookaut", "bookAutId", "bookAut", $bookAut)) {
            $st = $conn->prepare("INSERT INTO `info_bookaut` (`bookAut`) VALUES (?)");
            if ($st->bind_param("s", $bookAut)) {
              $st->execute();
            }
          }

          // Insert Book Publisher
          if (!iCheckExisting("info_bookpub", "bookPubId", "bookPub", $bookPub)) {
            $st = $conn->prepare("INSERT INTO `info_bookpub` (`bookPub`) VALUES (?)");
            if ($st->bind_param("s", $bookPub)) {
              $st->execute();
            }
          }

          // Insert Book Published Year
          if (!iCheckExisting("info_bookyear", "bookYearId", "bookYear", $bookYear)) {
            $st = $conn->prepare("INSERT INTO `info_bookyear` (`bookYear`) VALUES (?)");
            if ($st->bind_param("s", $bookYear)) {
              $st->execute();
            }
          }

          // Update Junction Table
          $st = $conn->prepare("UPDATE `info_bookjunc` INNER JOIN `info_bookaut`
          SET info_bookjunc.bookAutId = (SELECT `bookAutId` FROM `info_bookaut` WHERE `bookAut` = ?),
          info_bookjunc.bookCatId = (SELECT `bookCatId` FROM `info_bookcat` WHERE `bookCat` = ?),
          info_bookjunc.bookStatId = (SELECT `bookStatId` FROM `info_bookstat` WHERE `bookStat` = ?),
          info_bookjunc.bookYearId = (SELECT `bookYearId` FROM `info_bookyear` WHERE `bookYear` = ?),
          info_bookjunc.bookPubId = (SELECT `bookPubId` FROM `info_bookpub` WHERE `bookPub` = ?) WHERE `bookId` = ?");
          if ($st->bind_param("sssssi", $bookAut, $bookCat, $bookStat, $bookYear, $bookPub, $bookId)) {
            if ($st->execute()) {
              echo 1;
            } else {echo 0;}
          }
        }
      }
    }
  }
