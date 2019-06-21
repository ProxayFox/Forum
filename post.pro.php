<?php
session_start();
// checking if the user exist and has the required information, if they don't it will redirect back to index
if (array_key_exists("user", $_SESSION) & !empty($_GET['TID']) & !empty($_GET['PID'])) {
  require_once("./mydb/databaseManager/DBEnter.db.php");
  //ignore this for now, this is just to help me see what's happening on the server
  include("./layouts/header.php");
  $TID = $_GET['TID'];
  $PID = $_GET['PID'];
  ?>
  <script>
    $(document).ready(function() {
      $('#postReplies').load("./mydb/reply/relyContent.show.php?TID=<?php echo $TID; ?>&PID=<?php echo $PID ?>");
      $('[data-toggle="popover"]').popover();
    });

    $(document).ready(function() {
      $("#postUpdate").click(function () {
        $('#spinner').addClass('spinner-border spinner-border-sm');
        $.post("./mydb/posts/createPost.db.php", {
              TID: $("#TID").val(),
              title: $("#title").val(),
              info: $("#info").val()
            },

            function (data, status) {
              $('#spinner').removeClass('spinner-border spinner-border-sm');
              $("#displaySuccess").html(data);
              if (status === "success") {
                $('#myModal').modal('toggle');
                $('#postReplies').load("./mydb/reply/relyContent.show.php?TID=<?php echo $TID; ?>&PID=<?php echo $PID ?>");
                console.log('hidden and reloaded');
              }
              console.log(data, status);
            }
        )
      });
    });
  </script>
    <!-- main page open -->
    <section class="container">
      <div class="row">
        <?php
        // left join in order to get the users username so we'll need post and login
        $titleInfo = DB::query("
          SELECT post.title, post.created, login.UName, login.CDID, clientProfile.UIMG
          FROM post 
            LEFT JOIN login 
              ON post.CDID = login.CDID 
            RIGHT JOIN clientProfile
              ON post.CDID = clientProfile.CDID
          WHERE post.PID =".$PID
        );
        foreach  ($titleInfo as $row) {
          $title = $row['title'];
          $created = $row['created'];
          $UN = $row['UName'];
          $CDID = $row['CDID'];
          $uimg = $row['UIMG'];
          ?>
          <!--  this is the area at the top with he post information-->
          <!-- I'll call this title start -->
          <div>
            <!-- using php the img will swap from generic picture to the users profile img if the user has one aligned -->
            <img src="<?php if (!empty($uimg)) {
              echo "./img/profileIMG/" . $uimg;
            } else {
              echo "./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";
            } ?>" class="img-thumbnail" style="height: 80px; width: 80px;" alt="User Profile Image">
          </div>
          <div style="padding-left: 10px;">
            <h2 style="padding-top: 10px;"><?php echo $title; ?></h2>
            <i style=""> - Posted By <span><?php echo $UN; ?>&nbsp</span></i>
            <i style="">- On <span><?php echo $created; ?></span></i>
          </div>
          <?php
        }
        ?>
      </div>
      <br>
      <!-- this is the end of title -->

      <!-- this is the area that holds all the conversations -->
      <!-- conversations start -->
      <section>
        <div class="row">
          <!-- directed to the left side of the page -->
          <div class="col-9">
            <div id="postReplies">
              <!-- jQueary shows the data -->

              <!-- -->
            </div>
          </div>
          <!-- right side of the page start -->
          <div class="col-3">
            <h5>Community Details</h5>
            <h6>will be here soon</h6>
          </div>
        </div>
        <!-- right side of the page end -->
      </section>

         <!-- this is the start of the reply section -->
         <!-- I'll call this reply section start -->
         <div id="replySection">
           <form id="Thread" class="login-form hidden" action="./mydb/reply/createReply.db.php" method="POST" role="form">
             <?php
              $img = DB::query("
                SELECT UIMG 
                FROM clientProfile 
                WHERE CDID =".$_SESSION['cdid']
              );
              foreach ($img as $row) {
                $uimg = $row['UIMG'];

             ?>
               <div class="row border" style="padding: 10px;">
                 <!-- using php the img will swap from generic picture to the users profile img if the user has one aligned -->
                 <img src="<?php if (!empty($uimg)) {
                   echo "./img/profileIMG/".$uimg;
                 } else {
                   echo "./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";
                 } ?>" class="img-thumbnail" style="height: 80px; width: 80px;" alt="User Profile Image">
                 <label for="reply"></label>
                 <div style="margin-top: 10px; margin-left: 5px;">
                   <input type="hidden" name="TID" value="<?php echo $TID; ?>">
                   <input type="hidden" name="PID" value="<?php echo $PID; ?>">
                   <textarea type="text" id="reply" name="reply" class="form-control" placeholder="input your reply..."
                             cols="90%" rows="2" required></textarea>
                   <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
                 </div>
               </div>
             <?php
             }
             ?>
           </form>
         </div>
        <!-- Reply section end -->
    </section>
    <!-- main page close -->




  <?php
  include("./layouts/footer.php");
}else{
  header('location: index.php?pageaccess=forbidden');
  exit;
}
?>


