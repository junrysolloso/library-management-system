<div class="modal fade" id="categoryModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header w3-center">
        <h4>
          Select Book Category
          <i class="fa fa-times pull-right" data-dismiss="modal" id="fa-x"></i>
        </h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <center>
              <div class="hide" id="waitcategory">
                <br><img src="#" width="30px" height="30px"><br><br>
              </div>
            </center>
            <h5 class="center" id="categoryresult"></h5>
            <form id="borrowedform">
              <div class="form-group">
                <div class="form-group">
                  <select class="form-control" name="SelectBookCategory">
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
              </div>
              <div class="form-group">
                <a href="#" class="w3-btn w3-teal w3-btn-block" id="bookCatBtn">Preview</a>
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

  <?php $conn->close(); ?>
  <!-- <footer class="w3-container w3-theme w3-padding-large">
    <h5>copyright &copy; DREESMNHS 2018</h5>
  </footer> -->

  </div>
  <script src="<?php echo $dirAssets; ?>js/jquery.js"></script>
  <script src="<?php echo $dirAssets; ?>js/bootstrap.js"></script>
  <script src="<?php echo $dirAssets; ?>datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo $dirAssets; ?>datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo $dirAssets; ?>bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo $dirAssets; ?>js/tableProperties.js"></script>
  <script>
    function w3_open() {
      document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
      document.getElementsByClassName("w3-overlay")[0].style.display = "block";
    }
    function w3_close() {
      document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
      document.getElementsByClassName("w3-overlay")[0].style.display = "none";
    }
    window.onscroll = function() {myFunction()};
    function myFunction() {
      if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("myTop").classList.add("w3-card-4");
        document.getElementById("myIntro").classList.add("w3-show-inline-block");
      } else {
        document.getElementById("myIntro").classList.remove("w3-show-inline-block");
        document.getElementById("myTop").classList.remove("w3-card-4");
      }
    }
    function myFunc(id) {
      document.getElementById(id).classList.toggle("w3-show");
      document.getElementById(id).previousElementSibling.classList.toggle("w3-theme");
    }
    $("#bookCatBtn").click(function () {
      var s = $("[name='SelectBookCategory']").val();
      window.open("category.php?q=" + s);
    })
  </script>
