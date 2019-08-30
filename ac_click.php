<?php
$username = "";
$password_1 = "";
$password_2 = "";
if (isset($_POST['ac_submit'])) {
    $username = $_POST['ac_username'];
    $password_1 = $_POST['ac_password'];
    $password_2 = $_POST['ac_passrepeat'];
    if (strlen($password_1) < 13) {
       echo "<h3> Password must be at least 12 characters long. </h3>"; }
    else if (strlen($username) < 1 || strlen($username) > 64) {
      echo "<h3> Username must be between 1 and 64 characters </h3>"; }
    else if ($password_1 != $password_2) {
      echo "<h3>Passwords did not match.</h3>";}
    else {
      $passwordhash = password_hash($_POST['ac_password'], PASSWORD_DEFAULT, ['cost' => 12]);
      $stmt = $db->prepare("SELECT Username FROM Users WHERE Username = ?");
      $stmt->bind_param('s', $username);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows == 0) {
        $stmt = $db->prepare("INSERT INTO Users (Username, Password) VALUES (?, ?)");
        $stmt->bind_param('ss', $username, $passwordhash);
        $stmt->execute();
        $stmt = $db->prepare("INSERT INTO AuthLogEntry (UserID, IP, EventType) VALUES ((SELECT UserID FROM Users WHERE Username = ?), INET6_ATON(?), 'create')");
        $stmt->bind_param('ss', $username, $_SERVER['REMOTE_ADDR']);
        $stmt->execute();
        echo "<h2>Account created</h2>";
      } else {
        echo "<h2>Username already exists</h2>";
      }
    }
}
?>
