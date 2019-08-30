<!--
* todo:
* fix the damn counter for movie_search.js
* add event log for fun if you have time
-->

<?php
  $user = 'root';
  $pass = '';
  $db = 'movie_reviewer';
  $db = new mysqli('localhost', $user, $pass, $db) or die("connection fail");
  session_start();
?>

<!DOCTYPE html>
<html lang="en" id="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="movie_review.css">
  <title>Movie Review</title>
</head>

<body>
  <!-- If logged in -->
  <?php if (isset($_SESSION['logged_in'])) :?>
  <?php include 'logged_in.php'; ?>
  <div class="title">
    <h1>Movie Reviewer</h1>
    <h3><?=$_SESSION['logged_in']?></h3>
    <!--Button for logging out-->
    <form class="logout" action="#" method="post">
      <a class="home" href=".">Home</a> |
      <button id="log_out" name="log_out" type="submit">Log Out</button>
    </form>
  </div>

  <!--Form for searching movies-->
  <form action="movie_search.php" id="getMovies" name="getmovies" method="post">
    Movie Search: <input type="text" id="movie_query" name="movie_query">
  </form>

  <!--Table for the searched Movies-->
  <table class="hiding" id="movie_searched" name="movie_searched" style="width: 85%">
    <h3 id="movie_count"></h3>
    <tr id = "header">
      <th>Title</th>
      <th>Rating</th>
      <th>Year</th>
      <th>Review</th>
    </tr>
  </table>

  <!--Table for user reviewed movies-->
  <table id = "review_list" style="width:85%">
    <tr>
        <th>Movie</th>
        <th>Your Review</th>
        <th>Average Review</th>
    </tr>
    <?php include 'review_log.php'; ?>
  </table>

  <!--If not logged in-->
  <?php else:
    include 'login.php';
  ?>

  <div class="title">
    <h1>Movie Reviewer</h1>
  <!--Form for logging in or creating an account-->
    <form class="login" id="log_in" method="post">
      <a class="home" href=".">Home</a> |
      <span style="font-weight: 900; color: rgb(71, 74, 79); font-size: large">Log in:<span>
      <input type="text" id="login_username" name="login_username" placeholder="Username" value="">
      <input type="password" id="login_password" name="login_password" placeholder="Password" value="">
      <button class="log_in" type="submit" id="login_submit" name="login_submit" value="">Log in</button>
      <button type="submit" id="create_account" name="create_account" value="">Register a new user</button>
    </form>
  </div>
  <br><br>

  <table id = "reviewed_list" style="width:85%">
    <tr>
        <th>Movie</th>
        <th>Average Review</th>
        <?php include 'movie_reviewed.php'; ?>
    </tr>
  </table>

  <?php if(isset($_POST['create_account'])) :
      header('Location: account_creation.php');
      endif;
    endif;
  ?>

  <script src="jquery-3.4.1.min.js" charset="utf-8"></script>
  <script src="movie_search.js" charset="utf-8"></script>
  <script src="review.js" charset="utf-8"></script>
</body>
</html>
