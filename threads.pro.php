<?php
require_once("mydb/o-db.php");
session_start();
if (array_key_exists("user", $_SESSION)) {
  // Do Something
  include("header.php");
  $result = myDB::getInstance()->getAllThreads();
?>
  <h1 class="text-center">Threads</h1>
  <section class="container">
    <div class="row">
      <div class="col-sm-3 text-center">
        <h3 class="text-center">Creat Thread</h3>
        <button onclick="btn('show')" id="show" class="btn btn-primary" style="">Make Thread</button>
      </div>
      <div class="col-sm-9 text-center">
        <!-- displays all the threads after searching the database-->
        <?php
        if ($result != FALSE) {
          while ($row = $result->fetch_row()) {
            echo '<p>'.$row[0].'</p><p>'.$row[1].'</p><p>'.$row[2].'</p><p>'.$row[3].'</p><p>'.$row[4].'</p><p>'.$row[5].'</p>';
          }
        } else {
          echo '<h3>No Current threads</h3>';
        }
        ?>
      </div>
    </div>
  </section>

  <script>

  </script>

<?php
  include("footer.php");
  }else{
  header('location: index.php?pageaccess=forbidden');
  exit;
}
?>