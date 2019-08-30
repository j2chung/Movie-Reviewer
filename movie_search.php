<?php
  include_once('dbini.php');
  if (isset($_POST['movie_query'])) {
    $stmt = $db->prepare('SELECT Title, Rating, Year, MovieID FROM Movie WHERE TITLE LIKE CONCAT("%", ?, "%") ORDER BY Title');
    $stmt->bind_param('s', $_POST['movie_query']);
    $stmt->execute();
    $stmt->bind_result($title, $rating, $year, $movieid);
    $results = array();
    while($row = $stmt->fetch()){
      $results[] = array('Title'=>$title, 'Rating'=>$rating, 'Year'=>$year, 'MovieID'=>$movieid);
    }
    echo json_encode($results);
  }
 ?>
