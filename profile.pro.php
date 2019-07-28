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

      <!-- style to hide section of the page -->
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
                echo "./img/profileIMG/" . $uimg;
              } else {
                echo "./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png";
              } ?>" style="width: 100px; height: 100px;" title="profile image"
                   class="img-circle img-responsive rounded">
            </div>
          </div>

          <!-- Profile Left and Right-->
          <div class="row">

            <!--left col start-->
            <div class="col-sm-3" style="background-color: darkgray;">
              <br>

              <!-- user profile img -->
              <div class="text-center" style=" padding: 5px;">
                <img src="<?php if (!empty($uimg)) {
                  echo "./img/profileIMG/" . $uimg;
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
              <div class="row">
                <button onclick="btn('activity')" id="btnActivity" class="btn btn-primary" style="margin-top: 5px; margin-left: 5px; width: 100px;">Activity</button>
                <button onclick="btn('aboutMe')" id="btnAboutMe" class="btn" style="margin-top: 5px; width: 100px;">About Me</button>
                <button onclick="btn('editProfile')" id="btnEditProfile" class="btn" style="margin-top: 5px; width: 100px;">Edit Profile</button>
              </div>

              <!-- The Three different sections of the profile -->
              <!-- Activity -->
              <section id="activity" class="">
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
                              <img src="<?php if (!empty($uimg)) {
                                echo "./img/profileIMG/" . $uimg;
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