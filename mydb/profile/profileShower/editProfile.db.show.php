<?php
session_start();
require_once('../../databaseManager/DBEnter.db.php');
$resultInfo = DB::queryFirstRow("SELECT * FROM clientData WHERE CDID = ".$_SESSION['cdid']);
?>

<script>
  $(document).ready(function () {

  });
</script>

<!-- Edit the User Profile-->
<section id="editProfile" xmlns="http://www.w3.org/1999/html">
  <form class="form" id="registrationForm">
    <div class="row">
      <div class="col-md-6">
        <label for="first_name"><h4>First name</h4></label>
        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name"
               title="enter your first name if any.">
      </div>
      <div class="col-md-6">
        <label for="last_name"><h4>Last name</h4></label>
        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name"
               title="enter your last name if any.">
      </div>
    </div>
    <div class="w-100">
      <label for="email"><h4>Email</h4></label>
      <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com"
             title="enter your email.">
    </div>
    <br>
    <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Save</button>
    <button class="btn btn-lg btn-outline-danger" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
  </form>
  <br>
  <form>
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="customFile">
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
    <br>
    <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Save</button>
    <button class="btn btn-lg btn-outline-danger" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
  </form>
</section>
