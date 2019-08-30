<?php
$stmt = $db->prepare('SELECT UserID FROM Users WHERE ? = Username');
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$stmt->bind_result($userid);
$stmt->fetch();
$stmt->close();
$stmt = $db->prepare('SELECT movie_id, movie_title, movie_average, movie_count, movie_review
                      FROM (SELECT m.MovieID AS movie_id, m.Title AS movie_title, AVG(r.Review) AS movie_average, COUNT(r.Review) AS movie_count
                      FROM Movie m, Reviews r WHERE m.MovieID = r.MovieID
                      GROUP BY r.MovieID) AS A
                      LEFT JOIN (SELECT Reviews.Review AS movie_review, Reviews.MovieID
                      FROM Reviews WHERE UserID = ?) AS B
                      ON A.movie_id = B.MovieID
                      ORDER BY movie_average DESC;');
$stmt->bind_param('i', $userid);
$stmt->execute();
$stmt->bind_result($listmovieid, $movietitle, $avgreview, $reviewcount, $yourreview);
while($stmt->fetch()) {
  $googlequery = preg_replace('/\s+/', '+', $movietitle);
  ?>
  <tr>
    <td>
      <a href="https://www.google.com/search?q=<?=$googlequery?>" target="_blank"><?=$movietitle?></a>
    </td>
    <td>
      <?php
        for($i = 1; $i <= $yourreview; $i++) { ?>
          <span class="star2 star3" onclick="review(<?=$listmovieid?>, <?=$i?>)">★</span>
          <?php
        }
        for ($i = $yourreview + 1; $i < 6; $i++) { ?>
          <span class="star2 star3" onclick="review(<?=$listmovieid?>, <?=$i?>)">☆</span>
          <?php
        }
      ?>
    </td>
    <td>
      <span class="star2">
      <?php
        for($i = 0; $i < $avgreview; $i++) { ?>
          ★
          <?php
        }
      ?>
      </span>
      <?php
      if ($reviewcount > 1) : ?>
        (<?=$reviewcount?> reviews)
      <?php else : ?>
        (<?=$reviewcount?> review)
      <?php
      endif;
      ?>
    </td>
  </tr>
<?php
}
$stmt->close();
?>
