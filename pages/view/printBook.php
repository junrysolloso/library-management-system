
<!DOCTYPE html>
<html>
<?php
    session_start();
    if (!isset($_SESSION['userId'])) {
      echo '<script>window.location="../../login.php"</script>';
    }
    include_once '../../pages/static/header.php';
  ?>
  <style>
    body {
      background: #fff;
      font-size: 16px;
      color: #000;
    }
    .card {
      border: 1px dashed #000;
      padding: 18px;
    }
    h5 {
      border-bottom: 1px dashed #000;
      padding-bottom: 5px;
      font-size: 16px;
    }
    @media print {
      body {
        font-size: 10px;
      }
      .col-sm-6 {
        width: 360px;
        position: relative;
        display: inline-block;
      }
      .w3-teal {
        background: #fff;
      }
      .w3-card-4 {
        border: 1px dashed #000;
        box-shadow: 0px 0px 0px #000 !important;
      }
      table tr {
        border: 0;
      }
    }
  </style>
<body>

  <div class="w3-container w3-padding-large">
    <div class="row">
      <?php
        $t = "";
        $st = $conn->prepare("SELECT info_book.bookId, `bookNo`, `bookName`, `bookISBN`, `bookCat`,
        `bookAut`, `bookPub`, `bookCopy`, `bookStat`, `bookYear`, `bookPlace` FROM `info_book`
        RIGHT JOIN `info_bookjunc` ON info_book.bookId = info_bookjunc.bookId
        RIGHT JOIN `info_bookcat`  ON info_bookcat.bookCatId = info_bookjunc.bookCatId
        RIGHT JOIN `info_bookaut`  ON info_bookaut.bookAutId = info_bookjunc.bookAutId
        RIGHT JOIN `info_bookpub`  ON info_bookpub.bookPubId = info_bookjunc.bookPubId
        RIGHT JOIN `info_bookstat` ON info_bookstat.bookStatId = info_bookjunc.bookStatId
        RIGHT JOIN `info_bookyear` ON info_bookyear.bookYearId = info_bookjunc.bookYearId
        RIGHT JOIN `info_tmp` ON info_tmp.bookId = info_bookjunc.bookId ");
        if ($st->execute()) {
          $r = $st->get_result();
          while ($f = $r->fetch_array()) {
            $t .= '<div class="col-sm-6 w3-teal card">';
              $t .= '<table>';
                $t .= '<tbody>';
                  $t .= '<tr>';
                    $t .= '<td width="30%">'.$f["bookNo"].'</td>';
                    $t .= '<td>'.$f["bookName"].'</td>';
                  $t .= '</tr>';
                  $t .= '<tr>';
                    $t .= '<td width="30%">'.$f["bookYear"].'</td>';
                    $t .= '<td>'.$f["bookAut"].'</td>';
                  $t .= '</tr>';
                  $t .= '<tr>';
                    $t .= '<td></td>';
                    $t .= '<td>'.$f["bookPlace"].'</td>';
                  $t .= '</tr>';
                  $t .= '<tr>';
                    $t .= '<td></td>';
                    $t .= '<td>'.$f["bookISBN"].'</td>';
                  $t .= '</tr>';
                $t .= '</tbody>';
              $t .= '</table>';
            $t .= '</div>';
          }
        }
        $st = $conn->prepare("TRUNCATE TABLE `info_tmp`");
        $st->execute();
        echo $t;
      ?>

    </div>
  </div>

  <script>
    $(function () {
      document.getElementsByTagName("a")[4].classList.add("w3-light-grey");
    })
  </script>
</body>
</html>
