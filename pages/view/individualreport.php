<!DOCTYPE html>
<html>
  <?php
    include_once '../../pages/static/header.php';
  ?>
<body>
  <?php
    include_once '../../pages/static/navigation.php';
  ?>
  <div class="w3-container w3-padding-jumbo">
    <div class="col-sm-12">
      <div class="w3-container w3-padding-xlarge w3-card-12">
        <h3>Individual Report</h3><hr>
          <form action="#"method="POST">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Student Name"></input>
            </div>
            <div class="form-group">
              <big id="help-block"></big>
              <button type="submit" name="button" id="" class="w3-btn w3-teal w3-btn-block"><i class="fa fa-save"></i> Save</button>
            </div>
          </form>
            <table class="table table-hover" id="showTable">
              <thead>
                <th class="text-center">No</th>
                <th class="text-center">Book Name</th>
                <th class="text-center">Date Borrowed</th>
                <th class="text-center">Date Returned</th>
              </thead>
              <tbody>
                <?php
                $st = $conn->prepare("SELECT info_book.bookId, info_borrower.borrowerId, info_borrowedjunc.borrowedjuncId,
                `bookName`, `firstname`, `middlename`, `lastname`, `borrowedDate`, `returnDate` FROM `info_borrowedjunc`
                INNER JOIN `info_borrower` ON info_borrower.borrowerId = info_borrowedjunc.borrowerId
                INNER JOIN `info_book`  ON info_book.bookId = info_borrowedjunc.bookId
                INNER JOIN `info_borrowed`  ON info_borrowed.borrowedId = info_borrowedjunc.borrowedId
                INNER JOIN `info_return`  ON info_return.returnId = info_borrowedjunc.returnId ");
                if ($st->execute()) {
                  $count = 1;
                    $r = $st->get_result();
                  while ($f = $r->fetch_array()) { ?>
                  <tr>
                    <td class="text-center"><?php echo $count; ?></td>
                    <td class="text-center"><?php echo $f["bookName"]; ?></td>
                    <td class="text-center"><?php echo $f["borrowedDate"]; ?></td>
                    <td class="text-center"><?php echo $f["returnDate"]; ?></td>
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
  <?php
    include_once '../../pages/static/footer.php';
  ?>
  <script>
    $(function () {
      document.getElementsByTagName("a")[5].classList.add("w3-light-grey");
      $("[href='#printThis']").click(function functionName() {
        window.open("printhistory.php");
      })
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
      $("table td a").hover(function () {
        var id = $(this).parent("td").attr("id");
        var p = "../../pages/query/borroweddetails.php";
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
      $('#pTable').DataTable({
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : false,
        'info'        : false,
        'autoWidth'   : false
      });
      function iRemove() {
        $(".filter-btn").removeAttr("disabled");
      }
      $('#dateFrom').datepicker({
        autoclose : false,
        startDate : start,
        endDate   : end
      });
    })
  </script>
</body>
</html>
