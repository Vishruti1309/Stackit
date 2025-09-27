<?php
include __DIR__ . "/../../includes/db.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../public/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $question_id = (int) $_POST['question_id'];
    $answer = trim($_POST['answer']);   
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO answers (question_id, user_id, answer, created_at) 
            VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $question_id, $user_id, $answer);
    $stmt->execute();

    header("Location: ../../public/question.php?id=" . $question_id);
    exit;
}
?>
