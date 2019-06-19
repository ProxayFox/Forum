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