<!-- 


  <header class="navbar">
    <div class="logo">StackIt</div>
    <nav class="nav-items">
      <a href="homepage.php">Home</a>
      <img src="https://img.icons8.com/ios-filled/24/ffffff/bell.png" alt="Notifications" class="icon">
      <img src="https://avatars.githubusercontent.com/u/9919?s=200&v=4" alt="User Avatar" class="avatar">
    </nav>
  </header> -->

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<body>
<header class="navbar">
    <div class="logo">
    <a href = "homepage.php">StackIt</a>  
    </div>
    <nav class="nav-items">
        <?php if (isset($_SESSION['username'])): ?>
            <div class="user-menu">
                <img src="../videosphotos/bb87180897cb4cb694cd692966a0ab15.jpg" 
                     alt="User Avatar" class="avatar">
                <span class="welcome">
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                </span>
                <a href="logout.php" class="btn-logout">Logout</a>
            </div>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>
</body>
</html> 