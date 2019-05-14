<?php
session_start();
if (array_key_exists("user", $_SESSION) & isset($_GET['TID'])) {
//  require_once("./mydb/databaseManager/o-db.php");
  require_once("./mydb/databaseManager/meekrodb.2.3.class.php");
  DB::$user = 'localhost';
  DB::$dbName = 'forum';
  DB::$user = 'root';
  DB::$password = '';

  // including the head of the HTML and data
  include("./layouts/header.php");
  echo date("Y-m-d H:i:s");
  echo '<br>';
  $TID = $_GET['TID'];
  echo $TID;
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
                  <form id="postForm" class="login-form hidden" action="./mydb/posts/creatPost.db.php" method="POST" role="form">
                    <div class="modal-body">
                      <!--  hidden input for TID -->
                      <input type="hidden" id="TID" name="TID" value="<?php echo $TID;?>">
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
            $results = DB::query("SELECT * FROM post order by PID");
            foreach ($results as $row) {
              ?>
              <tbody>
              <tr>
                <td><?php echo $row['PID'];?></td>
                <td><?php echo $row['CPID'];?></td>
                <td><?php echo $row['TID'];?></td>
                <td><a href="post.pro.php"><?php echo $row['title'];?></a></td>
                <td><?php echo $row['info'];?></td>
                <td><?php echo $row['created'];?></td>
                <td><?php echo $row['created'];?></td>
                <td><?php echo $row['views'];?></td>
              </tr>
              </tbody>
              <?php
            }?>
        </table>
      </div>
    </div>
  </section>

  <script>

  </script>

  <?php
  include("./layouts/footer.php");
}else{
  header('location: index.php?pageaccess=forbidden');
  exit;
}
?>