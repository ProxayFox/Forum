<?php
session_start();
require_once('../../databaseManager/DBEnter.db.php');
$CP = DB::queryFirstRow("SELECT UIMG FROM clientProfile WHERE CDID = ".$_SESSION['cdid']);
?>

<!-- Activity -->
<section id="activity">
  <h1><?php echo $_SESSION['user']; ?>'s Activity </h1>
  <?php
  //querying for reply Reputation and reply information
  $replyResult = DB::query("SELECT * FROM reply LEFT JOIN replyRep ON reply.CDID WHERE reply.CDID =".$_SESSION['cdid']);
  if ($replyResult != NULL) {
    foreach ($replyResult as $row) {
      $tid = $row['TID'];
      $pid = $row['PID'];
      $content = $row['content'];
      $created = $row['created'];
      $replyUpRep = $row['upRep'];
      $replyDownRep = $row['downRep'];

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

      //querying the post title
      $postResult = DB::query("SELECT * FROM post WHERE PID = ".$pid);
      if ($postResult != NULL) {
        foreach ($postResult as $row1) {
          $postTitle = $row1['title'];
          ?>
          <div class="container">
            <div class="row">
              <div class="col-2 text-center">
                <img src="<?php if (!empty($CP['UIMG'])) {
                  echo "./img/profileIMG/" . $CP['UIMG'];
                } else {
                  echo "./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";
                } ?>" style="width: 75px; height: 75px;" class="img-thumbnail" alt="avatar">
              </div>
              <div class="col-10">
                <div>
                  <div class="row">
                    <h4><?php echo $postTitle."  ";?></h4>
                    <p style="padding-left: 10px;"><?php
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
                      ?></p>
                  </div>
                  <p><?php echo $content; ?></p>
                </div>
              </div>
            </div>
            <hr>
          </div>

          <?php
        }
      } else {
        echo "something went wrong with post query <br>";
      }
    }
  } else{
    echo "something went wrong with the reply query <br>";
  }
  ?>
</section>
