<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      include_once 'pages/static/header.php';
      $flag = 1; $msgClass = $msg = "";
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['loginBtn'])) {
          // Clean data
          function cleanUp($data)
          {
            $data = htmlspecialchars($data);
            $data = trim($data);
            return $data;
          }
          // Check funtion
          function iCheckUser($name, $pass)
          {
            $conn = mysqli_connect("localhost", "root", "", "libsystem");
            $st = $conn->prepare("SELECT `userId` FROM `info_user`
            WHERE `username` = ? AND `userpass` = ?");
            if ($st->bind_param("ss", $pass, $name)) {
              if ($st->execute()) {
                $r = $st->get_result();
                $f = $r->fetch_array();
                $r = $f[0];
                if ($r !== 0 && $r !== NULL) {
                  return $r;
                } else {
                  return 0;
                }
                $st->close();
                $conn->close();
              }
            }
          }
          // Validate
          $name = cleanUp($_POST['username']);
          $pass = cleanUp($_POST['password']);
          // Check if empty
          if (empty($name) || empty($pass)) {
            $msgClass = "danger";
            $msg = "Fields Cannot Be Empty.";
            $flag = 0;
          }
          // Allow only letters
          if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
            $msgClass = "danger";
            $msg = "Only Letter Allowed";
            $flag = 0;
          }
          // Try to check
          if ($flag !== 0) {
            $r = iCheckUser($name, $pass);
            if($r !== 0 && $r !== NULL) {
              session_start();
              $_SESSION['userId'] = $r;
              if ($_SESSION['userId']) {
                echo '<script>window.location="index.php"</script>';
              }
            } else {
              $msgClass = "danger";
              $msg = "Username not found.";
            }
          }
        }
      }
   ?>
  </head>
  <body style="overflow-x: hidden">
    <div style="margin-top: 10%">
      <div class="row">
        <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
              <div class="w3-container w3-card-2 w3-padding-large">
              <div class="w3-container w3-padding-large">
                <div class="row">
                  <div class="col-sm-12">
                    <h5 class="text-<?php echo $msgClass; ?> text-center"><?php echo $msg ?></h5>
                    <h3 class="text-center"><i class="fa fa-user"></i> User Login</h3>
                    <hr>
                    <div class="form-group">
                      <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <br>
                    <div class="form-group">
                      <button type="submit" name="loginBtn" class="w3-btn w3-blue w3-btn-block center-block"><i class="fa fa-sign-in"></i> Login</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          </div>
        <div class="col-sm-4"></div>
      </div>
    </div>
  </body>
</html>
