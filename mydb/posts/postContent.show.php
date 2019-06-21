<?php
require_once('../databaseManager/DBEnter.db.php');
?>

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
  $TID = $_GET['TID'];
  $results = DB::query("SELECT * FROM post WHERE TID = ".$TID);
  foreach ($results as $row) {
    ?>
    <tbody>
    <tr>
      <td><?php echo $row['PID'];?></td>
      <td><?php echo $row['CDID'];?></td>
      <td><?php echo $row['TID'];?></td>
      <td><a href="post.pro.php?TID=<?php echo $row['TID'];?>&PID=<?php echo $row['PID'] ?>"><?php echo $row['title'];?></a></td>
      <td><?php echo $row['info'];?></td>
      <td><?php echo $row['created'];?></td>
      <td><?php echo $row['created'];?></td>
      <td><?php echo $row['views'];?></td>
    </tr>
    </tbody>
    <?php
  }?>
</table>