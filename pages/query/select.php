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
      $t = ""; $id = htmlspecialchars(trim($_GET['id']));
      if (iCheckExisting("info_tmp", "tmpId", "bookId", $id)) {
        echo 1;
      } else {
        $st = $conn->prepare("INSERT INTO `info_tmp` (`bookId`) VALUES (?)");
        if ($st->bind_param("i", $_GET['id'])) {
          if ($st->execute()) {
            $st = $conn->prepare("SELECT info_book.bookId, `bookNo`, `bookName`, `bookCat`, `bookAut`, `bookPub`, `bookEdit` FROM `info_book`
            INNER JOIN `info_bookjunc` ON info_book.bookId = info_bookjunc.bookId
            INNER JOIN `info_bookcat`  ON info_bookcat.bookCatId = info_bookjunc.bookCatId
            INNER JOIN `info_bookaut`  ON info_bookaut.bookAutId = info_bookjunc.bookAutId
            INNER JOIN `info_bookpub`  ON info_bookpub.bookPubId = info_bookjunc.bookPubId
            INNER JOIN `info_bookedit` ON info_bookedit.bookEditId = info_bookjunc.bookEditId
            INNER JOIN `info_tmp` ON info_tmp.bookId = info_bookjunc.bookId ");
            if ($st->execute()) {
              $r = $st->get_result();
              while ($f = $r->fetch_array()) {
                $t .= '<tr>';
                $t .= '<td>'.$f["bookNo"].'</td>';
                $t .= '<td>'.$f["bookName"].'</td>';
                $t .= '<td>'.$f["bookCat"].'</td>';
                $t .= '<td>'.$f["bookAut"].'</td>';
                $t .= '<td>'.$f["bookPub"].'</td>';
                $t .= '<td class="w3-center"><a href="selectRemove.php?q='.$f["bookId"].'" class="w3-btn w3-red w3-small"><i class="fa fa-minus"></i></a></td>';
                $t .= '</tr>';
              }
              echo $t;
            }
          }
        }
      }
    }
  }
?>
