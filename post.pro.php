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
          <br>
          <div class="row">
           <div class="col-9">
             <?php
              $reply = DB::query("SELECT * FROM reply INNER JOIN clientprofile ON reply.CPID = clientprofile.CPID INNER JOIN login ON clientprofile.CPID = login.CPID WHERE reply.PID = ".$PID." ORDER BY reply.RID ASC");
              foreach ($reply as $row) {
                $img = $row['UIMG'];
                $userName = $row['UName'];
                $content = $row['content'];
                $date = $row['created'];

             ?>
             <div class="border container" style="margin-bottom: 10px;">
               <div style="padding-top: 10px; padding-bottom: 10px;">
                 <div class="row">
                   <div class="col-12">
                     <div class="row">
                       <img src="./img/<?php echo $img; ?>" alt="User profile img" class="thumbnail" style="width: 80px; height: 80px;">
                       <div style="padding-left: 10px;">
                         <h3 style="padding-top: 10px;"><?php echo $userName; ?></h3>
                         <i>&nbsp-&nbsp<?php echo $date; ?></i>
                       </div>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-12">
                      <p><?php echo $content; ?></p>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <?php
              }
             ?>
             <br>
             <div>
               <form id="Thread" class="login-form hidden" action="./mydb/reply/creatReply.db.php" method="POST" role="form">
                 <?php
                 $img = DB::query("SELECT UIMG FROM clientprofile WHERE CPID =".$_SESSION['cpid']);
                 foreach ($img as $row) {
                   $uimg = $row['UIMG'];
                 ?>
                 <div class="row border" style="padding: 10px;">
                   <img src="./img/<?php if (!empty($uimg)) {echo $uimg;} else { echo "Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";} ?>" class="img-thumbnail" style="height: 80px; width: 80px;" alt="User Profile Image">
                   <label for="reply"></label>
                   <div style="margin-top: 10px; margin-left: 5px;">
                     <input type="hidden" name="TID" value="<?php echo $TID; ?>">
                     <input type="hidden" name="PID" value="<?php echo $PID; ?>">
                     <textarea type="text" id="reply" name="reply" class="form-control" placeholder="input your reply..." cols="90%" rows="2" required></textarea>
                     <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
                   </div>
                 </div>
                 <?php } ?>
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


