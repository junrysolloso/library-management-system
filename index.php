
<!DOCTYPE html>
<html>
  <?php
    include_once 'pages/static/header.php';
  ?>
<body>
  <?php
    include_once 'pages/static/navigation.php';
  ?>
  <div class="w3-container w3-padding-jumbo">
    <div class="w3-container w3-padding-xlarge w3-card-12">
      <h3 class="text-center">About Us</h3><hr>
        <div class="text-center" style="text-indent: 10px; color: white;">
          <p>Library Management System also known as Automated Library Management is a software used to manage the catalog of a library. This helps to keep records of whole transaction of the books available in the library. Library Management System is very easy to use and fulfills all the requirements of the librarian. There are many features which helps librarian to keep records of available books as well as issued books.
        </p>
      </div>

      
    </div>
  </div>
  <div class="w3-container w3-padding-jumbo">
    <?php
      define("query", "SELECT COUNT(borrowedjuncId) FROM `info_borrowedjunc`
      INNER JOIN `info_borrower` ON info_borrower.borrowerId = info_borrowedjunc.borrowerId
      INNER JOIN `info_book`  ON info_book.bookId = info_borrowedjunc.bookId
      INNER JOIN `info_bookjunc`  ON info_bookjunc.bookId = info_book.bookId
      INNER JOIN `info_bookcat`  ON info_bookcat.bookCatId = info_bookjunc.bookCatId
      INNER JOIN `info_borrowed`  ON info_borrowed.borrowedId = info_borrowedjunc.borrowedId ");

      define("query1", "SELECT sum(bookCopy) FROM `info_bookjunc`
      INNER JOIN `info_book`  ON info_book.bookId = info_bookjunc.bookId
      INNER JOIN `info_bookjunc`  ON info_bookjunc.bookId = info_book.bookId
      INNER JOIN `info_bookcat`  ON info_bookcat.bookCatId = info_bookjunc.bookCatId");


      function iCount($q)
      {
        $conn = new connection();
        $conn = $conn->connect();
        $st = $conn->prepare($q);
        if ($st->execute()) {
          $r = $st->get_result();
          $f = $r->fetch_array();
          if ($f[0] > 0) {
            $borrowed = $f[0];
          } else {
            $borrowed = 0;
          }
        }
        return $borrowed;
      }
      $category = array(); $count = 0; $t = "";
      $st = $conn->prepare("SELECT `bookCat` FROM `info_bookcat` order by bookCat asc");
      if ($st->execute()) {
        $r = $st->get_result();
        while ($f = $r->fetch_array()) {
          array_push($category, $f["bookCat"]);
        }
      }
      $catLenght = count($category);
      for($i= 0; $i < $catLenght; $i++){
        if($count == 0){
          $t .= '<div class="row">';
        }

        $borrowed = iCount(query."WHERE info_borrowedjunc.borrowedId > 0 AND info_borrowedjunc.returnId = 0 AND `bookCat` = '$category[$i]'");
        // $returned = iCount(query."WHERE info_bookcat.bookCatId = info_bookjunc.bookCatId AND `bookCat` = '$category[$i]'");
        $copy=0;
      $st = $conn->prepare("SELECT sum(bookCopy) FROM `info_book`
      INNER JOIN `info_bookjunc` ON info_book.bookId = info_bookjunc.bookId
      INNER JOIN `info_bookcat`  ON info_bookcat.bookCatId = info_bookjunc.bookCatId where info_book.bookId = info_bookjunc.bookId and bookCat = '$category[$i]'");
      if ($st->execute()) {
          $r = $st->get_result();
          while ($f = $r->fetch_array()) {
        // $nobooks = iCount(query."WHERE `bookCat` = '$category[$i]'");
        $copy = $f['sum(bookCopy)'];
        $quantity =$borrowed+$copy;

        $t .= '<div class="col-sm-4 w3-padding-medium">';
        $t .= '<div class="box w3-card-12 w3-padding-large">';
        $t .= '<div class="box-content">';
        $t .= '<h4 class="text-center">'.$category[$i].'</h4>';
        $t .= '<hr>';

        // total collection
        $t .= '<div class="divider"></div>';
        $t .= '<div class="row">';
        $t .= '<div class="col-sm-6">';
        $t .= '<p>Total No. of Collection</p>';
        $t .= '</div>';
        $t .= '<div class="col-sm-6">';
        $t .= '<p>: '.$quantity.'</p>';
        $t .= '</div>';
        $t .= '</div>';

        // borrowed block
        $t .= '<div class="divider"></div>';
        $t .= '<div class="row">';
        $t .= '<div class="col-sm-6">';
        $t .= '<p>Borrowed</p>';
        $t .= '</div>';
        $t .= '<div class="col-sm-6">';
        $t .= '<p>: '.$borrowed.'</p>';
        $t .= '</div>';
        $t .= '</div>';

        // return block
        $t .= '<div class="divider"></div>';
        $t .= '<div class="row">';
        $t .= '<div class="col-sm-6">';
        $t .= '<p>Available Books</p>';
        $t .= '</div>';
        $t .= '<div class="col-sm-6">';
        $t .= '<p>: '.$copy.'</p>';
        $t .= '</div>';
        $t .= '</div>';


        // // Total number of books
        // $t .= '<div class="divider"></div>';
        // $t .= '<div class="row">';
        // $t .= '<div class="col-sm-6">';
        // $t .= '<p>No. of Copies</p>';
        // $t .= '</div>';
        // $t .= '<div class="col-sm-6">';
        // $t .= '<p>: '.$nobooks.'</p>';
        // $t .= '</div>';
        // $t .= '</div>';

        $t .= '</div>';
        $t .= '</div>';
        $t .= '</div>';

        $count += 1;
        // close div after count is 4
        if($count == 4){
          $t .= '</div>';
          $count = 0;
        }
      }
    }
  }
      echo $t;
    ?>
  </div>
  <?php
    include_once 'pages/static/footer.php';
  ?>
  <script>
    $(function () {
      document.getElementsByTagName("a")[2].classList.add("w3-light-grey");
    })
  </script>
</body>
</html>
