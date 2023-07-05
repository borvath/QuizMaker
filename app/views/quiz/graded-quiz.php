<?php
    require_once '../../include.php';
    require_once '../../controllers/Quizzes.php';

    $quiz = new Quizzes;
    $quiz->GradeQuiz($_POST['quizName']);
    if(isset($_SESSION['grade'])) {
        echo '<script>alert("'.$_SESSION['grade'].'")</script>';
        unset($_SESSION['grade']);
    }
?>
<html lang="en-US">
<?php require APPDIR.'/views/include/head.php' ?>
<body>
    <?php require APPDIR.'/views/include/header.php' ?>
    <main class="webpage-content">
        <section class="quiz">
            <div class="active-quiz-container">
                <section class="active-quiz">
                    <h2 class="active-quiz-title"><?php echo $_POST['quizName']?></h2>
                    <?php $quiz->DisplayGradedQuiz($_POST['quizName']);?>
                </section>
            </div>
        </section>
    </main>
    <?php require APPDIR.'/views/include/footer.php' ?>
</body>
</html>