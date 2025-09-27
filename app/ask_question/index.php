<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     echo "<pre>";
//     print_r($_POST);
//     echo "</pre>";
//     exit;
// }
include "../../includes/db.php";//?Database connection
session_start();
// Check login
if (!isset($_SESSION['user_id'])) {
    // die("Error: You must be logged in to post a question.");
     header("Location: login.php?error=login_required");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $tagsInput = trim($_POST['tags']);
    $user_id = $_SESSION['user_id'];
    // $user_id = 1;

    // Insert question
    $stmt = $conn->prepare("INSERT INTO questions (user_id, title, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $description);
    if (!$stmt->execute()) {
        die("Error inserting question: " . $stmt->error);
    }
    $question_id = $conn->insert_id;
    $stmt->close();

    // Handle tags
    if (!empty($tagsInput)) {
        $tags = explode(",", $tagsInput);
        foreach ($tags as $tag) {
            $tag = trim($tag);
            if ($tag == "") continue;

            // Check if tag exists
            $stmt = $conn->prepare("SELECT id FROM tags WHERE name = ?");
            $stmt->bind_param("s", $tag);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $tag_id = $row['id'] ?? null;
            $stmt->close();

            // If not exist → insert
            if (!$tag_id) {
                $stmt = $conn->prepare("INSERT INTO tags (name) VALUES (?)");
                $stmt->bind_param("s", $tag);
                if (!$stmt->execute()) {
                    die("Error inserting tag: " . $stmt->error);
                }
                $tag_id = $conn->insert_id;
                $stmt->close();
            }

            // Insert into question_tags
            $stmt = $conn->prepare("INSERT INTO question_tags (question_id, tag_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $question_id, $tag_id);
            if (!$stmt->execute()) {
                die("Error linking tag: " . $stmt->error);
            }
            $stmt->close();
        }
    }

    echo "<script>alert('Question submitted successfully!'); window.location.href='../../public/homepage.php';</script>";
}
?>
