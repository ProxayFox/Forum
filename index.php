<?php
include_once("header.php");
?>

<?php
  if (array_key_exists("user", $_SESSION)) {
    echo '1';
    echo $_SESSION['lid'];
    echo $_SESSION['cpid'];
  } else {
    echo '2';
  }
?>
<!--Body starts in header.php-->
      <section class="text-center">
        <?php
          if (array_key_exists("user", $_SESSION)) {
            ?>
              <section>
                <h1 style="text-align: center">Your Logged in</h1>
                <h3 style="text-align: center;">Welcome user: <?php echo $_SESSION['user'];?></h3>
          <?php
          } else {
            ?>
            <!-- NOT REGISTERED-->
            <section style="padding-left: 35%; padding-right: 35%;">
              <form id="signIn" class="login-form" action="mydb/login.db.php" method="POST" role="form">
                <img class="mb-4" src="img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png" alt="Logo">
                <h1>Welcome to the Form</h1>
                <h1 class="h3 mb-3 font-weight-normal">Please Sign In to get Started</h1>
                <?php
                  //Login Error handling
                  //Redirecting the user if they went on the wrong page
                  if (isset($_GET['pageAccess'])) {
                    if ($_GET['pageAccess'] == 'forbidden') {
                      echo '
                        <div class="alert alert-warning" role="alert" style="text-align: center;">
                          This page is forbidden
                        </div>
                      ';
                    }
                  }
                  //Informing the user of a Successful logout
                  if (isset($_GET['logout'])) {
                    if ($_GET['logout'] == 'success') {
                      echo '
                        <div class="alert alert-warning" role="alert" style="text-align: center;">
                          You are logged out of your account
                        </div>
                      ';
                    }
                  }
                  //Informing user of an unsuccessful login attempt
                  if (isset($_GET['login'])) {
                    if ($_GET['login'] == 'fail') {
                      echo '
                        <div class="alert alert-warning" role="alert" style="text-align: center;">
                          Failed to sign in, Username or Password is incorrect
                        </div>
                      ';
                    }
                  }
                //Telling the user that they where successful at signing up
                if (isset($_GET['signup'])) {
                  if ($_GET['signup'] == 'success') {
                    echo '
                        <div class="alert alert-warning" role="alert" style="text-align: center;">
                          You Have Successfully made an account <br> Time to Sign In
                        </div>
                      ';
                  }
                }
                ?>
                <label for="inputEmail" class="sr-only">Enter: Email address</label>
                <input type="text" id="uname" name="uname" class="form-control" placeholder="Username" required autofocus>
                <label for="inputPassword" class="sr-only">Enter: Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <button class="btn btn-primary btn-lg btn-block" type="submit" style="margin-top: 5px;">Sign In</button>
              </form>
              <!-- Register -->
              <form id="signUp" class="login-form" style="display: none;" action="mydb/o-register.db.php" method="POST" role="form">
                <img class="mb-4" src="img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png" alt="Logo">
                <h1>Welcome to the Form</h1>
                <h1 class="h3 mb-3 font-weight-normal">Please Create an account</h1>
                <?php
                //Login Error handling
                //Redirecting the user if they went on the wrong page
                if (isset($_GET['pageAccess'])) {
                  if ($_GET['pageAccess'] == 'forbidden') {
                    echo '
                                    <div class="alert alert-warning" role="alert" style="text-align: center;">
                                      This page is forbidden
                                    </div>
                                  ';
                  }
                }
                //Informing the user of a Successful logout
                if (isset($_GET['logout'])) {
                  if ($_GET['logout'] == 'success') {
                    echo '
                                    <div class="alert alert-warning" role="alert" style="text-align: center;">
                                      You are logged out of your account
                                    </div>
                                  ';
                  }
                }
                //Informing user of an unsuccessful login attempt
                if (isset($_GET['login'])) {
                  if ($_GET['login'] == 'fail') {
                    echo '
                                    <div class="alert alert-warning" role="alert" style="text-align: center;">
                                      Failed to sign in, Username or Password is incorrect
                                    </div>
                                  ';
                  }
                }
                ?>
                <label for="inputEmail" class="sr-only">Enter New: Username</label>
                <input type="text" id="uname" name="uname" class="form-control" placeholder="Username" required autofocus>
                <label for="inputEmail" class="sr-only">Enter New: Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
                <label for="inputPassword" class="sr-only">Enter New: Password</label>
                <input type="password" id="password" name="PWD" class="form-control" placeholder="Password" required>
                <button class="btn btn-primary btn-lg btn-block" type="submit" style="margin-top: 5px;">Sign In</button>
              </form>
              <button onclick="btn(2)" class="btn" style="margin-top: 5px;">Sign In</button>
              <button onclick="btn(1)" class="btn" style="margin-top: 5px;">Sign Up</button>
        <?php
          }
        ?>
    </section>
  </section>

  <script>
    function btn(a) {
      if (a==1) {
        document.getElementById("signIn").style.display = "none";
        document.getElementById("signUp").style.display="block";
      } else {
        document.getElementById("signIn").style.display = "block";
        document.getElementById("signUp").style.display="none";
      }
    }
  </script>

<!--Body Ends in footer.php-->
<?php
require_once("footer.php");
?>