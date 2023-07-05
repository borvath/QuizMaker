<?php
    require_once '../../include.php';
    require_once '../../controllers/Quizzes.php';
    Auth::RequireLogin();

    $quizzes = new Quizzes;
?>
<html lang="en-US">
<?php require APPDIR.'/views/include/head.php' ?>
<body>
    <?php require APPDIR.'/views/include/header.php' ?>
    <main class="webpage-content">
        <section class="main-center">
            <div class="quiz-selection-container"><a href="../quiz/build-quiz.php" id="quiz-1">+</a></div>
            <?php $quizzes->DisplayQuizzes() ?>
        </section>
    </main>
    <?php require APPDIR.'/views/include/footer.php' ?>
</body>
</html>