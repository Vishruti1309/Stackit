<?php 
include "../app/homepage/index.php"; // loads $questions
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="../css/homepage.css">
  </head>
  <!-- <php include 'header.php'; ?> -->
<body>

  <header class="navbar">
    <div class="logo">StackIt</div>
    <!-- <nav class="nav-items">
        <a href="homepage.php">Home</a>
        <a href="login.php">Login</a>
    </nav> -->
    <nav class="nav-items">
    <?php if (isset($_SESSION['username'])): ?>
        <div class="user-menu">
            <img src="../videosphotos/bb87180897cb4cb694cd692966a0ab15.jpg" alt="User Avatar" class="avatar">
            <span class="welcome"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>
    <?php else: ?>
        <a href="login.php">Login</a>
    <?php endif; ?>
    </nav>
  </header>

    <!-- Top Navbar -->
       <div class="navbar1">
        <button class="ask-btn" onclick="window.location.href='ask_question.php'">Ask New Question</button>
        <div class="filters">
            <button class="filter">Newest</button>
            <button class="filter">Unanswered</button>
            <button class="filter">More ▼</button>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search...">
            <button>🔍</button>
        </div>
    </div>
<div class="container">
    <!-- Questions Section -->
    <div class="questions-list">
        <?php if (!empty($questions)): ?>
            <?php foreach ($questions as $q): ?>
              
    <div class="question-card">
    <!-- Left section: question -->
    <div class="question-content">
        <h3>
            <a href="question.php?id=<?php echo $q['id']; ?>">
                <?php echo htmlspecialchars($q['title']); ?>
            </a>
        </h3>
        <p class="desc">
            <?php echo nl2br(htmlspecialchars(substr($q['description'], 0, 200))); ?>...
        </p>

        <!-- Tags placeholder -->
        <div class="tags">
            <?php foreach ($q['tags'] as $tag): ?>
                <span class="tag"><?php echo htmlspecialchars($tag); ?></span>
            <?php endforeach; ?>
        </div>

        <small class="meta">
            Asked by <b><?php echo htmlspecialchars($q['username']); ?></b> 
            on <?php echo date("M d, Y H:i", strtotime($q['created_at'])); ?>
        </small>
    </div>

    <!-- Right section: answer count -->
    <div class="answers-box">
        <span><?php echo $q['answer_count']; ?> ans</span>
    </div>
</div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No questions yet. Be the first to <a href="ask_question.php">ask a question</a>!</p>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <!-- <div class="pagination" id="pagination">
    <a href="#" id="prev">&lt;</a>
    <div id="page-numbers"></div>
    <a href="#" id="next">&gt;</a>
    </div> -->
    <div class="pagination" id="pagination">
    <a href="?page=<?php echo max(1, $page-1); ?>" id="prev">&lt;</a>
    <div id="page-numbers"></div>
    <a href="?page=<?php echo min($totalPages, $page+1); ?>" id="next">&gt;</a>
    </div>



</div>

<!-- <script src = "../js/homepage.jsscript> -->
<script>
    window.totalPages = <?= $totalPages ?>;
    window.currentPage = <?= $page ?>;
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // read values injected by PHP into window object
    const totalPages = window.totalPages || 1;
    const currentPage = window.currentPage || 1;

    const pageNumbersDiv = document.getElementById("page-numbers");
    const prevBtn = document.getElementById("prev");
    const nextBtn = document.getElementById("next");

    // build pagination
    pageNumbersDiv.innerHTML = "";

    for (let i = 1; i <= totalPages; i++) {
        const link = document.createElement("a");
        link.href = "?page=" + i;
        link.textContent = i;

        // highlight current page
        if (i === currentPage) {
            link.classList.add("active");
        }

        pageNumbersDiv.appendChild(link);
    }

    // prev button
    if (prevBtn) {
        if (currentPage <= 1) {
            prevBtn.classList.add("disabled");
            prevBtn.removeAttribute("href");
        } else {
            prevBtn.href = "?page=" + (currentPage - 1);
        }
    }

    // next button
    if (nextBtn) {
        if (currentPage >= totalPages) {
            nextBtn.classList.add("disabled");
            nextBtn.removeAttribute("href");
        } else {
            nextBtn.href = "?page=" + (currentPage + 1);
        }
    }
});
</script>

    <?php echo "DEBUG: page = $page, totalPages = $totalPages"; ?>

    </body>
</html>
