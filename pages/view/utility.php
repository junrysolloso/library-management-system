
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
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
        <div class="w3-container w3-card-12 w3-padding-xlarge">
          <h3>User Setting</h3>
          <hr>
          <div style="margin-bottom: 70px">
            <a href="#addUser" data-toggle="modal" class="w3-btn w3-teal pull-left"><i class="fa fa-user-plus"></i> Add User</a>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th width="5%">Remove</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $count = 1; $hide = "";
                $st = $conn->prepare("SELECT * FROM `info_user`");
                  if ($st->execute()) {
                    $r = $st->get_result();
                    while($c = $r->fetch_array()) {
                      if ($count == 1) {
                        $hide = "hide";
                      } else {
                        $hide = "";
                      }
                      ?>
                      <tr class="user" id="<?php echo $c["userId"]; ?>">
                        <td><?php echo $count; ?></td>
                        <td>
                          <p><?php echo $c["username"]; ?></p>
                          <input type="text" id="username<?php echo $c["userId"]; ?>" value="<?php echo $c["username"]; ?>" class="form-control hide">
                        </td>
                        <td>
                          <p><?php echo $c["userpass"]; ?></p>
                          <input type="password" id="userpass<?php echo $c["userId"]; ?>" value="<?php echo $c["userpass"]; ?>" class="form-control hide">
                        </td>
                        <td class="user" id="<?php echo $c["userId"]; ?>"><a href="#" class="btn btn-danger btn-block btn-flat <?php echo $hide; ?>"><i class="fa fa-minus user"></i></td>
                      </tr>
    <?php $count++; }
                  }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="addUser">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="w3-container w3-padding-xlarge">
            <h3 style="color: #000">User Information</h3>
            <div id="UserSuccess"></div>
             <form id="addUserForm">
               <div class="form-group">
                  <input type="text" class="form-control" name="UserFull" placeholder="Fullname" required>
               </div>
               <div class="form-group">
                  <input type="text" class="form-control" name="UserName" placeholder="Username" required>
               </div>
               <div class="form-group">
                  <input type="password" class="form-control" name="UserPass" placeholder="Password" required>
               </div>
               <div class="form-group">
                 <button type="submit" id="saveUserBtn" value="send" class="w3-btn w3-btn-block w3-teal pull-right">Save</button>
              </div>
             </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    include_once '../../pages/static/footer.php';
  ?>
  <script>
    $(function () {
      var tmp = 0;
      document.getElementsByTagName("a")[8].classList.add("w3-light-grey");
     $("td").mouseenter(function () {
       $(this).children("p").hide();
       $(this).children("input").removeClass("hide");
       tmp = 0;
     });
     $("td").mouseleave(function () {
       var v = $(this).children("input").val();
       $(this).children("input").addClass("hide");
       $(this).children("p").text(v);
       $(this).children("p").show();
       var cl = $(this).parent("tr").attr("class");
       var id = $(this).parent("tr").attr("id");
       if (cl == "user") {
         if (tmp > 0) {
           var name = $("#username" + id).val();
           var pass = $("#userpass" + id).val();
           var p = "../../pages/query/update.php";
           var q = "?UserName=" + name + "& UserPass=" + pass + "& id=" + id;
           ajaxRequest(p, q);
         }
       } else {
         if (tmp > 0) {
           var name = $("#ProgramName" + id).val();
           var desc = $("#ProgramDesc" + id).val();
           var p = "../../pages/query/update.php";
           var q = "?ProgramName=" + name + "& ProgramDesc=" + desc + "& id=" + id;
           ajaxRequest(p, q);
         }
       }
     });
     $("td > input").keyup(function () {
       tmp++;
     });
     $("td > a").click(function (e) {
       e.preventDefault();
       var cl = $(this).parent("td").attr("class");
       var id = $(this).parent("td").attr("id");
       if (cl == "user") {
         var con = confirm("Are you sure?");
         var p = "../../pages/query/update.php";
         var q = "?duserId=" + id;
         if (con == true) {
           ajaxRequest(p, q);
         }
       } else {
         var con = confirm("Are you sure?");
         var p = "../../pages/query/update.php";
         var q = "?dProgramNo=" + id;
         if (con == true) {
           ajaxRequest(p, q);
         }
       }
     });
      function ajaxRequest(p, q) {
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
          if (ajax.readyState == 4 && ajax.status == 200) {
            var r = ajax.responseText;
            if (r == 1) {
              window.location = "utility.php";
            }
          }
        }
        ajax.open('GET', p + q , true);
        ajax.send(null);
      }
     })
  </script>
</body>
</html>
