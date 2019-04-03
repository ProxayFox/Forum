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
                <h1 style="text-align: center">Your Loggedin</h1>
                <h3 style="text-align: center;">Welcome user: <?php echo $_SESSION['user'];?></h3>
          <?php
          } else {
            ?>
      <section style="padding-left: 35%; padding-right: 35%;">
              <form class="form-signin" action="mydb/login.db.php" method="POST" role="form">
                <img class="mb-4" src="img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png" alt="Logo">
                <h1>Welcome to the Form</h1>
                <h1 class="h3 mb-3 font-weight-normal">Please sign in to get started</h1>
            <?php
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
            ?>
                <label for="inputEmail" class="sr-only">Enter: Email address</label>
                <input type="text" id="uname" name="uname" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only">Enter: Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit" style="width: 100px">Sign in</button>
              </form>
            <?php
          }
        ?>
      </section>

<!--Body Ends in footer.php-->
<?php
require_once("footer.php");
?>