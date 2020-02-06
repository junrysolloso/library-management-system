
<!DOCTYPE html>
<html>
  <?php include_once '../../pages/static/header.php'; ?>
<body>
  <?php include_once '../../pages/static/navigation.php'; ?>
  <div class="w3-container w3-padding-jumbo">

    <div class="w3-container w3-padding-xlarge w3-card-12">
      <h3>List of borrowers</h3><hr>
      <a href="addborrower.php" class="w3-btn w3-teal pull-left"><i class="fa fa-user-plus"></i> Add Borrower</a>
      <table class="table table-hover" id="showTable">
        <thead>
          <tr>
            <th class="w3-center">No</th>
            <th>ID Number</th>
            <th>Firstname</th>
            <th width="5%">M</th>
            <th>Lastname</th>
            <th>Phone</th>
            <th class="w3-center" width="4%">Upd't</th>
            <th class="w3-center" width="4%">Del't</th>
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
                  <td class="w3-center"><?php echo $count; ?></td>
                  <td><?php echo $f["studentid"]; ?></td>
                  <td><?php echo $f["firstname"]; ?></td>
                  <td><?php echo $f["middlename"]; ?></td>
                  <td><?php echo $f["lastname"]; ?></td>
                  <td><?php echo $f["phone"]; ?></td>
                  <td class="w3-center"><a href="updateborrower.php?q=<?php echo $f["borrowerId"]; ?>" data-toggle="modal" class="w3-btn w3-teal w3-small"><i class="fa  fa-pencil"></i></a></td>
                  <td class="w3-center"><a href="#removeborrower"  data-toggle="modal" id="<?php echo $f["borrowerId"] ?>" class="w3-btn w3-red w3-small"><i class="fa  fa-minus"></i></a></td>
                </tr>
                <?php $count++;
              }
            }
          ?>
        </tbody>
      </table>
    </div>

  </div>

  <div class="modal fade" id="removeborrower">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header w3-center">
          <h4>
            Remove borrower?
            <i class="fa fa-times pull-right" data-dismiss="modal" id="fa-x"></i>
          </h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <center>
                <div class="hide" id="waitborrower">
                  <br><img src="../../upload/images/wait.gif" width="30px" height="30px"><br><br>
                </div>
              </center>
              <h5 class="center" id="removeresult"></h5>
              <form id="confirmForm">
                <div class="form-group hide">
                  <input type="hidden" name="borrowerId" class="w3-input">
                </div>
                <div class="form-group">
                  <a href="#" class="w3-btn w3-red w3-btn-block" id="removeconfirm">Yes</a>
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
      document.getElementsByTagName("a")[6].classList.add("w3-light-grey");
      $("[data-toggle='modal']").click(function () {
        var id = $(this).attr("id");
        $("[name='borrowerId']").val(id);
      })
      $("#removeconfirm").click(function (e) {
        e.preventDefault();
        var id = $("[name='borrowerId']").val();
        var ajax = new XMLHttpRequest();
        var d = document.getElementById("removeresult");
        var q = "?id=" + id;
        var p = "../../pages/query/deleteborrower.php";
        ajax.onreadystatechange = function () {
          if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText == 1) {
              d.classList.add('text-success');
              d.innerHTML = "Data successfully deleted.";
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
    })
  </script>
</body>
</html>
