<?php
  require_once('./mydb/databaseManager/meekrodb.2.3.class.php');
  require_once('./mydb/databaseManager/DBEnter.db.php');
  session_start();
  if (array_key_exists("user", $_SESSION)) {
    // Do Something
    include("./layouts/header.php");

    //CP = client profile. also this is gathering all the info for the profile
    $CP = DB::queryFirstRow("SELECT * FROM clientProfile WHERE CPID = ".$_SESSION['cpid']);
    if ($CP != null) {
      $fName = $CP['fName'];
      $lName = $CP['lName'];
      //DN = display name
      $DN = $CP['displayName'];
      $uimg = $CP['UIMG'];
      $web = $CP['web'];
      $social = $CP['social'];
      $upRep = $CP['upRep'];
      $downRep = $CP['downRep'];
      $rep = $CP['rep'];
      $postNo = $CP['postNo'];
      $followers = $CP['followers'];
      $shares = null;

?>
      <script>
        function updateUIMG(whatArea) {
          console.log(whatArea);
          $.post("./mydb/profile/updateIMG.db.php", {
                img: whatArea
              },
              function (data, status) {
                $("#displaySuccess").HTML(data);
                console.log(status);
              }
          )
        }
      </script>
      <style>
        .hidden {
          display: none !important;
        }
      </style>

      <!--  Main Section of the page -->
      <section style="background-color: #c6d4ff">

        <!--  Profile Section of the page -->
        <section class="container" style="">

          <!-- Header for profile section -->
          <div class="row">
            <div class="col-sm-10" style="padding: 5px;">
              <h1>User Profile</h1>
            </div>
            <div class="col-sm-2" style="padding: 5px;">
              <img src="<?php if (!empty($uimg)) {
                echo "./img/profileIMG/".$uimg;
              } else {
                echo "./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";
              } ?>" style="width: 100px; height: 100px;" title="profile image" class="img-circle img-responsive rounded">
            </div>
          </div>
          <!-- Profile Left and Right-->
          <div class="row">
            <div class="col-sm-3" style="background-color: darkgray;"><!--left col start-->
              <br>

              <div class="text-center" style=" padding: 5px;">
                <img src="<?php if (!empty($uimg)) {
                  echo "./img/profileIMG/".$uimg;
                } else {
                  echo "./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";
                } ?>" style="width: 200px; height: 200px;   " class="avatar rounded-circle img-thumbnail" alt="avatar">
                <div class="form-group">
                  <h6>Upload a different photo</h6>
                  <input type="file" class="text-center center-block file-upload" id="img">
                  <button class="btn btn-primary" onclick="updateUIMG(img)" style="!important;float: left; margin-top: 5px;">Submit</button>
                </div>
              </div>
              <br>

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
                    <td><?php if ($shares == null) {echo 0;} else {echo $shares;} ?></td>
                  </tr>
                  <tr>
                    <td><strong>Reputation</strong></td>
                    <td></td>
                    <td><?php if ($rep == null) {echo 0;} else {echo $rep;} ?></td>
                  </tr>
                  <tr>
                    <td><strong>Posts</strong></td>
                    <td></td>
                    <td><?php if ($postNo == null) {echo 0;} else {echo $postNo;} ?></td>
                  </tr>
                  <tr>
                    <td><strong>Followers</strong></td>
                    <td></td>
                    <td><?php if ($followers == null) {echo 0;} else {echo $followers;} ?></td>
                  </tr>
                </tbody>
              </table>

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
            </div><!-- Left Col End-->
            <br>

            <!-- Right Col Start -->
            <div class="col-sm-9" style="background-color: lightgray;">
              <!-- Button Selection for Activity About Me and Edit profile-->
              <div class="row">
                <button onclick="btn('activity')" id="btnActivity" class="btn btn-primary"
                        style="margin-top: 5px; width: 100px;">Activity
                </button>
                <button onclick="btn('aboutMe')" id="btnAboutMe" class="btn" style="margin-top: 5px; width: 100px;">
                  About Me
                </button>
                <button onclick="btn('editProfile')" id="btnEditProfile" class="btn"
                        style="margin-top: 5px; width: 100px;">Edit Profile
                </button>
              </div>
              <!-- The Three different sections of the profile -->
              <!-- Activity -->
              <section id="activity" class="">
                <h1><?php echo $_SESSION['user']; ?>'s Activity </h1>
                <?php
                  $replyResult = DB::query("SELECT * FROM reply LEFT JOIN replyRep ON reply.CPID WHERE reply.CPID =".$_SESSION['cpid']);
                  foreach ($replyResult as $row) {
                      $tid = $row['TID'];
                      $pid = $row['PID'];
                      $content = $row['content'];
                      $created = $row['created'];
                      $replyUpRep = $row['upRep'];
                      $replyDownRep = $row['downRep'];

                      $postResult = DB::query("SELECT * FROM post WHERE PID = ".$pid);
                      foreach ($postResult as $row) {
                        $postTitle = $row['title'];
                          ?>
                            <div class="container">
                              <div class="row">
                                <div class="col-2 text-center">
                                  <img src="<?php if (!empty($uimg)) {
                                    echo "./img/profileIMG/".$uimg;
                                  } else {
                                    echo "./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";
                                  } ?>" style="width: 75px; height: 75px;" class="img-thumbnail" alt="avatar">
                                </div>
                                <div class="col-10">
                                  <div>
                                    <h4><?php echo $postTitle; ?></h4>
                                    <p><?php echo $content; ?></p>
                                    <?php
                                    $date1 = $created;
                                    $date2 = date("Y-m-d H:i:s");

                                    $diff = abs(strtotime($date2) - strtotime($date1));

                                    $years = floor($diff / (365*60*60*24));
                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                    $hours = floor($diff - $years * 365*60*60*24 - $months * 30*60*60*24 - $days * 60*60*24) / (60);
                                    $minutes = floor($diff - $years * 365*60*60*24 - $months * 30*60*60*24 - $days * 60*60*24 - $hours * 60*60) / (60);
                                    $seconds =  floor($diff - $years * 365*60*60*24 - $months * 30*60*60*24 - $days * 60*60*24 - $hours * 60*60 - $minutes * 60);
                                    ?>
                                    <p><?php echo $years; ?></p>
                                    <p><?php echo $months; ?></p>
                                    <p><?php echo $days; ?></p>
                                    <p><?php echo $hours; ?></p>
                                    <p><?php echo $minutes; ?></p>
                                    <p><?php echo $seconds; ?></p>
                                    <p><?php echo $diff; ?></p>
                                    <p><?php echo $date1; ?></p>
                                    <p><?php echo $date2; ?></p>
                                  </div>
                                </div>
                              </div>
                              <hr>
                            </div>

                          <?php
                      }
                    }
                ?>
              </section>

              <!-- About Me -->
              <section id="aboutMe" class="hidden">
                <h1>About <?php echo $_SESSION['user']; ?></h1>
              </section>
              <!-- Edit the User Profile-->
              <section id="editProfile" class="hidden">
                <form class="form" action="./mydb/profile/updateProfile.db.php" method="post" id="registrationForm">
                  <div class="row">
                    <div class="col">
                      <label for="first_name"><h4>First name</h4></label>
                      <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name"
                             title="enter your first name if any.">
                    </div>
                    <div class="col">
                      <label for="last_name"><h4>Last name</h4></label>
                      <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name"
                             title="enter your last name if any.">
                    </div>
                  </div>
                  <div class="col">
                    <label for="email"><h4>Email</h4></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com"
                           title="enter your email.">
                  </div>
                  <br>
                  <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save
                  </button>
                  <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                </form>
              </section>
            </div><!-- Right Col End -->
          </div>
        </section>
      </section>

      <script
          src="https://code.jquery.com/jquery-3.4.0.min.js"
          integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
          crossorigin="anonymous">
      </script>

      <script>
        function btn(pageChange) {
          const activity = $("#activity");
          const aboutMe = $("#aboutMe");
          const editProfile = $("#editProfile");
          const btnActivity = $("#btnActivity");
          const btnAboutMe = $("#btnAboutMe");
          const btnEditProfile = $("#btnEditProfile");
          if (pageChange === 'activity') {
            activity.removeClass("hidden");
            aboutMe.addClass("hidden");
            editProfile.addClass("hidden");
            btnActivity.addClass("btn-primary");
            btnAboutMe.removeClass("btn-primary");
            btnEditProfile.removeClass("btn-primary");
          } else if (pageChange === "aboutMe") {
            activity.addClass("hidden");
            aboutMe.removeClass("hidden");
            editProfile.addClass("hidden");
            btnActivity.removeClass("btn-primary");
            btnAboutMe.addClass("btn-primary");
            btnEditProfile.removeClass("btn-primary");
          } else if (pageChange === "editProfile") {
            activity.addClass("hidden");
            aboutMe.addClass("hidden");
            editProfile.removeClass("hidden");
            btnActivity.removeClass("btn-primary");
            btnAboutMe.removeClass("btn-primary");
            btnEditProfile.addClass("btn-primary");
          } else {
            throw("Function btn: No match found");
          }
        }
      </script>

      <?php
    }
    include("./layouts/footer.php");
  }else{
    header('location: index.php?pageaccess=forbidden');
    exit;
  }
?>