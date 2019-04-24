<?php
require_once("mydb/o-db.php");
session_start();
if (array_key_exists("user", $_SESSION)) {
  // Do Something
  include("header.php");
  $result = myDB::getInstance()->getAllPosts(
    $TID = $_GET['TID']
  );
  echo date("Y-m-d H:i:s");
  echo '<br>';
  echo $_GET['TID'];
  ?>
  <h1 class="text-center">Posts</h1>
  <section class="container">
    <div class="row">
      <div class="col-sm-3 text-center">
        <div class="container">
          <h2>Creat Post</h2>
          <!-- Button to Open the Modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Creat Post
          </button>
          <!-- The Modal -->
          <div class="modal" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Modal Heading</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div>
                  <form id="signUp" class="login-form hidden" action="mydb/creatPost.db.php" method="POST" role="form">
                    <div class="modal-body">

                      <h4 style="float: left;">Title of the Post</h4>
                      <label for="title" class="sr-only">Enter: Title</label>
                      <input type="text" id="title" name="title" class="form-control" placeholder="Title" required autofocus>
                      <h4 style="float: left;">Information of the Post</h4>
                      <label for="info" class="sr-only">Enter: Information</label>
                      <input type="text" id="info" name="info" class="form-control" placeholder="Information" required autofocus>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button class="btn btn-primary" type="submit">Creat Post</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-9 text-center">
        <!-- displays all the Posts after searching the database-->
        <table class="table">
          <thead class="thead-dark">
          <th>PID</th>
          <th>CPID</th>
          <th>TID</th>
          <th>Title</th>
          <th>Information</th>
          <th>Time Stamp</th>
          <th>Replies</th>
          <th>views</th>
          </thead>
          <?php
          if ($result != FALSE) {
            while ($row = $result->fetch_row()) {
              //echo '<p>'.$row[0].'</p><p>'.$row[1].'</p><p>'.$row[2].'</p><p>'.$row[3].'</p><p>'.$row[4].'</p>';
              ?>
              <tbody>
              <tr>
                <td><?php echo $row[0];?></td>
                <td><?php echo $row[1];?></td>
                <td><a href="post.pro.php"><?php echo $row[2];?></a></td>
                <td><?php echo $row[3];?></td>
                <td><?php echo $row[4];?></td>
                <td><?php echo $row[5];?></td>
                <td><?php echo $row[6];?></td>
                <td><?php echo $row[7];?></td>
              </tr>
              </tbody>
              <?php
            }
          } else {
            ?>
            <h3>No Current Posts</h3>
            <?php
          }
          ?>
        </table>
      </div>
    </div>
  </section>

  <script>

  </script>

  <?php
  include("footer.php");
}else{
  header('location: index.php?pageaccess=forbidden');
  exit;
}
?>