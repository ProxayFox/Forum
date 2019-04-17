<?php
require_once("mydb/o-db.php");
session_start();
if (array_key_exists("user", $_SESSION)) {
  // Do Something
  include("header.php");
?>
  <div>
    <section class="container" style="">
      <h1 class="text-center">Threads</h1>
    </section>
  </div>

<?php
  include("footer.php");
}else{
  header('location: index.php?pageaccess=forbidden');
  exit;
}
?>