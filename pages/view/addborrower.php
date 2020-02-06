
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

    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <div class="w3-container w3-padding-large w3-card-12">
          <h3 class="w3-center">Borrower Information</h3><hr>
          <form id="bookAddForm">
            <div class="form-group">
              <input type="text" name="studentid" class="form-control" placeholder="Student ID">
            </div>
            <div class="form-group">
              <input type="text" name="firstname" class="form-control" placeholder="Firstname">
            </div>
            <div class="form-group">
              <input type="text" name="middlename" class="form-control" placeholder="Middlename">
            </div>
            <div class="form-group">
              <input type="text" name="lastname" class="form-control" placeholder="Lastname">
            </div>
            <div class="form-group">
              <input type="text" name="phone" class="form-control" placeholder="Phone Number">
            </div>
            <div class="form-group">
              <input type="text" name="address" class="form-control" placeholder="Address">
            </div>
            <div class="form-group">
              <select class="form-control" name="levelName">
                <option>Grade</option>
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
  </div>
  <?php
    include_once '../../pages/static/footer.php';
  ?>
  <script>
    $(function () {
      document.getElementsByTagName("a")[3].classList.add("w3-light-grey");
      var saveBtn = document.getElementById("saveBookBtn");
      saveBtn.addEventListener('click', function (e) {
        e.preventDefault();
        var studentid = $("[name='studentid']").val();
        var firstname = $("[name='firstname']").val();
        var middlename = $("[name='middlename']").val();
        var lastname = $("[name='lastname']").val();
        var phone = $("[name='phone']").val();
        var address = $("[name='address']").val();
        var levelName = $("[name='levelName']").val();
        var arr = [studentid, firstname, middlename, lastname, phone, address, levelName];
        if (empty(arr)) {
          var p = "../../pages/query/addborrower.php";
          var q = "?studentid=" + studentid +
                  "& firstname=" + firstname +
                  "& middlename=" + middlename +
                  "& lastname=" + lastname +
                  "& phone=" + phone +
                  "& address=" + address +
                  "& levelName=" + levelName;
          ajaxRequest(p, q, bookAddForm);
        } else {
          var help = document.getElementById("help-block");
          help.classList.add("text-danger");
          help.innerHTML = "Fields cannot be empty";
        }
      });
      function ajaxRequest(p, q, f) {
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
          if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText == 1) {
              var help = document.getElementById("help-block");
              help.classList.add("text-success");
              help.innerHTML = "Data successfully save.";
              $("#bookAddForm").trigger('reset');
            } else if (ajax.responseText == 2) {
              var help = document.getElementById("help-block");
              help.classList.add("text-danger");
              help.innerHTML = "Borrower already exist.";
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
