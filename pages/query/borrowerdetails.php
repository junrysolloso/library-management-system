<?php
  require_once '../../pages/class/connection.php';
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
      $id = htmlspecialchars(trim($_GET['id']));
      $t = "";
      $st = $conn->prepare("SELECT info_borrower.borrowerId, `studentid`, `firstname`, `middlename`, `lastname`, `phone`, `address` FROM `info_borrower`
      INNER JOIN `info_borrowerjunc` ON info_borrower.borrowerId = info_borrowerjunc.borrowerId
      INNER JOIN `info_level` ON info_level.levelId = info_borrowerjunc.levelId
      WHERE info_borrower.borrowerId = ?");
      if ($st->bind_param("i", $id)) {
        if ($st->execute()) {
          $r = $st->get_result();
          while ($f = $r->fetch_array()) {
            $t .= '<h5>Borrower Information</h5><div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'ID Number';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["studentid"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Fullname';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["firstname"].' '.$f["middlename"].'. '.$f["lastname"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Phone Number';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["phone"];
            $t .= '</div>';
            $t .= '</div>';

            $t .= '<div class="row">';
            $t .= '<div class="col-sm-6">';
            $t .= 'Address';
            $t .= '</div>';
            $t .= '<div class="col-sm-6">';
            $t .= ': '.$f["address"];
            $t .= '</div>';
            $t .= '</div>';
          }
        }
      }
    }
  }
  echo $t;
?>
