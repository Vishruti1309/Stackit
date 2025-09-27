<?php
session_start();
include "../../includes/db.php"; // connects to your database
include "../../includes/config.php"; //  load config

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Prepare query to prevent SQL Injection
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Compare entered password with stored password (plain text for now)
            if ($password === $row['password']) {
                // Login success
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];

                echo "Login successful! Welcome, " . htmlspecialchars($row['username']);
                // redirect if needed
               header("Location:"  .BASE_URL. "/public/homepage.php");
                exit;
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "No account found with this email.";
        }
        $stmt->close();
    } else {
        echo "⚠️ Please enter both email and password.";
    }
}
?>
