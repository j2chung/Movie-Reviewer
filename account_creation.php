<?php
include_once('dbini.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="movie_review.css">
  <title>Account Creation Page</title>
</head>
<body>
  <div class="title">
    <h1>Movie Reviewer</h1>
    <?php
    include 'login_click.php';
    include 'ac_click.php';
    ?>
    <!-- Login Form -->
    <form class="login" action="#" method="post">
      <a class="home" href=".">Home</a> |
      <span style="font-weight: 900; color: rgb(71, 74, 79); font-size: large">Log in:<span>
      <input type="text" id="aclogin_username" name="aclogin_username" placeholder="Username" value="">
      <input type="password" id="aclogin_password" name="aclogin_password" placeholder="Password" value="">
      <button class="log_in" type="submit" id="aclogin_submit" name="aclogin_submit" value="">Log in</button>
    </form>
    <br>
  </div>
  <div class="heading">
    <h2>Register a new user</h2>
  </div>
  <br>




  <div class="">
    <span class="other">Username (64 character maximum):</span>
    <br>
    <!-- Account Creation Form -->
    <form class="" action="#" method="post">
      <input style="width: 300px;" type="text" id="ac_username" name="ac_username" placeholder="Username">
      <br>
      <span class="other">Password (12 character minimum):</span>
      <br>
      <input style="width: 300px;" type="password" id="ac_password" name="ac_password" placeholder="Password">
      <br>
      <span class="other">Password (again):</span>
      <br>
      <input style="width: 300px;" type="password" id="ac_passrepeat" name="ac_passrepeat" placeholder="Repeat password">
      <br>
      <button class="acc_create" type="submit" id="ac_submit" name="ac_submit" value="">Register</button>
    </form>



  </div>

  <script src="jquery-3.4.1.min.js" charset="utf-8"></script>
</body>
</html>
