<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Log in</title>

 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<form  action="index.php" method="post" class="form-signin">
  
  <h1 class="h3 mb-3 font-weight-normal">Please log in</h1>
  <label for="username" class="sr-only">Username</label>
  <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>

  <label for="pass" class="sr-only">Password</label>
  <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
 <!--  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div> -->
  <button class="btn btn-lg btn-primary btn-block" type="submit" id="loginBtn">Log in</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2021</p>
</form>




    
  </body>
</html>
