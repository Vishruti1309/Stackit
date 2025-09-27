<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - StackIt</title>
  <link rel="stylesheet" href="../css/register.css">
</head>
<body>
  <!-- Site Title -->
  <div class="site-title">StackIt</div>
  
  <div class="container">
    <!-- Register Form (Left) -->
    <div class="form-container">
        <form method="POST" action="../app/register/index.php">
        <h2>Register</h2>
        <input id="name" type="text" name="username" placeholder="Full Name">
        <input type="email" id="email" name="email" placeholder="Email">
        <input type="password" id="password" name="password" placeholder="Password">
        <input type="password" id="confirmPassword" placeholder="Confirm Password">
        <button type="button" onclick="register()">Create Account</button>
      </form>
      </div>
      
      <!-- Welcome Section (Right) -->
      <div class="welcome-container">
        <div class="rocket-icon">🚀</div>
        <h2>Welcome!</h2>
        <p>Already have an account?</p>
        <button type="button" onclick="window.location.href='login.php'">Login</button>
      </div>
    </div>

  <script>
    function register() {
      let name = document.getElementById("name").value.trim();
      let email = document.getElementById("email").value.trim();
      let password = document.getElementById("password").value.trim();
      let confirmPassword = document.getElementById("confirmPassword").value.trim();

      // Reset any previous error states
      document.querySelectorAll('input').forEach(input => {
        input.classList.remove('error', 'success');
      });

      // Basic validation
      if (name === "" || email === "" || password === "" || confirmPassword === "") {
        alert("Please fill out all fields");
        // Add error class to empty fields
        if (name === "") document.getElementById("name").classList.add('error');
        if (email === "") document.getElementById("email").classList.add('error');
        if (password === "") document.getElementById("password").classList.add('error');
        if (confirmPassword === "") document.getElementById("confirmPassword").classList.add('error');
        return;
      }

      // Email validation (simple regex)
      let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
      if (!email.match(emailPattern)) {
        alert("Please enter a valid email");
        document.getElementById("email").classList.add('error');
        return;
      }

      // Password check
      if (password.length < 6) {
        alert("Password must be at least 6 characters");
        document.getElementById("password").classList.add('error');
        return;
      }

      if (password !== confirmPassword) {
        alert("Passwords do not match");
        document.getElementById("password").classList.add('error');
        document.getElementById("confirmPassword").classList.add('error');
        return;
      }

      // Add success class to all fields
      document.querySelectorAll('input').forEach(input => {
        input.classList.add('success');
      });

      // Success
      setTimeout(() => {
        // Redirect after success
        window.location.href = "../public/homepage.php";
      }, 500);
    }
  </script>
</body>
</html>