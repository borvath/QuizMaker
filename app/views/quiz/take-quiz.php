<?php
    require_once '../../include.php';
    require_once '../../controllers/Quizzes.php';
    Auth::RequireLogin();

    $quiz = new Quizzes;
?>
<html lang="en-US">
<?php require APPDIR.'/views/include/head.php' ?>
<body>
    <?php require APPDIR.'/views/include/header.php' ?>
    <main class="webpage-content">
        <section class="quiz">
            <div class="active-quiz-container">
                <form class="active-quiz" action="graded-quiz.php" method="post">
                    <h2 class="active-quiz-title"><?php echo $_GET['quizName']?></h2>
                    <?php $quiz->LoadQuiz(urldecode($_GET['quizName']));?>
                    <button type="submit" id="submit-quiz">Submit Quiz</button>
                </form>
            </div>
        </section>
    </main>
    <?php require APPDIR.'/views/include/footer.php' ?>
</body>
</html>