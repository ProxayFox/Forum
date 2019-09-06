<?php
session_start();
?>
<!-- Edit the User Profile-->
<section id="editProfile">
  <form class="form" action="../profileWorker/updateProfile.db.worker.php" method="post" id="registrationForm">
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
    <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save
    </button>
    <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
  </form>
</section>
