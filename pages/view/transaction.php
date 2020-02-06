
<!DOCTYPE html>
<html>
  <?php include_once '../../pages/static/header.php'; ?>
<body>
  <?php include_once '../../pages/static/navigation.php'; ?>
  <div class="w3-container w3-padding-jumbo">
    <div class="row">
      <div class="col-sm-6">
        <div class="w3-container w3-padding-xlarge w3-card-12">
          <h3>Book List</h3><hr>
           <a href="addbook.php" class="w3-btn w3-teal pull-left" title="Add Book"><i class="fa fa-plus"></i></a>
           <table class="table table-hover" id="showTable">
            <thead>
              <tr>
                <th>Book No.</th>
                <th>Name</th>
                <th>Upd't</th>
                <th>Det'l</th>
              </tr>
            </thead>
              <tbody>
                <?php
                  $st = $conn->prepare("SELECT info_book.bookId, `bookNo`, `bookName`, `bookCat`, `bookAut`, `bookPub`, `bookCopy` FROM `info_book`
                  INNER JOIN `info_bookjunc` ON info_book.bookId = info_bookjunc.bookId
                  INNER JOIN `info_bookcat`  ON info_bookcat.bookCatId = info_bookjunc.bookCatId
                  INNER JOIN `info_bookaut`  ON info_bookaut.bookAutId = info_bookjunc.bookAutId
                  INNER JOIN `info_bookpub`  ON info_bookpub.bookPubId = info_bookjunc.bookPubId ORDER BY `bookName` ASC");
                  if ($st->execute()) {
                    $count = 1;
                  $r = $st->get_result();
                  while ($f = $r->fetch_array()) { ?>
                    <tr>
                      <td><?php echo $f["bookNo"]; ?></td>
                      <td><?php echo $f["bookName"]; ?></td>
                      <td><a href="updateBook.php?q=<?php echo $f["bookId"]; ?>" class="w3-btn w3-teal w3-small"><i class="fa fa-pencil"></i></a></td>
                      <td class="w3-center" id="<?php echo $f["bookId"]; ?>"><a href="#" class="w3-btn w3-teal w3-small bbook" id="showDetails<?php echo $f["bookId"]; ?>"><i class="fa fa-eye"></i></a></td>
                    </tr>
                <?php $count++;
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      <div class="col-sm-6">
        <div class="w3-container w3-padding-xlarge w3-card-12">
          <h3>Borrowers List</h3><hr>
            <a href="addborrower.php" class="w3-btn w3-teal pull-left"><i class="fa fa-user-plus" title="Add Borrower"></i></a>
              <table class="table table-hover" id="showTable1">
                <thead>
                  <tr>
                    <th>Id No.</th>
                    <th>Name</th>
                    <th>Upd't</th>
                    <th>Det'l</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $st = $conn->prepare("SELECT info_borrower.borrowerId, `studentid`, `firstname`, `middlename`, `lastname`, `phone`, `address` FROM `info_borrower`
                    INNER JOIN `info_borrowerjunc` ON info_borrower.borrowerId = info_borrowerjunc.borrowerId
                    INNER JOIN `info_level` ON info_level.levelId = info_borrowerjunc.levelId ");
                    if ($st->execute()) {
                    $count = 1;
                    $r = $st->get_result();
                    while ($f = $r->fetch_array()) { ?>
                      <tr>
                        <td><?php echo $f["studentid"]; ?></td>
                        <td><?php echo $f["lastname"].' '.$f["lastname"].' '.$f["middlename"]; ?>.</td>
                        <td class="w3-center"><a href="updateborrower.php?q=<?php echo $f["borrowerId"]; ?>" data-toggle="modal" class="w3-btn w3-teal w3-small"><i class="fa fa-pencil"></i></a></td>
                        <td class="w3-center" id="<?php echo $f["borrowerId"]; ?>"><a href="#" class="w3-btn w3-teal w3-small bborrower" id="showPersonal<?php echo $f["borrowerId"]; ?>"><i class="fa fa-eye"></i></a></td>
                      </tr>
                    <?php $count++;
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
  <?php include_once '../../pages/static/footer.php'; ?>
  <script>
    $(function () {
      document.getElementsByTagName("a")[3].classList.add("w3-light-grey");
      $(".bbook").hover(function () {
        var id = $(this).parent("td").attr("id");
        var p = "../../pages/query/details.php";
        var q = "?id=" + id;
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
          if (ajax.readyState == 4 && ajax.status == 200) {
            res = ajax.responseText;
            $("#showDetails" + id).popover({
                trigger  : 'manual',
                html     : true,
                content  : res,
                placement: 'left'
            });
            $("#showDetails" + id).popover('show');
          }
        }
        ajax.open('GET', p + q, true);
        ajax.send(null);
      }, function () {
        var id = $(this).parent("td").attr("id");
        $("#showDetails" + id).popover('hide');
      })

      $(".bborrower").hover(function () {
        var id = $(this).parent("td").attr("id");
        var p = "../../pages/query/borrowerdetails.php";
        var q = "?id=" + id;
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
          if (ajax.readyState == 4 && ajax.status == 200) {
            res = ajax.responseText;
            $("#showPersonal" + id).popover({
                trigger  : 'manual',
                html     : true,
                content  : res,
                placement: 'left'
            });
            $("#showPersonal" + id).popover('show');
          }
        }
        ajax.open('GET', p + q, true);
        ajax.send(null);
      }, function () {
        var id = $(this).parent("td").attr("id");
        $("#showPersonal" + id).popover('hide');
      })
    })
  </script>
</body>
</html>
