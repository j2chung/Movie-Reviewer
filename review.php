<?php
include 'dbini.php';
unset($check);
$stmt = $db->prepare('SELECT UserID FROM Users WHERE Username = ?');
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$stmt->bind_result($userid);
$stmt->fetch();
$stmt->close();
if (isset($_POST['moviereviewed'])) {
    //Check if review exists
    $stmt = $db->prepare('SELECT Review FROM Reviews WHERE UserID = ? AND MovieID = ?');
    $stmt->bind_param('ii', $userid, $_POST['moviereviewed']);
    $stmt->execute();
    $stmt->bind_result($check);
    $stmt->fetch();
    $stmt->close();
    //If review does not exist insert
    if(empty($check)) {
      $stmt = $db->prepare('INSERT INTO Reviews (MovieID, UserID, Review) VALUES (?, ?, ?)');
      $stmt->bind_param('iii', $_POST['moviereviewed'], $userid, $_POST['rating']);
      $stmt->execute();
    } else {
      $stmt = $db->prepare('UPDATE Reviews SET Review = ? WHERE UserID = ? AND MovieID = ?');
      $stmt->bind_param('iii', $_POST['rating'], $userid, $_POST['moviereviewed']);
      $stmt->execute();
    }
  }
?>
