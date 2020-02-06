<?php
  require_once '../../pages/class/connection.php';
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
      $id = htmlspecialchars(trim($_GET['id']));
      $t = "";
      $st = $conn->prepare("SELECT info_book.bookId, `bookNo`, `bookName`, `bookISBN`, `bookCat`, `bookAut`, `bookPub`, `bookStat`, `bookYear`, `bookCopy` FROM `info_book`
      INNER JOIN `info_bookjunc` ON info_book.bookId = info_bookjunc.bookId
      INNER JOIN `info_bookcat`  ON info_bookcat.bookCatId = info_bookjunc.bookCatId
      INNER JOIN `info_bookaut`  ON info_bookaut.bookAutId = info_bookjunc.bookAutId
      INNER JOIN `info_bookpub`  ON info_bookpub.bookPubId = info_bookjunc.bookPubId
      INNER JOIN `info_bookstat` ON info_bookstat.bookStatId = info_bookjunc.bookStatId
      INNER JOIN `info_bookyear` ON info_bookyear.bookYearId = info_bookjunc.bookYearId
      WHERE info_book.bookId = ?");
      if ($st->bind_param("i", $id)) {
        if ($st->execute()) {
          $r = $st->get_result();
          while ($f = $r->fetch_array()) {
            $diff=date('Y')-$f["bookYear"];
            if ($diff>=5) {
                $stat='Old';
            } else {
                $stat="New";
            }
            
            $t .= '<h5>Book Details</h5><div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Number';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["bookNo"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Name';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["bookName"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Category';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["bookCat"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Author';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["bookAut"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Publisher';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["bookPub"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Year Published';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["bookYear"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'ISBN Number';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["bookISBN"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'No. Copies';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["bookCopy"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Number of Years';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$diff;
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Status';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$stat;
            $t .= '</div>';
            $t .= '</div>';
          }
        }
      }
    }
  }
  echo $t;
?>
