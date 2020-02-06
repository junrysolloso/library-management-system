<?php
  require_once '../../pages/class/connection.php';
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
      $id = htmlspecialchars(trim($_GET['id']));
      $t = "";
      $st = $conn->prepare("SELECT info_book.bookId, `bookNo`, `bookName`, `bookISBN`, `bookCat`,
      `bookAut`, `bookPub`, `bookStat`, `bookYear`, `studentid`, `firstname`,
      `middlename`, `lastname`, `lastname`, `phone`, `address`, `borrowedDate` FROM `info_book`
      LEFT JOIN `info_bookjunc`     ON info_book.bookId = info_bookjunc.bookId
      LEFT JOIN `info_bookcat`      ON info_bookcat.bookCatId = info_bookjunc.bookCatId
      LEFT JOIN `info_bookaut`      ON info_bookaut.bookAutId = info_bookjunc.bookAutId
      LEFT JOIN `info_bookpub`      ON info_bookpub.bookPubId = info_bookjunc.bookPubId
      LEFT JOIN `info_bookstat`     ON info_bookstat.bookStatId = info_bookjunc.bookStatId
      LEFT JOIN `info_bookyear`     ON info_bookyear.bookYearId = info_bookjunc.bookYearId
      LEFT JOIN `info_borrowedjunc` ON info_borrowedjunc.bookId = info_book.bookId
      LEFT JOIN `info_borrower`     ON info_borrower.borrowerId = info_borrowedjunc.borrowerId
      LEFT JOIN `info_borrowed`     ON info_borrowed.borrowedId = info_borrowedjunc.borrowedId
      WHERE info_borrowedjunc.borrowedjuncId = ?");
      if ($st->bind_param("i", $id)) {
        if ($st->execute()) {
          $r = $st->get_result();
          while ($f = $r->fetch_array()) {
            $t .= '<h5>Borrower Details</h5><div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'ID Number';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["studentid"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Fullname';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["firstname"].' '.$f["middlename"].'. '.$f["lastname"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Phone Number';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["phone"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Address';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["address"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<hr><div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Borrowed date';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["borrowedDate"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<hr><h5>Book Details</h5><div class="row">';
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
            $t .= 'Status';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["bookStat"];
            $t .= '</div>';
            $t .= '</div>';
          }
        }
      }
    }
  }
  echo $t;
?>
