
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
          <h3 class="w3-center">Book Information</h3><hr>
          <form id="bookAddForm">
            <div class="form-group">
              <input type="text" name="bookNo" class="form-control" placeholder="Book Number">
            </div>
            <div class="form-group">
              <input type="text" name="bookName" class="form-control" placeholder="Book Name">
            </div>
            <div class="form-group">
              <input type="text" name="bookISBN" class="form-control" placeholder="ISBN Number">
            </div>
            <div class="form-group">
              <input type="number" name="bookCopy" class="form-control" placeholder="Number of copies">
            </div>
            <div class="form-group">
              <input type="text" name="bookAut" class="form-control" placeholder="Book Author">
            </div>
            <div class="form-group">
              <input type="text" name="bookPub" class="form-control" placeholder="Book Publisher">
            </div>
            <div class="form-group">
              <input type="text" name="bookYear" class="form-control" placeholder="Year Published">
            </div>
            <div class="form-group">
              <input type="text" name="bookPlace" class="form-control" placeholder="Publisher Address">
            </div>
            <div class="form-group">
              <select class="form-control" name="bookCat">
                <option>Category</option>
                <?php
                  $st = $conn->prepare("SELECT `bookCat` FROM `info_bookcat`");
                  if ($st->execute()) {
                    $r = $st->get_result();
                    while ($f = $r->fetch_array()) {
                      echo '<option value="'.$f["bookCat"].'">'.$f["bookCat"].'</option>';
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <select class="form-control" name="bookStat">
                <option value="New">New</option>
                <option value="Old">Old</option>
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
        var bookNo = $("[name='bookNo']").val();
        var bookName = $("[name='bookName']").val();
        var bookISBN = $("[name='bookISBN']").val();
        var bookCopy = $("[name='bookCopy']").val();
        var bookAut = $("[name='bookAut']").val();
        var bookPub = $("[name='bookPub']").val();
        var bookYear = $("[name='bookYear']").val();
        var bookPlace = $("[name='bookPlace']").val();
        var bookCat = $("[name='bookCat']").val();
        var bookStat = $("[name='bookStat']").val();
        var arr = [bookNo, bookName, bookISBN, bookCopy, bookAut, bookPub, bookYear, bookCat, bookStat, bookPlace];
        if (empty(arr)) {
          var p = "../../pages/query/addbook.php";
          var q = "?bookNo=" + bookNo +
                  "& bookName=" + bookName +
                  "& bookISBN=" + bookISBN +
                  "& bookCopy=" + bookCopy +
                  "& bookAut=" + bookAut +
                  "& bookPub=" + bookPub +
                  "& bookYear=" + bookYear +
                  "& bookPlace=" + bookPlace +
                  "& bookCat=" + bookCat +
                  "& bookStat=" + bookStat;
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
              help.innerHTML = "Book with same number already exist.";
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
