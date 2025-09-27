<?php
include __DIR__ . "/../../includes/db.php";
session_start();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid question ID");
}
$question_id = (int) $_GET['id'];

// Fetch question
$qSql = "SELECT q.id, q.title, q.description, q.created_at, u.username 
         FROM questions q
         JOIN users u ON q.user_id = u.id
         WHERE q.id = ?";
$stmt = $conn->prepare($qSql);
$stmt->bind_param("i", $question_id);
$stmt->execute();
$result = $stmt->get_result();
$question = $result->fetch_assoc();

// Fetch tags
$tSql = "SELECT t.name 
         FROM tags t 
         JOIN question_tags qt ON t.id = qt.tag_id
         WHERE qt.question_id = ?";
$tStmt = $conn->prepare($tSql);
$tStmt->bind_param("i", $question_id);
$tStmt->execute();
$tResult = $tStmt->get_result();
$tags = [];
while ($row = $tResult->fetch_assoc()) {
    $tags[] = $row['name'];
}
$question['tags'] = $tags;

// Fetch answers
// $aSql = "SELECT a.answer, v.vote_type, a.created_at, u.username
//          FROM answers a
//          JOIN users u ON a.user_id = u.id
//          JOIN votes v ON a.user_id = v.user_id
//          WHERE a.question_id = ?
//          ORDER BY a.created_at DESC";
 $aSql = "SELECT a.id, a.answer, a.created_at, u.username,
       COALESCE(SUM(CASE WHEN v.vote_type = 'up' THEN 1 
                         WHEN v.vote_type = 'down' THEN -1 
                         ELSE 0 END), 0) AS votes
            FROM answers a
            JOIN users u ON a.user_id = u.id
            LEFT JOIN votes v ON a.id = v.answer_id
            WHERE a.question_id = ?
            GROUP BY a.id, a.answer, a.created_at, u.username
            ORDER BY a.created_at DESC";

$aStmt = $conn->prepare($aSql);
$aStmt->bind_param("i", $question_id);
$aStmt->execute();
$aResult = $aStmt->get_result();
$answers = [];
while ($row = $aResult->fetch_assoc()) {
    $answers[] = $row;
}
?>  