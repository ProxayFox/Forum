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
      $('#postReplies').load("./mydb/reply/replyContent.show.php?PID=<?php echo $PID ?>");
      $('[data-toggle="popover"]').popover();
      console.log("ready")
    });

    $(document).ready(function() {
      $("#postUpdate").click(function () {
        $('#spinner').addClass('spinner-border spinner-border-sm');
        $.post("./mydb/reply/createReply.db.php", {
              TID: $("#TID").val(),
              PID: $("#PID").val(),
              reply: $("#reply").val()
            },

            function (data, status) {
              $('#spinner').removeClass('spinner-border spinner-border-sm');
              $("#displaySuccess").html(data);
              if (status === "success") {
                $('#postReplies').load("./mydb/reply/replyContent.show.php?PID=<?php echo $PID ?>");
                $('#reply').val('');
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

          // Date Calculator
          $date1 = $created;
          $date2 = date("Y-m-d H:i:s");

          $start_date = new DateTime($date1);
          $since_start = $start_date->diff(new DateTime($date2));
          $years = $since_start->y . ' year/s ago<br>';
          $months = $since_start->m . ' month/s ago<br>';
          $days = $since_start->d . ' day/s ago<br>';
          $hour = $since_start->h . ' hour/s ago<br>';
          $min = $since_start->i . ' minute/s ago<br>';
          $sec = $since_start->s . ' second/s ago<br>';
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
            <i style=""><span><?php
                if ($years >= 1) {
                  echo $years;
                } elseif ($months >= 1) {
                  echo $months;
                } elseif ($days >= 1) {
                  echo $days;
                } elseif ($hour >= 1) {
                  echo $hour;
                } elseif ($min >= 1) {
                  echo $min;
                } elseif ($sec >= 1) {
                  echo $sec;
                } else {
                  echo "Time Error";
                }
                ?></span></i>
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
            <div id="displaySuccess">
              <!-- display success message -->
            </div>
            <h5>Community Details</h5>
            <h6>will be here soon</h6>
          </div>
        </div>
        <!-- right side of the page end -->
      </section>

         <!-- this is the start of the reply section -->
         <!-- I'll call this reply section start -->
         <div id="replySection">
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
                 } ?>"
                  class="img-thumbnail" style="height: 80px; width: 80px;" alt="User Profile Image">

                 <div id="postForm" style="margin-top: 10px; margin-left: 5px;">
                   <input type="hidden" id="TID" value="<?php echo $TID; ?>">
                   <input type="hidden" id  ="PID" value="<?php echo $PID; ?>">
                   <textarea type="text" id="reply" name="reply" class="form-control" placeholder="input your reply..." cols="75%" rows="2" required></textarea>
                   <button id="postUpdate" type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit<span style="height:15px; width:15px; margin-right: 10px;" id="spinner"></button>
                 </div>
               </div>
             <?php
             }
             ?>
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


