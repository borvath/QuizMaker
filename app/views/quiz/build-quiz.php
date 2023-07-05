<?php
    require_once '../../include.php';
    require_once '../../controllers/Quizzes.php';
    Auth::RequireLogin();

    $newQuiz = new Quizzes;
    $newQuiz->AddQuiz();
?>
<html lang="en-US">
<?php require APPDIR.'/views/include/head.php' ?>
<body>
    <?php require APPDIR.'/views/include/header.php' ?>
	<main class="webpage-content">
        <section class="quiz-builder">
            <div class="quiz-container">
                <form id="question-form" method="post">
                    <div>
                        <h2 style="display: inline-block; width: 25%">Quiz Name: </h2>
                        <label style="display: inline-block; width: 70%"><input type="text" id="quiz-name" name="quizName" style="width: 90%"></label>
                    </div>
                    <div id="question-builder">
                        <div id="question-container">
                            <h2 class="question-header">Question:</h2>
                            <div class="question">
                                <label class="question-text-label"><textarea class="question-text" id="question-text"></textarea></label>
                            </div>
                        </div>
                        <hr>
                        <div id="answer-container">
                            <h2 class="question-header">Answer Choices:</h2>
                            <div class="answer">
                                <label class="answer-select"><input type="radio" name="answer" class="answer-choice" id="radio-1" value="0"></label>
                                <label class="answer-text-label"><textarea class="answer-text" id="text-answer-1"></textarea></label>
                                <button type="button" class="delete-answer" onclick="return this.parentNode.remove();">X</button>
                            </div>
                            <div class="answer">
                                <label class="answer-select"><input type="radio" name="answer" class="answer-choice" id="radio-2" value="1"></label>
                                <label class="answer-text-label"><textarea class="answer-text" id="text-answer-2"></textarea></label>
                                <button type="button" class="delete-answer" onclick="return this.parentNode.remove();">X</button>
                            </div>
                        </div>
                    </div>
                    <div id="submit-buttons">
                        <button type="button" id="new-answer-choice">New Answer</button>
                        <button type="button" id="submit-question">Save Question</button>
                    </div>
                    <div class="saved-questions" id="saved-questions">

                    </div>
                    <button type="submit" id="submit-quiz" onclick="return saveQuiz();">Save Quiz</button>
                </form>
            </div>
        </section>
	</main>
    <script src="../../../public/javascript/buildquiz.js"></script>
    <?php require APPDIR.'/views/include/footer.php' ?>
</body>
</html>