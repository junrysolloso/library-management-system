
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
    <table class="table table-hover" id="showTable">
     <thead>
       <tr>
         <th>Book No.</th>
         <th>Name</th>
         <th>Upd't</th>
         <th>Det'l</th>
       </tr>
     </thead>
       <tbody>
         <?php
           $st = $conn->prepare("SELECT info_book.bookId, `bookNo`, `bookName`, `bookCat`, `bookAut`, `bookPub`, `bookEdit`, `noCopies` FROM `info_book`
           INNER JOIN `info_bookjunc` ON info_book.bookId = info_bookjunc.bookId
           INNER JOIN `info_bookcat`  ON info_bookcat.bookCatId = info_bookjunc.bookCatId
           INNER JOIN `info_bookaut`  ON info_bookaut.bookAutId = info_bookjunc.bookAutId
           INNER JOIN `info_bookpub`  ON info_bookpub.bookPubId = info_bookjunc.bookPubId
           INNER JOIN `info_bookedit` ON info_bookedit.bookEditId = info_bookjunc.bookEditId ");
           if ($st->execute()) {
             $count = 1;
           $r = $st->get_result();
           while ($f = $r->fetch_array()) { ?>
             <tr>
               <td><?php echo $f["bookNo"]; ?></td>
               <td><?php echo $f["bookName"]; ?></td>
               <td><a href="updateBook.php?q=<?php echo $f["bookId"]; ?>" class="w3-btn w3-teal w3-small"><i class="fa fa-pencil"></i></a></td>
               <td class="w3-center" id="<?php echo $f["bookId"]; ?>"><a href="#" class="w3-btn w3-teal w3-small bbook" id="showDetails<?php echo $f["bookId"]; ?>"><i class="fa fa-eye"></i></a></td>
             </tr>
         <?php $count++;
         }
       }
      ?>
       </tbody>
     </table>
  </div>
  <?php
    include_once '../../pages/static/footer.php';
  ?>
  <script>
    $(function () {
      document.getElementsByTagName("a")[3].classList.add("w3-light-grey");
    })
  </script>
</body>
</html>
