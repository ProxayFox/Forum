<?php
session_start();
if (array_key_exists("user", $_SESSION) & !empty($_GET['TID']) & !empty($_GET['PID'])) {
//  require_once("./mydb/databaseManager/o-db.php");
  require_once("./mydb/databaseManager/meekrodb.2.3.class.php");
  DB::$user = 'localhost';
  DB::$dbName = 'forum';
  DB::$user = 'root';
  DB::$password = '';
  // including the head of the HTML and data
  include("./layouts/header.php");
  $TID = $_GET['TID'];
  $PID = $_GET['PID'];
  echo $TID," ", $PID;
  ?>

    <section class="container">
      <section>
        <div class="container">
          <div class="row">
            <?php
            // left join in order to get the users username so we'll need post and login
            $titleInfo = DB::query("SELECT * FROM post LEFT JOIN login ON post.CPID = login.CPID WHERE post.PID =".$PID);
            foreach  ($titleInfo as $row){
              $title = $row['title'];
              $created= $row['created'];
              $UN = $row['UName'];
              $CPID = $row['CPID'];
              $img = DB::query("SELECT UIMG FROM clientprofile WHERE CPID =".$CPID);
              foreach ($img as $row) {
                $uimg = $row['UIMG'];

              ?>
              <div>
                <img src="./img/<?php if (!empty($uimg)) {echo $uimg;} else { echo "Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";} ?>" class="img-thumbnail" style="height: 80px; width: 80px;" alt="User Profile Image">
              </div>
              <div style="padding-left: 10px;">
                <h2 style="padding-top: 10px;"><?php echo $title;?></h2>
                <i style=""> - Posted By <span><?php echo $UN; ?>&nbsp</span></i>
                <i style="">- On <span><?php echo $created; ?></span></i>
              </div>
              <?php
            }}
            ?>
          </div>
          <div class="row">
           <div class="col-9">
             <h1>posting area</h1>
             <br>
             <div>
               <form id="Thread" class="login-form hidden" action="./mydb/thread/creatThread.db.php" method="POST" role="form">
                 <?php
                 $img = DB::query("SELECT UIMG FROM clientprofile WHERE CPID =".$_SESSION['cpid']);
                 foreach ($img as $row) {
                   $uimg = $row['UIMG'];
                 }
                 ?>
                 <div class="$row">
                   <img src="./img/<?php if (!empty($uimg)) {echo $uimg;} else { echo "Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";} ?>" class="img-thumbnail" style="height: 80px; width: 80px;" alt="User Profile Image">
                   <textarea type="text" id="reply" name="reply" class="form-control" placeholder="input your reply..." required></textarea>
                 </div>
               </form>
             </div>
            </div>
            <div class="col-3">
              <h5>Community Details</h5>
              <h6>will be here soon</h6>
            </div>
          </div>
        </div>
      </section>
    </section>




  <?php
  include("./layouts/footer.php");
}else{
  header('location: index.php?pageaccess=forbidden');
  exit;
}
?>