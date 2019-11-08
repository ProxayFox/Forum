<?php
  session_start();
  if (array_key_exists("user", $_SESSION)) {
    //add the header
    include("./layouts/header.php");
    //add the database manager
    require_once('./mydb/databaseManager/DBEnter.db.php');
    //CP = client profile. also this is gathering all the info for the profile
    $CP = DB::queryFirstRow("SELECT displayName, UIMG, web, social, postNo FROM clientProfile WHERE CDID = ".$_SESSION['cdid']);
    if ($CP != NULL) {
      //DN = display name
      $DN = $CP['displayName'];
      $uimg = $CP['UIMG'];
      $web = $CP['web'];
      $social = $CP['social'];
      $postNo = $CP['postNo'];

      ?>

      <script>

      </script>




      <!--<script>
        $(document).ready(function () {
          const btnActivity = $("#btnActivity");
          const btnAboutMe = $("#btnAboutMe");
          const btnEditProfile = $("#btnEditProfile");
          const load = $('#load');

          load.load("./mydb/profile/profileShower/activity.db.show.php");

          btnActivity.click(function () {
            btnActivity.addClass("btn-primary");
            btnActivity.removeClass("btn-outline-primary");
            btnAboutMe.removeClass("btn-primary");
            btnAboutMe.addClass("btn-outline-primary");
            btnEditProfile.removeClass("btn-primary");
            btnEditProfile.addClass("btn-outline-primary");
            load.load("./mydb/profile/profileShower/activity.db.show.php");
          });

          btnAboutMe.click(function () {
            btnActivity.removeClass("btn-primary");
            btnActivity.addClass("btn-outline-primary");
            btnAboutMe.addClass("btn-primary");
            btnAboutMe.removeClass("btn-outline-primary");
            btnEditProfile.removeClass("btn-primary");
            btnActivity.addClass("btn-outline-primary");
            load.load("./mydb/profile/profileShower/aboutMe.db.show.php");
          });

          btnEditProfile.click(function () {
            btnActivity.removeClass("btn-primary");
            btnActivity.addClass("btn-outline-primary");
            btnAboutMe.removeClass("btn-primary");
            btnAboutMe.addClass("btn-outline-primary");
            btnEditProfile.addClass("btn-primary");
            btnEditProfile.removeClass("btn-outline-primary");
            load.load("./mydb/profile/profileShower/editProfile.db.show.php");
          });

        });
      </script> -->

      <!--  Profile Section of the page -->
      <section class="container">
        <br>
        <!-- Profile Left and Right-->
        <div class="row">
          <div class="col-sm-3" style="background-color: darkgray;"><!-- Left side start -->
            <br>
            <!-- user profile img -->
            <div class="text-center" style=" padding: 5px;">
              <img src="<?php if (!empty($uimg)) {
                echo "./img/profileIMG/" . $uimg;
              } else {
                echo "./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";
              } ?>" style="width: 200px; height: 200px;   " class="img-fluid rounded" alt="avatar">
            </div>
            <br>
            <!-- profile social media pages -->
            <table class="table">
              <thead class="thead-dark">
              <th scope="col">Websites</th>
              </thead>
              <tbody>
              <tr>
                <td>
                  <?php
                  if ($web == null) {
                    ?><p><strong>no website yet</strong></p><?php
                  } else {
                    ?><a target="_blank" href="http://<?php echo $web; ?>"><?php echo $web; ?></a><?php
                  }
                  ?>
                </td>
              </tr>
              </tbody>
            </table>

            <!-- basic reputation table -->
            <table class="table">
              <thead class="thead-dark">
              <tr>
                <th scope="col">Activity</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td><strong>Shares</strong></td>
                <td></td>
                <td>0</td>
              </tr>
              <tr>
                <td><strong>Reputation</strong></td>
                <td></td>
                <td>0</td>
              </tr>
              <tr>
                <td><strong>Posts</strong></td>
                <td></td>
                <td><?php if ($postNo == null) {
                    echo 0;
                  } else {
                    echo $postNo;
                  } ?></td>
              </tr>
              <tr>
                <td><strong>Followers</strong></td>
                <td></td>
                <td>0</td>
              </tr>
              </tbody>
            </table>

            <!-- profile external social platforms -->
            <table class="table">
              <thead class="thead-dark">
              <th scope="col">Social Media</th>
              </thead>
              <tbody>
              <tr>
                <td>
                  <?php
                  if ($social == null) {
                    ?><p><strong>No link</strong></p><?php
                  } else {
                    ?><a target="_blank" href="http://<?php echo $social; ?>"><?php echo $social; ?></a><?php
                  }
                  ?>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- Left Col End-->
          <br>

          <!-- Right Col Start -->
          <div class="col-sm-9" style="background-color: lightgray;">
            <!-- Button Selection for Activity About Me and Edit profile-->
            <div class="row container" style="padding-top: 10px;">
              <button id="btnActivity" class="btn btn-primary" style="">Activity</button>
              <button id="btnAboutMe" class="btn btn-outline-primary" style="">About Me</button>
              <button id="btnEditProfile" class="btn btn-outline-primary" style="">Edit Profile</button>
            </div>

            <!-- The Three different sections of the profile -->
            <section id="load">
              <!-- documents will be loaded here -->
            </section>
          </div><!-- Right Col End -->
        </div>
      </section>
      <br>

      <script
          src="https://code.jquery.com/jquery-3.4.0.min.js"
          integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
          crossorigin="anonymous">
      </script>

      <?php
    } else {
      echo "something went wrong with client profile search<br>";
      echo DB::affectedRows();
    }


    include("./layouts/footer.php");
  }else{
    header('location: index.php?pageaccess=forbidden');
    exit;
  }
?>