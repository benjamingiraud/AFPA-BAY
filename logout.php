<?php
session_destroy();
if (headers_sent()) {
  die("Error: headers already sent!");
}
else {
  header("Location: index.php?afpabay", true);
  exit();
}
?>
