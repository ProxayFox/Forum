<?php
//require_once("mydb/databaseManager/o-db.php");
session_start();
if (array_key_exists("user", $_SESSION)) {
  // Do Something
  include("./layouts/header.php");
//  require_once ("./mydb/thread/getAllThread.db.php");
  require_once './mydb/databaseManager/meekrodb.2.3.class.php';
  DB::$user = 'localhost';
  DB::$dbName = 'forum';
  DB::$user = 'root';
  DB::$password = '';



  echo date("Y-m-d H:i:s");
?>
  <h1 class="text-center">Threads</h1>
  <section class="container">
    <div class="row">
      <div class="col-sm-3 text-center">
        <div class="container">
          <h2>Creat Thread</h2>
          <!-- Button to Open the Modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Creat Thread
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
                  <form id="signUp" class="login-form hidden" action="./mydb/thread/creatThread.db.php" method="POST" role="form">
                  <div class="modal-body">

                      <h4 style="float: left;">Title of the Thread</h4>
                      <label for="title" class="sr-only">Enter: Title</label>
                      <input type="text" id="title" name="title" class="form-control" placeholder="Title" required autofocus>
                      <h4 style="float: left;">Information of the Thread</h4>
                      <label for="info" class="sr-only">Enter: Information</label>
                      <input type="text" id="info" name="info" class="form-control" placeholder="Information" required autofocus>
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Creat Thread</button>
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
        <!-- displays all the threads after searching the database-->
        <table class="table">
          <thead class="thead-dark">
          <th>TID</th>
          <th>CPID</th>
          <th>Title</th>
          <th>Information</th>
          <th>Time Stamp</th>
          </thead>
          <?php
            $results = DB::query("SELECT * FROM thread order by TID");
            foreach ($results as $row) {
              ?>
              <tbody>
              <tr>
                <td><?php echo $row['TID'];?></td>
                <td><?php echo $row['CPID'];?></td>
                <td><a href="posts.pro.php?TID=<?php echo $row['TID'];?>"><?php echo $row['title'];?></a></td>
                <td><?php echo $row['info'];?></td>
                <td><?php echo $row['created'];?></td>
              </tr>
              </tbody>
              <?php
            }
          ?>


        </table>
      </div>
    </div>
  </section>

<?php
  include("./layouts/footer.php");
  }else{
  header('location: index.php?pageaccess=forbidden');
  exit;
}
?>