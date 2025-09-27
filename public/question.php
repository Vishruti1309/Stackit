<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <ERROR_REPORTING(E_ALL);?> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../app/question/index.php"; ?>
    <title>StackIt - How to join 2 columns</title>
    <link rel = "stylesheet" href = "../css/question.css">
</head>
<body>
   <?php include "header.php"; ?>

    <div class="container">
        <main class="main-content">
            <!-- breadcrumbs -->
             <div class="breadcrumb">
                <a href="homepage.php">Questions</a> > 
                <span><?php echo htmlspecialchars($question['title']); ?></span>
            </div>

            <!-- Question and vote section -->
            <div class="question-section">
                <div class="vote-section">
                    <!-- <php foreach ($answers as $ans): ?> -->
                    <!-- <button class="vote-btn up">▲</button>
                     <div class="vote-count"><php echo $ans['votes']; ?></div>
                    <button class="vote-btn down">▼</button> -->
                    <!-- <php endforeach; ?> -->
                </div>
                
                <div class="question-body">
                    <h1 class="question-title"><?php echo htmlspecialchars($question['title']); ?></h1>
                    
                    <div class="question-tags">
                         <?php foreach ($tags as $tag):?>
                        <span class="tag"><?php echo htmlspecialchars($tag); ?></span>
                        <span class="tag"><?php echo htmlspecialchars($tag); ?></span>
                          <?php endforeach; ?>
                    </div>
                    
                    <div class="question-content"> <?php echo htmlspecialchars($question['description']); ?></div>
                </div>
            </div>

            <div class="answers-section">
                <h2 class="answers-header">Answers</h2>
            
                <?php foreach ($answers as $ans): ?>
            <div class="answer">
                <div class="vote-box">
                <button class="vote-btn up">▲</button>
                <div class="vote-count"><?php echo $ans['votes']; ?></div>
                <button class="vote-btn down">▼</button>
                </div>
                <div class="answer-content">
                <div class="answer-title">
                    <?php echo htmlspecialchars($ans['username']); ?>'s Answer
                </div>
                <p><?php echo nl2br(htmlspecialchars($ans['answer'])); ?></p>
                <small>
                    on <?php echo date("M d, Y H:i", strtotime($ans['created_at']));?>
                </small>
                </div>
            </div>
              <?php endforeach; ?>
            </div>


            <div class="submit-section">
                <h3 class="submit-header">Submit Your Answer</h3>
                <form action="../app/answer/store.php" method="POST">
                    <input type="hidden" name="question_id" value="<?php echo (int)$_GET['id']; ?>">
                    <textarea id="description" name="answer" placeholder="Write your answer here..." ></textarea>
                    Pa$$w0rd!<button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>
     </main>

    </div>

    <script>
        // Add basic voting functionality
        document.querySelectorAll('.vote-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Toggle active state (you would implement actual voting logic here)
                this.style.borderColor = this.style.borderColor === 'rgb(88, 166, 255)' ? '#30363d' : '#58a6ff';
                this.style.color = this.style.color === 'rgb(88, 166, 255)' ? '#7d8590' : '#58a6ff';
            });
        });

        // Add editor functionality
        document.querySelectorAll('.editor-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const textarea = document.querySelector('.editor-textarea');
                const btnText = this.textContent;
                
                // Basic formatting (you would implement more sophisticated editor features)
                if (btnText === 'B') {
                    textarea.value += '**bold text**';
                } else if (btnText === 'I') {
                    textarea.value += '*italic text*';
                }
                textarea.focus();
            });
        });
    </script>
    <script src="https://cdn.tiny.cloud/1/m1anaola34pqgise5qprzj1q5gvpidb5v3ympxasjq0v79j5/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#description',  // textarea id
        menubar: false,
        plugins: 'lists link code',
        toolbar: 'undo redo | bold italic underline | bullist numlist | link | code',
        skin: 'oxide-dark',
        content_css: 'dark',
        height: 250,
        branding: false
      });
    </script>
</body>
</html>