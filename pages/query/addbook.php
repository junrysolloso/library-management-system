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
      if (iCheckExisting("info_book", "bookId", "bookNo", $bookNo)) {
        echo 2;
      } else {
        $st = $conn->prepare("INSERT INTO `info_book` (`bookNo`, `bookName`, `bookISBN`, `bookCopy`, `bookPlace`) VALUES (?, ?, ?, ?, ?)");
        if ($st->bind_param("sssss", $bookNo, $bookName, $bookISBN, $bookCopy, $bookPlace)) {
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

            // insert Junction Table
            $st = $conn->prepare("INSERT INTO `info_bookjunc` (`bookId`, `bookAutId`, `bookCatId`, `bookPubId`, `bookStatId`, `bookYearId`)
            SELECT MAX(bookId), (SELECT `bookAutId` FROM `info_bookaut` WHERE `bookAut` = ?),
            (SELECT `bookCatId` FROM `info_bookcat` WHERE `bookCat` = ?),
            (SELECT `bookPubId` FROM `info_bookpub` WHERE `bookPub` = ?),
            (SELECT `bookStatId` FROM `info_bookstat` WHERE `bookStat` = ?),
            (SELECT `bookYearId` FROM `info_bookyear` WHERE `bookYear` = ?) FROM `info_book`");
            if ($st->bind_param("sssss", $bookAut, $bookCat, $bookPub, $bookStat, $bookYear)) {
              if ($st->execute()) {
                echo 1;
              } else {echo 0;}
            }
          }
        }
      }
    }
  }
?>
