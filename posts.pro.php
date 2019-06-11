<?php
session_start();
if (array_key_exists("user", $_SESSION) & isset($_GET['TID'])) {
  require_once('./mydb/databaseManager/DBEnter.db.php');

  // including the head of the HTML and data
  include("./layouts/header.php");
  $TID = $_GET['TID'];
  ?>

  <!--  Jquery for thread form  -->
  <script>
    $(document).ready(function() {
      $("#postUpdate").click(function () {
        $('#spinner').addClass('spinner-border spinner-border-sm');
        $.post("./mydb/posts/creatPost.db.php", {
              TID: $("#TID").val(),
              title: $("#title").val(),
              info: $("#info").val()
            },

            function (data, status) {
              $('#spinner').removeClass('spinner-border spinner-border-sm');
              $("#displaySuccess").html(data);
              if (status === "success") {
                $('#myModal').modal('toggle');
                $('#postTable').load("./mydb/posts/postContent.db.php");
                console.log('hidden and reloaded');
              }
              console.log(data, status);
            }
        )
      });
    });
  </script>

  <h1 class="text-center">Posts</h1>
  <section class="container">
    <div class="row">
      <div class="col-sm-3 text-center">
        <div class="container">
          <h2>Creat Post</h2>
          <!-- Button to Open the Modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Creat Post</button>

          <!-- where the jQuery data should go -->
          <div id="displaySuccess">
            <p>submit message</p>
          </div>

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
                  <div id="postForm" class="login-form hidden" role="form">
                    <div class="modal-body">
                      <!--  hidden input for TID -->
                      <input type="hidden" id="TID" name="TID" value="<?php echo $TID;?>">
                      <h4 style="float: left;">Title of the Post</h4>
                      <input type="text" id="title" name="title" class="form-control" placeholder="Title" required autofocus>
                      <h4 style="float: left;">Information of the Post</h4>
                      <input type="text" id="info" name="info" class="form-control" placeholder="Information" required autofocus>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button class="btn btn-primary" style="!important; width: 10em;" id="postUpdate">Create Post <span style="height:15px; width:15px; margin-right: 10px;" id="spinner"></span></button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-9 text-center" id="postTable">
        <?php
          require_once("./mydb/posts/postContent.show.php");
        ?>
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