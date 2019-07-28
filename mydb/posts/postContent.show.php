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
    // Date Calculator
    $date1 = $row['created'];
    $date2 = date("Y-m-d H:i:s");

    $start_date = new DateTime($date1);
    $since_start = $start_date->diff(new DateTime($date2));
    $years = $since_start->y . ' year/s ago<br>';
    $months = $since_start->m . ' month/s ago<br>';
    $days = $since_start->d . ' day/s ago<br>';
    $hour = $since_start->h . ' hour/s ago<br>';
    $min = $since_start->i . ' minute/s ago<br>';
    $sec = $since_start->s . ' second/s ago<br>';
    ?>
    <tbody>
    <tr>
      <td><?php echo $row['PID'];?></td>
      <td><?php echo $row['CDID'];?></td>
      <td><?php echo $row['TID'];?></td>
      <td><a href="post.pro.php?TID=<?php echo $row['TID'];?>&PID=<?php echo $row['PID'] ?>"><?php echo $row['title'];?></a></td>
      <td><?php echo $row['info'];?></td>
      <td><?php
        if ($years >= 1) {
          echo $years;
        } elseif ($months >= 1) {
          echo $months;
        } elseif ($days >= 1) {
          echo $days;
        } elseif ($hour >= 1) {
          echo $hour;
        } elseif ($min >= 1) {
          echo $min;
        } elseif ($sec >= 1) {
          echo $sec;
        } else {
          echo "Time Error";
        }
      ?></td>
      <td><?php echo $row['replies'];?></td>
      <td><?php echo $row['views'];?></td>
    </tr>
    </tbody>
    <?php
  }?>
</table>