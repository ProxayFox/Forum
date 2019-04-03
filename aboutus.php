<?php
session_start();
if (array_key_exists("user", $_SESSION)) {
  include("header.php");
} else {
  include("header.php");
}
?>


<!--Body Ends in footer.php-->
<?php
require_once("footer.php");
?>
