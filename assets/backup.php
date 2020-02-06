<td class="w3-center" id="<?php echo $f["borrowerId"]; ?>"><a href="#" class="w3-btn w3-teal w3-small" id="showPersonal<?php echo $f["borrowerId"]; ?>"><i class="fa fa-eye"></i></a></td>




$("a").hover(function () {
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


<!-- borrowed.php back up -->

<!DOCTYPE html>
<html>
  <?php include_once '../../pages/static/header.php'; ?>
<body>
  <?php include_once '../../pages/static/navigation.php'; ?>
  <div class="w3-container w3-padding-jumbo" style="height: 500px; overflow-y: auto">

    <div class="row">
      <div class="col-sm-6">
        <div class="w3-container w3-padding-xlarge w3-card-12">
      <h3>Borrowed Books</h3><hr>
      <a href="../../pages/query/borrowed.php" class="w3-btn w3-teal pull-left"><i class="fa fa-plus-circle"></i> Borrow Books</a>
        <table class="table table-hover" id="showTable">
          <thead>
            <tr>
              <th>Select</th>
              <th>Book Name</th>
              <th>Det'l</th>
            </tr>
          </thead>
            <tbody>
              <?php
              $st = $conn->prepare("SELECT info_book.bookId, `bookNo`, `bookName`, `bookCat`, `bookAut`, `bookPub`, `bookEdit` FROM `info_book`
              INNER JOIN `info_bookjunc` ON info_book.bookId = info_bookjunc.bookId
              INNER JOIN `info_bookcat`  ON info_bookcat.bookCatId = info_bookjunc.bookCatId
              INNER JOIN `info_bookaut`  ON info_bookaut.bookAutId = info_bookjunc.bookAutId
              INNER JOIN `info_bookpub`  ON info_bookpub.bookPubId = info_bookjunc.bookPubId
              INNER JOIN `info_bookedit` ON info_bookedit.bookEditId = info_bookjunc.bookEditId ");
              if ($st->execute()) {
                $count = 1;
                $r = $st->get_result();
                while ($f = $r->fetch_array()) { ?>
                <tr>
                  <td class="w3-center"><input type="checkbox" class="w3-check"  value="<?php echo $f["bookId"]; ?>"></td>
                  <td><?php echo $f["bookName"]; ?></td>
                  <td class="w3-center" id="<?php echo $f["bookId"]; ?>"><a href="#" class="w3-btn w3-teal w3-small" id="showDetails<?php echo $f["bookId"]; ?>"><i class="fa fa-eye"></i></a></td>
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
      <h3>List of borrowed books</h3><hr>
      <table class="table table-hover" id="showTable">
        <thead>
          <tr>
            <th class="w3-center">No</th>
            <th>Borrower Name</th>
            <th>Book Name</th>
            <th class="w3-center" width="4%">Det'l</th>
            <th class="w3-center" width="4%">Ret'n</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $st = $conn->prepare("SELECT info_book.bookId, info_borrower.borrowerId, info_borrowedjunc.borrowedjuncId,`bookName`, `firstname`, `middlename`, `lastname`, borrowedDate FROM `info_borrowedjunc`
            INNER JOIN `info_borrower` ON info_borrower.borrowerId = info_borrowedjunc.borrowerId
            INNER JOIN `info_book`  ON info_book.bookId = info_borrowedjunc.bookId
            INNER JOIN `info_borrowed`  ON info_borrowed.borrowedId = info_borrowedjunc.borrowedId
            WHERE info_borrowedjunc.borrowedId > 0 AND info_borrowedjunc.returnId = 0");
            if ($st->execute()) {
              $count = 1;
              $r = $st->get_result();
              while ($f = $r->fetch_array()) { ?>
                <tr>
                  <td class="w3-center"><?php echo $count; ?></td>
                  <td><?php echo $f["firstname"].' '.$f["middlename"].' '.$f["lastname"]; ?></td>
                  <td><?php echo $f["bookName"]; ?></td>
                  <td class="w3-center" id="<?php echo $f["borrowedjuncId"]; ?>"><a href="#" class="w3-btn w3-teal w3-small" id="showDetails<?php echo $f["borrowedjuncId"]; ?>"><i class="fa fa-eye"></i></a></td>
                  <td class="w3-center"><a href="#returnBook" data-toggle="modal" id="<?php echo $f["borrowedjuncId"]; ?>" name="<?php echo $f["borrowerId"]; ?>" class="w3-btn w3-teal w3-small" id="showPersonal<?php echo $f["borrowerId"]; ?>"><i class="fa  fa-share-square-o"></i></a></td>
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

<div class="modal fade" id="borrowerdetails">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header w3-center">
        <h4>
          Borrowed Details
          <i class="fa fa-times pull-right" data-dismiss="modal" id="fa-x"></i>
        </h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <center>
              <div class="hide" id="waitborrowed">
                <br><img src="upload/wait.gif" width="30px" height="30px"><br><br>
              </div>
            </center>
            <h5 class="center" id="borrowedresult"></h5>
            <form id="borrowedform">
              <div class="form-group">
                <input type="text" name="borrowerid" class="w3-input" placeholder="Student ID">
              </div>
              <div class="form-group w3-hide">
                <input type="text" name="borrowerdate" class="w3-input" placeholder="00/00/000">
              </div>
              <div class="form-group">
                <a href="#" class="w3-btn w3-teal w3-btn-block" id="borrowedsave">Continue</a>
              </div>
            </form>
          </div>
          <div class="col-sm-2"></div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="returnBook">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header w3-center">
        <h4>
          Return selected book?
          <i class="fa fa-times pull-right" data-dismiss="modal" id="fa-x"></i>
        </h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <center>
              <div class="hide" id="waitborrowed">
                <br><img src="../../upload/images/wait.gif" width="30px" height="30px"><br><br>
              </div>
            </center>
            <h5 class="center" id="confirmResult"></h5>
            <form id="confirmForm">
              <div class="form-group hide">
                <input type="text" name="borrowedjuncId" class="w3-input">
              </div>
              <div class="form-group hide">
                <input type="text" name="studentid" class="w3-input">
              </div>
              <div class="form-group">
                <a href="#" class="w3-btn w3-teal w3-btn-block" id="confirmSave">Yes</a>
              </div>
            </form>
          </div>
          <div class="col-sm-2"></div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<?php include_once '../../pages/static/footer.php'; ?>
  <script>
    $(function () {
      document.getElementsByTagName("a")[5].classList.add("w3-light-grey");
      $("[data-toggle='modal']").click(function () {
        var borrowedjuncId = $(this).attr("id");
        var studentid = $(this).attr("name");
        $("[name='studentid']").val(studentid);
        $("[name='borrowedjuncId']").val(borrowedjuncId);
      })
      $("#confirmSave").click(function () {
        var studentid = $("[name='studentid']").val();
        var borrowedjuncId = $("[name='borrowedjuncId']").val();
        var ajax = new XMLHttpRequest();
        var d = document.getElementById("confirmResult");
        var q = "?borrowedjuncId=" + borrowedjuncId + "& studentid=" + studentid;
        var p = "../../pages/query/return.php";
        ajax.onreadystatechange = function () {
          if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText == 1) {
              d.classList.add('text-success');
              d.innerHTML = "Book return successful.";
              window.location = "<?php echo $_SERVER['PHP_SELF']; ?>";
            } else {
              d.classList.add('text-danger');
              d.innerHTML = "Book return failed.";
            }
          }
        }
      $("table td a").hover(function () {
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


    {
      document.getElementsByTagName("a")[3].classList.add("w3-light-grey");
      $('[data-dismiss="modal"]').click(function () {
        var p = "../../pages/query/truncate.php";
        var q = "?go=go";
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
          if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText == 1) {
              window.location = "<?php echo $_SERVER['PHP_SELF'] ?>";
            }
          }
        }
        ajax.open('GET', p + q, true);
        ajax.send(null);
      })

      
      document.getElementsByTagName("a")[5].classList.add("w3-light-grey");
      $("[data-toggle='modal']").click(function () {
        var borrowedjuncId = $(this).attr("id");
        var studentid = $(this).attr("name");
        $("[name='studentid']").val(studentid);
        $("[name='borrowedjuncId']").val(borrowedjuncId);
      })
      $("#confirmSave").click(function () {
        var studentid = $("[name='studentid']").val();
        var borrowedjuncId = $("[name='borrowedjuncId']").val();
        var ajax = new XMLHttpRequest();
        var d = document.getElementById("confirmResult");
        var q = "?borrowedjuncId=" + borrowedjuncId + "& studentid=" + studentid;
        var p = "../../pages/query/return.php";
        ajax.onreadystatechange = function () {
          if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText == 1) {
              d.classList.add('text-success');
              d.innerHTML = "Book return successful.";
              window.location = "<?php echo $_SERVER['PHP_SELF']; ?>";
            } else {
              d.classList.add('text-danger');
              d.innerHTML = "Book return failed.";
            }
          }
        }
        ajax.open('GET', p + q, true);
        ajax.send(null);
      })



      $("a").hover(function () {
        var id = $(this).parent("td").attr("id");
        var p = "../../pages/query/borroweddetails.php";
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
  }
  </script>
</body>
</html>