
<!DOCTYPE html>
<html>
<?php
    include_once '../../pages/static/header.php';
    define("query", "SELECT info_book.bookId, info_borrower.borrowerId, info_borrowedjunc.borrowedjuncId,
    `bookName`, `firstname`, `middlename`, `lastname`, `borrowedDate`, `returnDate` FROM `info_borrowedjunc`
    LEFT JOIN `info_borrower` ON info_borrower.borrowerId = info_borrowedjunc.borrowerId
    LEFT JOIN `info_book`  ON info_book.bookId = info_borrowedjunc.bookId
    LEFT JOIN `info_borrowed`  ON info_borrowed.borrowedId = info_borrowedjunc.borrowedId
    LEFT JOIN `info_return`  ON info_return.returnId = info_borrowedjunc.returnId ");
    $t = date("m:d:y");
    $n = date("Y-m-d", strtotime($t));
    $s = explode("-", $n);
    $n = $s[0].'-'.$s[1].'-30';
    $e = $s[0].'-'.($s[1] - 1).'-01';
    $st = $conn->prepare(query."WHERE info_borrowedjunc.borrowedId > 0 AND info_borrowedjunc.returnId > 0 AND `returnDate` > '$e' AND `returnDate` < '$n'");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['dateFrom'])) {
        $dF = $_POST['dateTo'];
        $s = explode("/", $dF);
        $n = $s[2].'-'.$s[0].'-'.$s[1];
        $dT = $_POST['dateFrom'];
        $s = explode("/", $dT);
        $e = $s[2].'-'.$s[0].'-'.$s[1];
        $st = $conn->prepare(query."WHERE info_borrowedjunc.borrowedId > 0 AND info_borrowedjunc.returnId > 0 AND `returnDate` > '$e' AND `returnDate` < '$n'");
      }
    }
  ?>
<body>
  <?php include_once '../../pages/static/navigation.php'; ?>
  <div class="w3-container w3-padding-jumbo">
    <div class="w3-container w3-padding-xlarge w3-card-12">
      <h3>List of returned books</h3><hr>
      <a href="#printThis" class="w3-btn w3-teal pull-right"><i class="fa fa-print"></i> Print</a>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" style="margin-bottom: 70px">
         <div class="w3-col s2">
           <div class="input-group">
             <div class="input-group-addon">
               <i class="fa fa-calendar"></i>
             </div>
             <input type="text" class="form-control" name="dateFrom" id="dateFrom" placeholder="0000-00-00">
           </div>
         </div>
         <div class="w3-col s2">
           <div class="input-group">
             <div class="input-group-addon">
               <i class="fa fa-calendar"></i>
             </div>
             <input type="text" class="form-control" name="dateTo" id="dateTo" placeholder="0000-00-00">
           </div>
         </div>
         <div class="w3-col s1">
           <div class="input-group">
             <button type="submit" name="button" class="w3-btn w3-teal filter-btn">Show</button>
           </div>
         </div>
       </form>
      <table class="table table-hover" id="pTable">
        <thead>
          <tr>
            <th class="w3-center">No</th>
            <th>Borrower Name</th>
            <th>Book Name</th>
            <th>Date Borrowed</th>
            <th>Date Returned</th>
            <th class="w3-center" width="4%">Det'l</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if ($st->execute()) {
              $count = 1;
              $r = $st->get_result();
              while ($f = $r->fetch_array()) { ?>
                <tr>
                  <td class="w3-center"><?php echo $count; ?></td>
                  <td><?php echo $f["firstname"].' '.$f["middlename"].' '.$f["lastname"]; ?></td>
                  <td><?php echo $f["bookName"]; ?></td>
                  <td><?php echo $f["borrowedDate"]; ?></td>
                  <td>
                    <?php echo $f["returnDate"]; ?>
                  </td>
                  <td class="w3-center" id="<?php echo $f["borrowedjuncId"]; ?>"><a href="#" class="w3-btn w3-teal w3-small" id="showDetails<?php echo $f["borrowedjuncId"]; ?>"><i class="fa fa-eye"></i></a></td>
                <?php $count++;
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
<?php if (isset($_POST['dateFrom'])): ?>
  <input type="text" name="rFilterDate" value="<?php echo $e; ?>">
  <input type="text" name="bFilterDate" value="<?php echo $n; ?>">
<?php endif; ?>
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
      $("[href='#printThis']").click(function functionName() {
        var rDate = $("[name='rFilterDate']").val();
        var bDate = $("[name='bFilterDate']").val();
        var q = "?r=" + rDate + "&b=" + bDate;
        window.open("printhistory.php" + q);
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
      var d = new Date();
      var start = new Date(d.getFullYear() + "/01" + "/01");
      var end = new Date(d.getFullYear() + "/12" + "/31");
      $(".filter-btn").attr("disabled", "true");
      $("#dateTo").attr("disabled", "true");
      $(".filter-btn").mouseenter(function () {
        if (!iCheck()) {
          $(".filter-btn").attr("disabled", "true");
        } else {iRemove();}
      })
      $("#dateFrom").click(function () {
        iRemove();
      })
      $("#dateTo").mouseleave(function () {
        if (!iCheck()) {
          $(".filter-btn").attr("disabled", "true");
        } else {iRemove();}
      })
      $("#dateTo").mouseenter(function () {
        if (!iCheck()) {
          $(".filter-btn").attr("disabled", "true");
        } else {iRemove();}
      })
      $("#dateFrom").mouseleave(function () {
        var start = $(this).val();
        if (!iCheckTo()) {
          $("#dateTo").attr("disabled", "true");
        } else {
          $("#dateTo").datepicker({
            autoclose : false,
            startDate : start,
            endDate   : end
          });
          $("#dateTo").removeAttr("disabled");
        }
        if (!iCheck()) {
          $(".filter-btn").attr("disabled", "true");
        } else {iRemove();}
      })
      $("#dateFrom").blur(function () {
        var start = $(this).val();
        if (!iCheckTo()) {
          $("#dateTo").attr("disabled", "true");
        } else {
          $("#dateTo").datepicker({
            autoclose : false,
            startDate : start,
            endDate   : end
          });
          $("#dateTo").removeAttr("disabled");
        }
        if (!iCheck()) {
          $(".filter-btn").attr("disabled", "true");
        } else {iRemove();}
      })
      $("#dateFrom").mouseenter(function () {
        if (!iCheck()) {
          $(".filter-btn").attr("disabled", "true");
        } else {iRemove();}
      })
      function iCheck() {
        var dF = $("input[name='dateFrom']").val();
        var dT = $("input[name='dateTo']").val();
        var dFLen = dF.length; var c = 0;
        var dTLen = dT.length; var i = 0;
        if (dFLen !== 10 || dTLen !== 10) {
          return false;
        } else{return true;}
        for (i = 0; i < 10; i++) {
          if (dF[i] == "/" && dT[i] == "/") {
            c++;
          }
        }
        if (c !== 2) {
          return false;
        } else{return true;}
      }
      function iCheckTo() {
        var dF = $("input[name='dateFrom']").val();
        var dFLen = dF.length; var i = 0;
        if (dFLen !== 10) {
          return false;
        } else{return true;}
        for (i = 0; i < 10; i++) {
          if (dF[i] == "/") {
            c++;
          }
        }
        if (c !== 2) {
          return false;
        } else{return true;}
      }
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
