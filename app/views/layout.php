<?php
/* @var $title */
/* @var $content_view */
?>

<style>
  button{
    cursor: pointer; border:none; background-image: none; background-color: transparent;
    padding: 0;

  }
  .error {
    color : red;
  }

</style>

<!DOCTYPE HTML>
<html lang="en">
<head>
  <link rel="stylesheet" href="/public/assets/css/styles.css">
  <script src="/public/assets/js/jquery-3.3.1.js"></script>
  <script src="/public/assets/js/contacts.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <meta charset="utf-8">

</head>
<body>

<div class="container">
  <nav id="w0" class="navbar navbar-fixed-top navbar-dark">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Task Board</a>
      </div>

      <div id="w0-collapse" class="collapse navbar-collapse">
        <ul id="w1" class="navbar-nav navbar-right nav navbar-dark ">
          <li><a href="/site/create">Create Task</a></li>
            <?php if(!$_SESSION['isLoggedIn']):?>
              <li><a href="/signUp">Sign Up</a></li>
              <li><a href="/signIn">Sign In</a></li>
            <?php else:?>
              <li><a href="/signIn/logout">
                  <img src="/public/assets/img/exit.png" height="20px" alt="Exit" width="20px">
                </a>
              </li>


            <?php endif;?>
        </ul>
      </div>
    </div>
  </nav>
</div>
<div  style="margin-top: 100px">
    <?php include 'app/views/'.$content_view.'.php'; ?>
</div>
</body>
</html>

