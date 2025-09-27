<!DOCTYPE html>
<html lang="en">
    <?error_reporting(E_ALL);?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask Question</title>
    <link rel="stylesheet" href="../css/ask_question.css">
    <?php include 'header.php'; // navbar, login button etc. ?>
</head>

<body>
    <div class="container">
        <form method="POST" action="/StackIt/app/ask_question/index.php">

            <!-- Title -->
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter a short, descriptive title" required>

            <!-- Description -->
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Write your full question here..." ></textarea>

            <!-- Tags -->
            <label for="tags">Tags</label>
            <input type="text" id="tags" name="tags" placeholder="e.g. javascript, css, php">

            <!-- Submit -->
            <button type="submit">Submit</button>
        </form>
    </div>

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
