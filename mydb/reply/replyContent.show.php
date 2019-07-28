<?php
require_once('../databaseManager/DBEnter.db.php');
$PID = $_GET['PID'];
?>

<div>
  <?php
  //join table `reply` and table `clientProfile` in order to get required information
  $reply = DB::query("
    SELECT clientProfile.UIMG, login.UName, reply.content, reply.created
    FROM reply 
      LEFT JOIN clientProfile 
        ON reply.CDID = clientProfile.CDID 
      RIGHT JOIN login 
        ON clientProfile.CDID = login.CDID 
    WHERE reply.PID = ".$PID." 
    ORDER BY reply.RID ASC
  ");
  foreach ($reply as $row) {
    $img = $row['UIMG'];
    $userName = $row['UName'];
    $content = $row['content'];
    $date = $row['created'];

    // Date Calculator
    $date1 = $date;
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
    <div class="border container" style="margin-bottom: 10px;">
      <div style="padding-top: 10px; padding-bottom: 10px;">
        <div class="row">
          <div class="col-12">
            <div class="row">
              <!-- using php the img will swap from generic picture to the users profile img if the user has one aligned -->
              <img src="<?php if (!empty($img)) {
                echo "./img/profileIMG/".$img;
              } else {
                echo "./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";
              } ?>" class="img-thumbnail" style="height: 80px; width: 80px;" alt="User Profile Image">
              <div style="padding-left: 10px;">
                <h3 style="padding-top: 10px;"><?php echo $userName; ?></h3>
                <i>&nbsp-&nbsp<?php
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
                  } elseif ($sec >= 0) {
                    echo $sec;
                  } else {
                    echo "Time Error";
                  }
                ?></i>
              </div>
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
    <?php
  }
  ?>
  <br>
</div>
<!-- end of conversations -->