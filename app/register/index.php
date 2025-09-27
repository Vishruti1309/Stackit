<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); 

    // Hash the password
    // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // DB connection
    include "../../includes/db.php"; // this should define $conn (MySQLi connection)

    // Use prepared statement
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $username, $email, $password);
    //      if ($stmt->execute()) {
    //          echo " User registered successfully!";
    //      } else {
    //          echo " Error: " . $stmt->error;
    //    }
    if ($stmt->execute()) {
    header("Location: ../../public/homepage.php");
    exit;
    } else {
        echo "Error: " . $stmt->error;
    }

        $stmt->close();
     } else {
         echo " Prepare failed: " . $conn->error;
    }

    $conn->close();
}
?>
