<?php
  $stmt = $db->prepare('SELECT m.Title, AVG(r.Review),COUNT(r.Review) FROM Movie m, Reviews r WHERE m.MovieID = r.MovieID GROUP BY r.MovieID ORDER BY AVG(r.Review) DESC');
  $stmt->execute();
  $stmt->bind_result($movietitle, $avgreview, $reviewcount);
  while($stmt->fetch()) {
    $googlequery = preg_replace('/\s+/', '+', $movietitle);
    ?>
    <tr>
      <td>
        <a href="https://www.google.com/search?q=<?=$googlequery?>" target="_blank"><?=$movietitle?></a>
      </td>
      <td>
        <span class="star2">
        <?php
        for($i = 1; $i <= $avgreview; $i++) { ?>
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
   </td>
  <?php
  }
  $stmt->close();
?>
