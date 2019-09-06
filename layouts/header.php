<!DOCTYPE html>
<html lang="en">
<head>
	<title>Forum Test</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- image on tab -->
  <link rel="icon" href="./img/Flat%20Gradient%20Social%20Media%20Icons/80/500px%20icon.png">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="./js/popper.js"></script>
  <script src="./js/tooltip.js"></script>


</head>
<body style="background-color: #c6d4ff">
<?php
if (array_key_exists("user", $_SESSION)) {
  ?>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light text-center" style="background-color: #26A7BC">
        <a href="index.php"><img src="img/Flat%20Gradient%20Social%20Media%20Icons/64/500px%20icon.png" alt="logo to home page" style="width: 50px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="aboutus.php">About us</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0" action="./mydb/login/logout.db.php" method="POST" role="form" data-toggle="validator">
            <h3 style="padding-right: 20px;"><?php echo $_SESSION['user'];?></h3>
            <button class="btn btn-primary my-2 my-sm-0" type="submit">Logout</button>
          </form>
        </div>
      </nav>
    </header>
<?php
} else {
  ?>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light text-center" style="background-color: #26A7BC">
        <a href="index.php"><img src="img/Flat%20Gradient%20Social%20Media%20Icons/64/500px%20icon.png" alt="logo to home page" style="width: 50px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="aboutus.php">About us</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
  <?php
}
?>