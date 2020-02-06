
<!DOCTYPE html>
<html>
  <?php
    include_once '../../pages/static/header.php';
  ?>
<body>
  <?php
    include_once '../../pages/static/navigation.php';
  ?>
  <div class="w3-container w3-padding-jumbo" style="height: 500px; overflow-y: auto">
    <div class="w3-container w3-padding-xlarge w3-card-12">
      <a href="#printThis" class="w3-btn w3-teal pull-left"><i class="fa fa-print"></i> Print</a>
      <table class="table table-hover" id="showTable">
        <thead>
          <tr>
            <th class="w3-center">Select</th>
            <th>Number</th>
            <th>Name</th>
            <th>Category</th>
            <th>Author</th>
            <th class="w3-center" width="4%">Det'l</th>
          </tr>
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
                  <td class="w3-center"><input type="checkbox" class="w3-check"  value="<?php echo $f["bookId"]; ?>"></td>
                  <td><?php echo $f["bookNo"]; ?></td>
                  <td><?php echo $f["bookName"]; ?></td>
                  <td><?php echo $f["bookCat"]; ?></td>
                  <td><?php echo $f["bookAut"]; ?></td>
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

  <?php
    include_once '../../pages/static/footer.php';
  ?>
  <script>
    $(function () {
      var checkArr = []; var checkClick = 0;
      document.getElementsByTagName("a")[4].classList.add("w3-light-grey");
      $(".w3-check").click(function () {
        checkArr[checkClick] = $(this).val();
        checkClick++;
      })
      $("[href='#printBook']").click(function () {
        window.open("printBook.php");
      })
      $(".w3-check").click(function () {
        var id = $(this).val();
        var p = "../../pages/query/print.php";
        var q = "?id="+ id;
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
          if (ajax.readyState == 4 && ajax.status == 200) {
            var disp = document.getElementById("selected");
            if (ajax.responseText == 1) {
              $("#help-block").addClass("text-danger");
              $("#help-block").text("Book is already selected.");
              setTimeout(function () {
                $("#help-block").fadeOut('slow');
              }, 3000)
            } else {
              disp.innerHTML = ajax.responseText;
              $("table.w3-hide, a.w3-hide").removeClass("w3-hide");
            }
          }
        }
        ajax.open('GET', p + q, true);
        ajax.send(null);
      })
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
    })
  </script>
</body>
</html>
