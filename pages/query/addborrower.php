<?php
  require_once '../../pages/class/connection.php';
  function  iCheckExisting($tbl, $col, $pat, $val)
  {
    $connection = new connection();
    $conn = $connection->connect();
    $st = $conn->prepare("SELECT `$col` FROM `$tbl` WHERE `$pat` = ?");
    if ($st->bind_param("s", $val)) {
      if ($st->execute()) {
        $r = $st->get_result();
        $f = $r->fetch_array();
        if ($f[0] > 0) {
          return true;
        } else {return false;}
      }
    }
  }
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['studentid'])) {
      extract($_GET);
      if (iCheckExisting("info_borrower", "borrowerId", "studentid", $studentid)) {
        echo 2;
      } else {
        $st = $conn->prepare("INSERT INTO `info_borrower` (`studentid`, `firstname`, `Middlename`, `lastname`, `phone`, `address`) VALUES (?, ?, ?, ?, ?, ?)");
        if ($st->bind_param("ssssss", $studentid, $firstname, $middlename, $lastname, $phone, $address)) {
          if ($st->execute()) {
            $st = $conn->prepare("INSERT INTO `info_borrowerjunc` (`borrowerId`, `levelId`)
            SELECT MAX(borrowerId), (SELECT `levelId` FROM `info_level` WHERE `levelName` = ?) FROM `info_borrower`");
            if ($st->bind_param("s", $levelName)) {
              if ($st->execute()) {
                echo 1;
              } else {echo 0;}
            }
          }
        }
      }
    }
  }
?>
