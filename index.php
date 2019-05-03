<?php
session_start();
include_once("./layouts/header.php");
?>

<?php
  if (array_key_exists("user", $_SESSION)) {
    echo '1';
    echo '   ';
    echo $_SESSION['lid'];
    echo '   ';
    echo $_SESSION['cpid'];
  } else {
    echo 'no user';
  }
?>
<!--Body starts in header.php-->
<style>
  .hidden {
    display: none !important;
  }
</style>
      <section class="text-center">
        <?php
          if (array_key_exists("user", $_SESSION)) {
            ?>
              <section>
                <h1 style="text-align: center">Your Logged in</h1>
                <h3 style="text-align: center;">Welcome <?php echo $_SESSION['user'];?></h3>
                <br>
                <h2>lets go to your profile</h2>
                <a class="btn btn-primary" href="profile.pro.php" style="width: 100px;">Profile</a>
                <h3>lets check out the Threads</h3>
                <a class="btn btn-primary" href="threads.pro.php" style="width: 100px;">Threads</a>
          <?php
          } else {
            ?>
            <!-- NOT REGISTERED-->
            <section style="padding-left: 35%; padding-right: 35%;">
              <form id="signIn" class="login-form" action="mydb/login/login.db.php" method="POST" role="form">
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
              <form id="signUp" class="login-form hidden" action="mydb/o-register.db.php" method="POST" role="form">
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
                <button class="btn btn-primary btn-lg btn-block" type="submit" style="margin-top: 5px;">Sign Up</button>
              </form>
              <button onclick="btn('signIn')" id="btnSignIn" class="btn text-center hidden" style="margin-top: 5px; text-align: center;">Sign In</button>
              <button onclick="btn('signUp')" id="btnSignUp" class="btn text-center" style="margin-top: 5px; text-align: center;">Sign Up</button>
        <?php
          }
        ?>
    </section>
  </section>
  <script
      src="https://code.jquery.com/jquery-3.4.0.min.js"
      integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
      crossorigin="anonymous">
  </script>

  <script>
    function btn(formChange) {
      const signIn = $("#signIn");
      const signUp = $("#signUp");
      const btnSignIn = $("#btnSignIn");
      const btnSignUp = $("#btnSignUp");

      if (formChange === 'signIn') {
        signIn.removeClass("hidden");
        btnSignUp.removeClass("hidden");
        signUp.addClass("hidden");
        btnSignIn.addClass("hidden");
      } else if(formChange === "signUp") {
        signIn.addClass("hidden");
        btnSignUp.addClass("hidden");
        signUp.removeClass("hidden");
        btnSignIn.removeClass("hidden");
      } else {
        throw("Function btn: No match found");
      }
    }
  </script>

<!--Body Ends in footer.php-->
<?php
require_once("./layouts/footer.php");
?>