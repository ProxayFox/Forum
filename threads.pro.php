<?php
session_start();
if (array_key_exists("user", $_SESSION)) {
  // get the database stuff and accounts
  require_once('./mydb/databaseManager/DBEnter.db.php');
  //get the header
  include("./layouts/header.php");
?>

  <!--  Jquery for thread form  -->
  <script>
    $(document).ready(function(){
      $("#threadUpdate").click(function() {
        $.post("./mydb/thread/createThread.db.php", {
          title: $("#title");
        info:$("#info");
      },
        function(data, status) {
          $("#displaySuccess").HTML(data)
        }
        )
      })
    }
  </script>

  <h1 class="text-center">Threads</h1>
  <section class="container">
    <div class="row">
      <div class="col-sm-3 text-center">
        <div class="container">
          <h2>Create Thread</h2>
          <!-- Button to Open the Modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Create Thread
          </button>

          <!-- where the jQuery data should go -->
          <div id="displaySuccess">

          </div>

          <!-- Thread form (hidden) -->
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
                  <div id="Thread" class="login-form hidden" role="form">
                  <div class="modal-body">
                      <h4 style="float: left;">Title of the Thread</h4>
                      <input type="text" id="title" class="form-control" placeholder="Title" required autofocus>
                      <h4 style="float: left;">Information of the Thread</h4>
                      <input type="text" id="info" class="form-control" placeholder="Information" required autofocus>
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button class="btn btn-primary" id="threadUpdate">Creat Thread</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                  </div>
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