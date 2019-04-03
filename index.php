<?php
session_start();
include_once("header.php");
?>


<!--Body starts in header.php-->
<?php
echo $_SESSION["user"]
?>
      <section class="text-center" style="padding-left: 35%; padding-right: 35%; padding-top: 50px;">
        <?php
          if (array_key_exists("user", $_SESSION)) {
            echo '
                <form class="form-inline my-2 my-lg-0" action="mydb/logout.db.php" method="POST" role="form" data-toggle="validator">
                <h3 style="padding-right: 20px;">'; echo $_SESSION["user"];echo '</h3>
                </form>
            ';

          } else {
            echo '
              <form class="form-signin" action="mydb/login.db.php" method="POST" role="form">
                <img class="mb-4" src="img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png" alt="Logo">
                <h1>Welcome to the Form</h1>
                <h1 class="h3 mb-3 font-weight-normal">Please sign in to get started</h1>
                ';

            if (isset($_GET['pageAccess'])) {
              if ($_GET['pageAccess'] == 'forbidden') {
                echo '
              <div class="alert alert-warning" role="alert" style="text-align: center;">
                This page is forbidden
              </div>';
              }
            }
            if (isset($_GET['logout'])) {
              if ($_GET['logout'] == 'success') {
                echo '
              <div class="alert alert-warning" role="alert" style="text-align: center;">
                You are logged out of your account
              </div>';
              }
            }
            if (isset($_GET['login'])) {
              if ($_GET['login'] == 'fail') {
                echo '
              <div class="alert alert-warning" role="alert" style="text-align: center;">
                Failed to sign in, Username or Password is incorrect
              </div>';
              }
            }

            echo '
                <label for="inputEmail" class="sr-only">Enter: Email address</label>
                <input type="text" id="uname" name="uname" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only">Enter: Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit" style="width: 100px">Sign in</button>
              </form>
            ';
          }
        ?>
      </section>

<!--Body Ends in footer.php-->
<?php
require_once("footer.php");
?>