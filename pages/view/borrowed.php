<!DOCTYPE html>
<html>
  <?php include_once '../../pages/static/header.php'; ?>
<body>
  <?php
    include_once '../../pages/static/navigation.php';
    $st = $conn->prepare("TRUNCATE TABLE `info_tmp`");
    $st->execute();
  ?>
  <div class="w3-container w3-padding-jumbo">
    <div class="row">
      <div class="col-sm-6">
        <div class="w3-container w3-padding-xlarge w3-card-12">
      <h3>List of available books</h3><hr>
      <a href="#borrowerdetails" data-toggle="modal" class="w3-btn w3-teal pull-left" title="Borrower Book"><i class="fa fa-reply"></i></a>
        <table class="table table-hover" id="showTable">
          <thead>
            <tr>
              <th class="text-center">Select</th>
              <th>Book Name</th>
              <th class="text-center">Det'l</th>
            </tr>
          </thead>
            <tbody>
              <?php
              $st = $conn->prepare("SELECT info_book.bookId, `bookNo`, `bookName`, `bookCat`, `bookAut`, `bookPub`, `bookCopy` FROM `info_book`
              INNER JOIN `info_bookjunc` ON info_book.bookId = info_bookjunc.bookId
              INNER JOIN `info_bookcat`  ON info_bookcat.bookCatId = info_bookjunc.bookCatId
              INNER JOIN `info_bookaut`  ON info_bookaut.bookAutId = info_bookjunc.bookAutId
              INNER JOIN `info_bookpub`  ON info_bookpub.bookPubId = info_bookjunc.bookPubId WHERE `bookCopy` > 0 ORDER BY `bookName` ASC");
              if ($st->execute()) {
                $count = 1;
                $r = $st->get_result();
                while ($f = $r->fetch_array()) { ?>
                <tr id="<?php echo $f["bookId"]; ?>">
                  <td class="w3-center"><input type="checkbox" class="w3-check listBook" id="0" value="<?php echo $f["bookId"] ?>"></td>
                  <td><?php echo $f["bookName"]; ?></td>
                  <td class="w3-center" id="<?php echo $f["bookId"]; ?>"><a href="#" class="w3-btn w3-teal w3-small books" id="showDetails<?php echo $f["bookId"]; ?>"><i class="fa fa-eye"></i></a></td>
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
          <a href="#" class="pull-right">.</a>
            <table class="table table-hover" id="showTable1">
            <thead>
              <tr>
                <th>B'wr Name</th>
                <th>Book Name</th>
                <th class="text-center">Det'l</th>
                <th class="text-center">Ret'n</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $st = $conn->prepare("SELECT info_book.bookId, info_borrower.borrowerId, info_borrowedjunc.borrowedjuncId,`bookName`, `firstname`, `middlename`, `lastname`, `borrowedDate` FROM `info_borrowedjunc`
                INNER JOIN `info_borrower` ON info_borrower.borrowerId = info_borrowedjunc.borrowerId
                INNER JOIN `info_book`  ON info_book.bookId = info_borrowedjunc.bookId
                INNER JOIN `info_borrowed`  ON info_borrowed.borrowedId = info_borrowedjunc.borrowedId
                WHERE info_borrowedjunc.borrowedId > 0 AND info_borrowedjunc.returnId = 0 ORDER BY `borrowedDate` ASC");
                if ($st->execute()) {
                  $count = 1;
                  $r = $st->get_result();
                  while ($f = $r->fetch_array()) { ?>
                    <tr>
                      <td><?php echo $f["lastname"].' '.$f["firstname"].' '.$f["middlename"]; ?>.</td>
                      <td><?php echo $f["bookName"]; ?></td>
                      <td class="w3-center" id="<?php echo $f["borrowedjuncId"]; ?>"><a href="#" class="w3-btn w3-teal w3-small borrowers" id="showPersonal<?php echo $f["borrowedjuncId"]; ?>"><i class="fa fa-eye"></i></a></td>
                      <td><a href="#returnBook" data-toggle="modal" class="w3-btn w3-teal w3-small pull-left" title="Return Book" name="<?php echo $f["borrowerId"] ?>" id="<?php echo $f["borrowedjuncId"] ?>"><i class="fa fa-share"></i></a></td>
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
                    <br><img src="#" width="30px" height="30px"><br><br>
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
                    <br><img src="#" width="30px" height="30px"><br><br>
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
       var tmpId = []; var count = 0;
      document.getElementsByTagName("a")[4].classList.add("w3-light-grey");
      $("[data-toggle='modal']").click(function () {
        var borrowedjuncId = $(this).attr("id");
        var studentid = $(this).attr("name");
        $("[name='studentid']").val(studentid);
        $("[name='borrowedjuncId']").val(borrowedjuncId);
      })
      $(".listBook").click(function () {
        var id = $(this).val();
        var flag = $(this).attr("id");
        var p = "../../pages/query/insert.php";
        if (count !== 5) {
          if (flag == 0) {
            var q = "?id=" + id + "&  action=insert";
            ajaxRequest(p, q);
            $(this).attr("id", 1);
            count++;
          } else {
            var q = "?id=" + id + "& action=remove";
            ajaxRequest(p, q);
            $(this).attr("id", 0);
            count--;
          }
        } else {
          alert("Only five(5) books is allowed.");
        }
      })
      $("#confirmSave").click(function (e) {
        e.preventDefault();
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
      $("#borrowedsave").click(function (e) {
      e.preventDefault();
      var dis = document.getElementById('borrowedresult');
      var id = $("[name='borrowerid']").val();
      //var date = $("[name='borrowerdate']").val();
      var ajax = new XMLHttpRequest();
      var p = "../../pages/query/borrowed.php";
      var q = "?id=" + id;
      var arr = [id];
      if (empty(arr)) {
        ajax.onreadystatechange = function () {
          if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText == 1) {
              $("#borrowedresult").addClass("text-success");
              dis.innerHTML = "Book borrowed successfully.";
            }  else if (ajax.responseText == 2) {
              $("#borrowedresult").addClass("text-danger");
              dis.innerHTML = "Borrower ID does'nt Exist.";
            } else if (ajax.responseText == 3) {
              $("#borrowedresult").addClass("text-danger");
              dis.innerHTML = "No book Selected.";
            } else {
              $("#borrowedresult").addClass("text-danger");
              dis.innerHTML = "Error processing Request.";
            }
          }
        }
        ajax.open('GET', p + q, true);
        ajax.send(null);
      } else {
        $("#borrowedresult").addClass("text-danger");
        dis.innerHTML = "Fields cannot be empty.";
      }
    })
      function ajaxRequest(p, q) {
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
          if (ajax.readyState == 4 && ajax.status == 200) {
            console.log(ajax.responseText);
          }
        }
        ajax.open('GET', p + q, true);
        ajax.send(null);
      }
      $(".borrowers").hover(function () {
        var id = $(this).parent("td").attr("id");
        var p = "../../pages/query/borroweddetails1.php";
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
      $(".books").hover(function () {
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
      function empty(arr) {
        var arrLen = arr.length;
        var i; var c = 0;
        for (i = 0; i < arrLen; i++) {
          if (arr[i] == "") {
            c++;
          }
        }
        if (c > 0) {
          return false;
        } else {return true;}
      }
    })
  </script>
</body>
</html>
