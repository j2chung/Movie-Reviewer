



<?php
if (isset($_POST['log_out'])) {
  $stmt=$db->prepare("INSERT INTO AuthLogEntry (UserID, IP, EventType) VALUES ((SELECT UserID FROM Users WHERE Username = ?), INET6_ATON(?), 'logout')");
  $stmt->bind_param('ss', $_SESSION['username'], $_SERVER['REMOTE_ADDR']);
  $stmt->execute();
  $stmt->close();
  unset($_SESSION['logged_in']);
  unset($_SESSION['username']);
  session_destroy();
  session_start();
  header("Refresh:0");
}
?>
