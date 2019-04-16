<?php
  require_once("mydb/o-db.php");
  session_start();
  if (array_key_exists("user", $_SESSION)) {
    // Do Something
    include("header.php");
?>
    <!--  Main Section of the page -->
    <section style="background-color: #c6d4ff">

      <!--  Profile Section of the page -->
      <section class="container" style="">

        <!-- Header for profile section -->
        <div class="row">
          <div class="col-sm-10" style="padding: 5px;">
            <h1>User name</h1>
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
              <button onclick="btn(0)" class="btn btn-primary" style="margin-top: 5px; width: 100px;">Activity</button>
              <button onclick="btn(2)" class="btn" style="margin-top: 5px; width: 100px;">About Me</button>
              <button onclick="btn(1)" class="btn" style="margin-top: 5px; width: 100px;">Edit Profile</button>
            </div>

            <!-- Activity -->
            <section id="activity">

            </section>

            <!-- About Me -->
            <section id="aboutMe">

            </section>
            <!-- Edit the User Profile-->
            <section id="editProfile">

            </section>



          </div><!-- Right Col End -->
        </div>
      </section>
    </section>

    <?php
    include("footer.php");
  }else{
    header('location: index.php?pageaccess=forbidden');
    exit;
  }
?>