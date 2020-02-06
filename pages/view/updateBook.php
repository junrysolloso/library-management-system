
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
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['q'])) {
          $id = htmlspecialchars(trim($_GET['q']));
          $t = "";
          $st = $conn->prepare("SELECT info_book.bookId, `bookNo`, `bookName`, `bookISBN`, `bookCat`,
          `bookAut`, `bookPub`, `bookStat`, `bookYear`, `bookCopy`, `bookPlace`, `bookStat` FROM `info_book`
          INNER JOIN `info_bookjunc` ON info_book.bookId = info_bookjunc.bookId
          INNER JOIN `info_bookcat`  ON info_bookcat.bookCatId = info_bookjunc.bookCatId
          INNER JOIN `info_bookaut`  ON info_bookaut.bookAutId = info_bookjunc.bookAutId
          INNER JOIN `info_bookpub`  ON info_bookpub.bookPubId = info_bookjunc.bookPubId
          INNER JOIN `info_bookstat` ON info_bookstat.bookStatId = info_bookjunc.bookStatId
          INNER JOIN `info_bookyear` ON info_bookyear.bookYearId = info_bookjunc.bookYearId
          WHERE info_book.bookId = ?");
          if ($st->bind_param("i", $id)) {
            if ($st->execute()) {
              $r = $st->get_result();
              while ($f = $r->fetch_array()) { ?>
                <div class="row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-6">
                    <div class="w3-container w3-padding-large w3-card-12">
                      <h3 class="w3-center"> Update Book Information</h3><hr>
                      <form id="bookAddForm">
                        <div class="form-group hide">
                          <input type="text" name="bookId" class="form-control" placeholder="" value="<?php echo $f["bookId"]; ?>">
                        </div>
                        <div class="form-group">
                          <input type="text" name="bookNo" class="form-control" placeholder="Book Number" value="<?php echo $f["bookNo"]; ?>">
                        </div>
                        <div class="form-group">
                          <input type="text" name="bookName" class="form-control" placeholder="Book Name" value="<?php echo $f["bookName"]; ?>">
                        </div>
                        <div class="form-group">
                          <input type="text" name="bookISBN" class="form-control" placeholder="Book ISBN" value="<?php echo $f["bookISBN"]; ?>">
                        </div>
                        <div class="form-group">
                          <input type="text" name="bookAut" class="form-control" placeholder="Book Author" value="<?php echo $f["bookAut"]; ?>">
                        </div>
                        <div class="form-group">
                          <input type="text" name="bookPub" class="form-control" placeholder="Publisher" value="<?php echo $f["bookPub"]; ?>">
                        </div>
                        <div class="form-group">
                          <input type="text" name="bookYear" class="form-control" placeholder="Year Published" value="<?php echo $f["bookYear"]; ?>">
                        </div>
                        <div class="form-group">
                          <input type="text" name="bookPlace" class="form-control" placeholder="Place Published" value="<?php echo $f["bookPlace"]; ?>">
                        </div>
                        <div class="form-group">
                          <input type="text" name="bookCopy" class="form-control" placeholder="No Copies" value="<?php echo $f["bookCopy"]; ?>">
                        </div>
                        <div class="form-group">
                          <select class="form-control" name="bookCat" value="<?php echo $f["bookCat"] ?>">
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
                          <select class="form-control" name="bookStat" value="<?php echo $f["bookStat"] ?>">
                            <option value="New">New</option>
                            <option value="Old">Old</option>
                          </select>
                        </div>
                        <br>
                        <div class="form-group">
                          <button type="submit" name="button" id="saveBookBtn" class="w3-btn w3-teal w3-btn-block"><i class="fa fa-save"></i> Save</button>
                          <big id="help-block"></big>
                        </div>
                      </form>
                    </div>
                  </div>
                </div><br><br>
       <?php  }
            }
          }
        }
      }
    ?>
  </div>
  <?php
    include_once '../../pages/static/footer.php';
  ?>
  <script>
    $(function () {
      document.getElementsByTagName("a")[4].classList.add("w3-light-grey");
      var saveBtn = document.getElementById("saveBookBtn");
      saveBtn.addEventListener('click', function (e) {
        e.preventDefault();
        var bookId = $("[name='bookId']").val();
        var bookNo = $("[name='bookNo']").val();
        var bookName = $("[name='bookName']").val();
        var bookISBN = $("[name='bookISBN']").val();
        var bookAut = $("[name='bookAut']").val();
        var bookPub = $("[name='bookPub']").val();
        var bookYear = $("[name='bookYear']").val();
        var bookPlace = $("[name='bookPlace']").val();
        var bookCopy = $("[name='bookCopy']").val();
        var bookCat = $("[name='bookCat']").val();
        var bookStat = $("[name='bookStat']").val();
        var arr = [bookId, bookNo, bookName, bookISBN, bookAut, bookPub, bookYear, bookCat, bookStat, bookPlace];
        if (empty(arr)) {
          var p = "../../pages/query/updatebook.php";
          var q = "?bookId=" + bookId +
                  "& bookNo=" + bookNo +
                  "& bookName=" + bookName +
                  "& bookISBN=" + bookISBN +
                  "& bookAut=" + bookAut +
                  "& bookPub=" + bookPub +
                  "& bookYear=" + bookYear +
                  "& bookPlace=" + bookPlace +
                  "& bookCopy=" + bookCopy +
                  "& bookCat=" + bookCat +
                  "& bookStat=" + bookStat;
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
              $("#bookAddForm").trigger('reset');
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
