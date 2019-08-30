<?php
  if (isset($_POST['login_submit'])) {
      $username = $_POST['login_username'];
      $password = $_POST['login_password'];
      $stmt = $db->prepare('SELECT UserID, Password FROM Users WHERE Username = ?');
      $stmt->bind_param('s', $username);
      $stmt->execute();
      $stmt->bind_result($userid, $pass);
      $stmt->fetch();
      $stmt->close();
      if (password_verify($password, $pass)) {
          $stmt=$db->prepare("INSERT INTO AuthLogEntry (UserID, IP, EventType) VALUES (?, INET6_ATON(?), 'login')");
          $stmt->bind_param('ss', $userid, $_SERVER['REMOTE_ADDR']);
          $stmt->execute();
          $_SESSION['username'] = $username;
          $_SESSION['logged_in'] = "Welcome, ".$_SESSION['username'];
          header('Location: index.php');
      } else {
          echo "<h3>Invalid username/password. Please try again.</h3>";
      }
  }
 ?>
