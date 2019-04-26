<?php
require_once("mydb/o-db.php");
session_start();
if (array_key_exists("user", $_SESSION)) {
  // Do Something
  include("header.php");
  $result = myDB::getInstance()->getAllThreads();

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
                  <form id="signUp" class="login-form hidden" action="./mydb/creatThread.db.php
                  <?php
                    if ($result != FALSE) {
                      while ($row = $result->fetch_row()) {
                        header("Location: ./mydb/creatPost.db.php?TID=".$row[0]);
                      }
                    } else {
                      header("Location: posts.pro.php?post_TID_not_found");
                    }
                  ?>
                  " method="POST" role="form">
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
        if ($result != FALSE) {
          while ($row = $result->fetch_row()) {
            //echo '<p>'.$row[0].'</p><p>'.$row[1].'</p><p>'.$row[2].'</p><p>'.$row[3].'</p><p>'.$row[4].'</p>';
            ?>
                <tbody>
                  <tr>
                    <td><?php echo $row[0];?></td>
                    <td><?php echo $row[1];?></td>
                    <td><a href="posts.pro.php?TID=<?php echo $row[0];?>"><?php echo $row[2];?></a></td>
                    <td><?php echo $row[3];?></td>
                    <td><?php echo $row[4];?></td>
                  </tr>
                </tbody>
            <?php
          }
        } else {
          ?>
          <h3>No Current threads</h3>
          <?php
        }
        ?>

            <?php
//            if ($result != FALSE) {
//              while ($row = $result->fetch_row()) {
//                header("Location: threads.pro.php?TID=".$row[0]);
//              }
//            } else {
//              header("Location: threads.pro.php?post_TID_not_found");
//            }
//          ?>


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