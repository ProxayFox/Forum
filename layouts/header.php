<!DOCTYPE html>
<html lang="en">
<head>
	<title>Forum Test</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- image on tab -->
  <link rel="icon" href="./img/logo.jpg">

  <!-- Bootstrap -->
  <link href="./css/bootstrap.css" rel="stylesheet" type="text/css">
  <!-- JQuery -->
  <link href="./js/jquery-3.3.1.js">
  <link href="./js/bootstrap.js">
  <script src="./js/popper.js"></script>

  <!-- commands using jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <!-- CSS -->
  <link href="css/signin.css" rel="stylesheet" type="text/css">


</head>
<body>
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