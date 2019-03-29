<?php
session_start();
if (array_key_exists("user", $_SESSION)) {
  include("header.php");
} else {
  include("header.php");
}
?>
<!--Body starts in header.php-->

      <section class="text-center" style="padding-left: 35%; padding-right: 35%; padding-top: 50px;">
        <form class="form-signin" action="mydb/login.db.php" method="POST" role="form">
          <img class="mb-4" src="img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png" alt="Logo">
          <h1>Welcome to the Form</h1>
          <h1 class="h3 mb-3 font-weight-normal">Please sign in to get started</h1>
          <?php
            if (isset($_GET['pageaccess'])) {
              if ($_GET['login'] == 'fail') {
                echo '
                <div class="alert alert-warning" role="alert" style="text-align: center;">
                  This page is forbidden
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
        <form class="form-inline my-2 my-lg-0" action="mydb/logout.db.php" method="POST" role="form" data-toggle="validator">
          <h3 style="padding-right: 20px;"><?php echo $_SESSION['user'];?></h3>
          <button class="btn btn-primary my-2 my-sm-0" type="submit">Logout</button>
        </form>
      </section>

<!--Body Ends in footer.php-->
<?php
require_once("footer.php");
?>