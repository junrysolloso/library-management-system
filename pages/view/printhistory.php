
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
      color: #000 !important;
    }
    table {
      color: #000 !important;
    }
    .card {
      border: 1px dashed #000;
      padding: 18px;
    }
    h2 {
      font-size: 25px;
      text-align: center;
    }
    h4 {
      text-align: center;
      border-bottom: 2px dashed #000;
      padding-bottom: 15px
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
    <h2 class="text-center">
      <img src="../../upload/images/icon.png"><br>DREESMNHS Library Management System</h2>
    <h4>List of returned books</h4>
    <table class="table table-hover" id="showTable">
      <thead>
        <tr>
          <th class="w3-center" width="5%">No</th>
          <th width="10%">ID Number</th>
          <th>Borrower Name</th>
          <th width="15%">Book Number</th>
          <th width="20%">Book Name</th>
          <th width="13%">Date Borrowed</th>
          <th width="13%">Date Returned</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $e = $_GET['r'];
          $n = $_GET['b'];
          $st = $conn->prepare("SELECT info_book.bookId, info_borrower.borrowerId, info_borrowedjunc.borrowedjuncId,
          `bookName`, `bookNo`, `studentid`, `firstname`, `middlename`, `lastname`, `borrowedDate`, `returnDate` FROM `info_borrowedjunc`
          LEFT JOIN `info_borrower` ON info_borrower.borrowerId = info_borrowedjunc.borrowerId
          LEFT JOIN `info_book`  ON info_book.bookId = info_borrowedjunc.bookId
          LEFT JOIN `info_borrowed`  ON info_borrowed.borrowedId = info_borrowedjunc.borrowedId
          LEFT JOIN `info_return`  ON info_return.returnId = info_borrowedjunc.returnId
          WHERE info_borrowedjunc.borrowedId > 0 AND info_borrowedjunc.returnId > 0 AND `returnDate` > '$e' AND `returnDate` < '$n'");
          if ($st->execute()) {
            $count = 1;
            $r = $st->get_result();
            while ($f = $r->fetch_array()) { ?>
              <tr>
                <td class="w3-center"><?php echo $count; ?></td>
                <td><?php echo $f["studentid"]; ?></td>
                <td><?php echo $f["firstname"].' '.$f["middlename"].' '.$f["lastname"]; ?></td>
                <td><?php echo $f["bookNo"]; ?></td>
                <td><?php echo $f["bookName"]; ?></td>
                <td><?php echo $f["borrowedDate"]; ?></td>
                <td><?php echo $f["returnDate"]; ?></td>
              <?php $count++;
            }
          }
        ?>
      </tbody>
    </table>
  </div>

  <script>
    $(function () {
      document.getElementsByTagName("a")[4].classList.add("w3-light-grey");
    })
  </script>
</body>
</html>
