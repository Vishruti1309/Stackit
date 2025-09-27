<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Register</title>
  <link rel = "stylesheet" href = "../css/login.css">
  
</head>
<body>

  <!-- <video autoplay muted loop id="bg-video">
    <source src="../videosphotos/3606751217-preview.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video> -->
  <div class="container">
    <!-- Left Side: Login Form -->
    <div class="form-container">
      <form action="../app/login/index.php" method="POST">
      <h2>Login</h2>
      <input type="email" placeholder="Email" id="email" name = "email">
      <input type="password" placeholder="Password" id="password" name = "password">
      <a href="#">Forgot Password</a>
      <button id="submit" type ="submit">Submit</button>
    </form>
    </div>

    <!-- Right Side: Welcome Panel -->
    <div class="welcome-container">
      <h2>Welcome!</h2>
      <p>Don't have an account? </p>
      <button onclick="window.location.href='register.php'">Register</button>
    </div>
  </div>


</body>
</html>
