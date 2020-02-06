
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
    <?php
      $id = htmlspecialchars(trim($_GET['q']));
      $st = $conn->prepare("SELECT info_borrower.borrowerId, `studentid`, `firstname`, `middlename`, `lastname`, `phone`, `address` FROM `info_borrower`
      INNER JOIN `info_borrowerjunc` ON info_borrower.borrowerId = info_borrowerjunc.borrowerId
      INNER JOIN `info_level` ON info_level.levelId = info_borrowerjunc.levelId WHERE info_borrower.borrowerId = ?");
      if ($st->bind_param("i", $id)) {
      if ($st->execute()) {
      $r = $st->get_result();
      while ($f = $r->fetch_array()) { ?>

      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
          <div class="w3-container w3-padding-large w3-card-12">
            <h3 class="w3-center">Update Borrower</h3><hr>
            <form id="bookAddForm">
              <div class="form-group hide">
                <input type="text" name="borrowerId" class="form-control" placeholder="Borrower ID" value="<?php echo $_GET['q']; ?>">
              </div>
              <div class="form-group">
                <input type="text" name="studentid" class="form-control" placeholder="Student ID" value="<?php echo $f["studentid"]; ?>">
              </div>
              <div class="form-group">
                <input type="text" name="firstname" class="form-control" placeholder="Firstname" value="<?php echo $f["firstname"]; ?>">
              </div>
              <div class="form-group">
                <input type="text" name="middlename" class="form-control" placeholder="Middlename" value="<?php echo $f["middlename"]; ?>">
              </div>
              <div class="form-group">
                <input type="text" name="lastname" class="form-control" placeholder="Lastname" value="<?php echo $f["lastname"]; ?>">
              </div>
              <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo $f["phone"]; ?>">
              </div>
              <div class="form-group">
                <input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo $f["address"]; ?>">
              </div>
              <div class="form-group">
                <select class="form-control" name="levelName">
                  <?php
                    $st = $conn->prepare("SELECT `levelName` FROM `info_level`");
                    if ($st->execute()) {
                      $r = $st->get_result();
                      while ($f = $r->fetch_array()) {
                        echo '<option value="'.$f["levelName"].'">'.$f["levelName"].'</option>';
                      }
                    }
                  ?>
                </select>
              </div>
              <br>
              <div class="form-group">
                <big id="help-block"></big>
                <button type="submit" name="button" id="saveBookBtn" class="w3-btn w3-teal w3-btn-block"><i class="fa fa-save"></i> Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  <?php }
      }
    } ?>
  </div>
  <?php
    include_once '../../pages/static/footer.php';
  ?>
  <script>
    $(function () {
      document.getElementsByTagName("a")[6].classList.add("w3-light-grey");
      var saveBtn = document.getElementById("saveBookBtn");
      saveBtn.addEventListener('click', function (e) {
        e.preventDefault();
        var borrowerId = $("[name='borrowerId']").val();
        var studentid = $("[name='studentid']").val();
        var firstname = $("[name='firstname']").val();
        var middlename = $("[name='middlename']").val();
        var lastname = $("[name='lastname']").val();
        var phone = $("[name='phone']").val();
        var address = $("[name='address']").val();
        var levelName = $("[name='levelName']").val();
        var arr = [studentid, firstname, middlename, lastname, phone, address, levelName, borrowerId];
        if (empty(arr)) {
          var p = "../../pages/query/updateborrower.php";
          var q = "?studentid=" + studentid +
                  "& borrowerId=" + borrowerId +
                  "& firstname=" + firstname +
                  "& middlename=" + middlename +
                  "& lastname=" + lastname +
                  "& phone=" + phone +
                  "& address=" + address +
                  "& levelName=" + levelName;
          ajaxRequest(p, q);
        } else {
          var help = document.getElementById("help-block");
          help.classList.add("text-danger");
          help.innerHTML = "Fields cannot be empty";
        }
      });
      function ajaxRequest(p, q) {
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
          if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText == 1) {
              var help = document.getElementById("help-block");
              help.classList.add("text-success");
              help.innerHTML = "Data successfully updated.";
              window.location = "transaction.php";
            } else {
              var help = document.getElementById("help-block");
              help.classList.add("text-danger");
              help.innerHTML = "Error processing request.";
            }
          }
        }
        ajax.open('GET', p + q, true);
        ajax.send(null);
      }
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
    });
  </script>
</body>
</html>
