<?php
  require_once("mydb/o-db.php");
  session_start();
  if (array_key_exists("user", $_SESSION)) {
    // Do Something
    include("header.php");
?>
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
              <img title="profile image" class="img-circle img-responsive rounded" src="./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png">
          </div>
        </div>
        <!-- Profile Left and Right-->
        <div class="row">
          <div class="col-sm-3" style="background-color: darkgray;"><!--left col start-->
            <br>

            <div class="text-center" style=" padding: 5px;">
              <img src="./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png" style="width: 200px; height: 200px;   " class="avatar rounded-circle img-thumbnail" alt="avatar">
              <h6>Upload a different photo...</h6>
              <input type="file" class="text-center center-block file-upload">
            </div><br>

            <table class="table">
              <thead class="thead-dark">
              <th scope="col">Websites</th>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <a target="_blank" href="http://proxwebdev.com">proxwebdev.com</a>
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
                <td>125</td>
              </tr>
              <tr>
                <td><strong>Reputation</strong></td>
                <td></td>
                <td>13</td>
              </tr>
              <tr>
                <td><strong>Posts</strong></td>
                <td></td>
                <td>37</td>
              </tr>
              <tr>
                <td><strong>Followers</strong></td>
                <td></td>
                <td>78</td>
              </tr>
              </tbody>
            </table>

              <table class="table">
                <thead class="thead-dark">
                  <th scope="col">Social Media</th>
                </thead>
                <tbody>
                <tr>
                  <td><a target="_blank" href="http://proxwebdev.com">ProxWebDev</a></td>
                </tr>
                </tbody>
              </table>
            </div><!-- Left Col End-->
            <br>

        <!-- Right Col Start -->
          <div class="col-sm-9" style="background-color: lightgray;">
            <!-- Button Selection for Activity About Me and Edit profile-->
            <div class="row">
              <button onclick="btn('activity')" id="btnActivity" class="btn btn-primary" style="margin-top: 5px; width: 100px;">Activity</button>
              <button onclick="btn('aboutMe')" id="btnAboutMe" class="btn" style="margin-top: 5px; width: 100px;">About Me</button>
              <button onclick="btn('editProfile')" id="btnEditProfile" class="btn" style="margin-top: 5px; width: 100px;">Edit Profile</button>
            </div>
            <!-- The Three different sections of the profile -->
            <!-- Activity -->
            <section id="activity" class="">
                <h1>activity</h1>
            </section>

            <!-- About Me -->
            <section id="aboutMe" class="hidden">
                <h1>aboutMe</h1>
            </section>
            <!-- Edit the User Profile-->
            <section id="editProfile" class="hidden">
              <form class="form" action="mydb/updateProfile.db.php" method="post" id="registrationForm">
                <div class="row">
                  <div class="col">
                    <label for="first_name"><h4>First name</h4></label>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">
                  </div>
                  <div class="col">
                    <label for="last_name"><h4>Last name</h4></label>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">
                  </div>
                </div>
                <div class="col">
                  <label for="email"><h4>Email</h4></label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                </div>
                <br>
                <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
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
          const activity =        $("#activity");
          const aboutMe =         $("#aboutMe");
          const editProfile =     $("#editProfile");
          const btnActivity =     $("#btnActivity");
          const btnAboutMe =      $("#btnAboutMe");
          const btnEditProfile =  $("#btnEditProfile");
            if (pageChange === 'activity') {
              activity.removeClass("hidden");
              aboutMe.addClass("hidden");
              editProfile.addClass("hidden");
              btnActivity.addClass("btn-primary");
              btnAboutMe.removeClass("btn-primary");
              btnEditProfile.removeClass("btn-primary");
            } else if(pageChange === "aboutMe") {
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
    include("footer.php");
  }else{
    header('location: index.php?pageaccess=forbidden');
    exit;
  }
?>