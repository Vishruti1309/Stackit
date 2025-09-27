<?php
include "../includes/db.php";
session_start();

// -------------------------
// 1) Count total questions
// -------------------------
$totalStmt = $conn->query("SELECT COUNT(*) FROM questions");
$totalQuestions = $totalStmt->fetch_row()[0];

// -------------------------
// 2) Pagination setup
// -------------------------
$limit = 5; // questions per page
$totalPages = ceil($totalQuestions / $limit);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;

$offset = ($page - 1) * $limit;

// -------------------------
// 3) Fetch questions (paginated)
// -------------------------
$sql = "SELECT q.id, q.title, q.description, q.created_at, u.username,
        (SELECT COUNT(*) FROM answers a WHERE a.question_id = q.id) AS answer_count
        FROM questions q
        JOIN users u ON q.user_id = u.id
        ORDER BY q.created_at DESC
        LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

$questions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // -------------------------
        // 4) Fetch tags per question
        // -------------------------
        $tagSql = "SELECT t.name 
                   FROM tags t
                   JOIN question_tags qt ON t.id = qt.tag_id
                   WHERE qt.question_id = ?";
        $tagStmt = $conn->prepare($tagSql);
        $tagStmt->bind_param("i", $row['id']);
        $tagStmt->execute();
        $tagResult = $tagStmt->get_result();

        $tags = [];
        while ($tagRow = $tagResult->fetch_assoc()) {
            $tags[] = $tagRow['name'];
        }
        $tagStmt->close();

        $row['tags'] = $tags;
        $questions[] = $row;
    }
}
?>
