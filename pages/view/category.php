<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
      include_once '../../pages/static/header.php';
    ?>
    <style>
      body {
        font-size: 14px;
        color: #1D1F21;
        font-family: Helvetica;
        background-image: url();
        background-size: cover;
        background-attachment: fixed;
        margin-top: 10px;
      }
      img {
        width: 70px;
        height: 70px;
      }
      td {
        text-align: center;
        width: 150px;
        padding: 0px;
      }
      th {
        width: 150px;
        text-align: left;
        padding: 2px;
      }
      table {
        margin-bottom: 10px;
        width: 100%;
        color: #000
      }
      h2 {
        text-align: center;
      }
      section {
        margin: 60px 160px 0px 160px;
        background-color: rgba(255, 255, 255, 0.5);
        padding: 20px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
        background-image: url();
      }
      section strong {
        font-style: italic;
        color: green;
      }
      h2 {
        padding-bottom: 10px;
      }
      p {
        text-align: center;
      }
      h4 {
        text-align: center;
        line-height: 20px;
      }
      h3 {
        text-align: center;
        line-height: 20px;
      }
      h2 > strong {
        font-size: 14px;
        font-weight: 400;
      }
      .total {
        text-align: right;
        line-height: 30px
      }
      .status {
        position: relative;
        float: right;
      }
      .hide {
        display: none !important;
      }
      .timeTable {
        width: 350px
      }
      @media print {
        body {
          font-size: 10px;
          background: #fff;
          color: #1D1F21;        }
      }
      @media (max-width: 768px) {
        body {
          width: 100%;
          height: 100%;
          margin: 0;
          background-image: url();
        }
        section {
          width: 800px;
          height: auto;
          float: none;
          padding: 30px;
          margin: 0;
          box-shadow: 0 0 0;
        }
        table {
          width: 100%;
        }
        .allowedUser {
          padding: 60px;
        }
      }
    </style>
  </head>
  <body>
    <section>
      <h2>
        <img src="../../upload/images/logo.png"><br>Don Ruben E. Ecleo Sr. Memorial National High School <br>
        <strong>Don Ruben, San Jose Dinagat Island</strong>
      </h2>
      <table>
        <tbody>
          <tr>
            <td></td>
            <td><h4><?php echo $_GET['q'] ?> Book Category</h4></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <table class="table">
        <thead>
          <tr>
            <th>Book No.</th>
            <th>Book Name</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Year Published</th>
            <th>ISBN Number</th>
            <th>Copiess</th>
            <th>Publisher Address</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $q = $_GET['q'];
            $conn = mysqli_connect("localhost", "root", "", "libsystem");
            $st = $conn->prepare("SELECT `bookNo`, `bookName`, `bookAut`, `bookPub`, `bookYear`, `bookISBN`, `bookCopy`, `bookPlace` FROM `info_book`
            LEFT JOIN `info_bookjunc` ON info_book.bookId = info_bookjunc.bookId
            LEFT JOIN `info_bookcat`  ON info_bookcat.bookCatId = info_bookjunc.bookCatId
            LEFT JOIN `info_bookaut`  ON info_bookaut.bookAutId = info_bookjunc.bookAutId
            LEFT JOIN `info_bookpub`  ON info_bookpub.bookPubId = info_bookjunc.bookPubId
            LEFT JOIN `info_bookstat` ON info_bookstat.bookStatId = info_bookjunc.bookStatId
            LEFT JOIN `info_bookyear` ON info_bookyear.bookYearId = info_bookjunc.bookYearId
            WHERE `bookCat` = '$q' ");
            if ($st->execute()) {
            $r = $st->get_result();
            while ($f = $r->fetch_array()) { ?>
            <tr>
              <td><?php echo $f["bookNo"] ?></td>
              <td><?php echo $f["bookName"] ?></td>
              <td><?php echo $f["bookAut"] ?></td>
              <td><?php echo $f["bookPub"] ?></td>
              <td><?php echo $f["bookYear"] ?></td>
              <td><?php echo $f["bookISBN"] ?></td>
              <td><?php echo $f["bookCopy"] ?></td>
              <td><?php echo $f["bookPlace"] ?></td>
            </tr>
      <?php }
          } ?>
        </tbody>
      </table>
    </section>
  </body>
</html>
