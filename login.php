<?php
  session_start();
  if(isset($_SESSION["user"])){
      echo "<script>
      alert(\"이미 로그인을 하셨습니다.\");
      location.href = \"/index.php\";
      </script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <title>Ruby on Rails</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/static/css/login.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <form class="form-signin" method="POST" action="/action/login.php">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">ID</label>  
        <input type="text" id="inputID" name="id" class="form-control" placeholder="ID" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-danger btn-block" type="submit">Sign in</button>  
        <a href="/register.php" style="top-margin:20px;">
          <p>회원 가입</p>  
        </a>
      </form>

    </div> <!-- /container -->
  </body>
</html>
