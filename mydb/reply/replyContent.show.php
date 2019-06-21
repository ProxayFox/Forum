<?php
require_once('../databaseManager/DBEnter.db.php');
?>

<div>
  <?php
  //join table `reply` and table `clientProfile` in order to get required information
  $reply = DB::query("
    SELECT clientProfile.UIMG, login.UName, reply.content, reply.created
    FROM reply 
      INNER JOIN clientProfile 
        ON reply.CDID = clientProfile.CDID 
      INNER JOIN login 
        ON clientProfile.CDID = login.CDID 
    WHERE reply.PID = ".$PID." 
    ORDER BY reply.RID ASC
  ");
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
              <!-- using php the img will swap from generic picture to the users profile img if the user has one aligned -->
              <img src="<?php if (!empty($img)) {
                echo "./img/profileIMG/".$img;
              } else {
                echo "./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";
              } ?>" class="img-thumbnail" style="height: 80px; width: 80px;" alt="User Profile Image">
              <div style="padding-left: 10px;">
                <h3 style="padding-top: 10px;"><?php echo $userName; ?></h3>
                <i>&nbsp-&nbsp<?php echo $date; ?></i>
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