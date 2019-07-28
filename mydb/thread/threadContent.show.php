<?php
  require_once('../databaseManager/DBEnter.db.php');
?>

<!-- displays all the threads after searching the database-->
<table class="table">
  <thead class="thead-dark">
  <th>Title</th>
  <th>Information</th>
  <th>Time Stamp</th>
  </thead>
  <?php
  $results = DB::query("SELECT * FROM thread order by TID");
  foreach ($results as $row) {

    // Date Calculator
    $date1 = $row['created'];;
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
      <td><a href="posts.pro.php?TID=<?php echo $row['TID'];?>"><?php echo $row['title'];?></a></td>
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
        } elseif ($sec >= 0) {
          echo $sec;
        } else {
          echo "Time Error";
        }
      ?></td>
    </tr>
    </tbody>
    <?php
  }
  ?>
</table>