<?php
class Quizzes {

    private Quiz $quizModel;

    public function __construct() {
        require_once '../../models/Quiz.php';
        $this->quizModel = new Quiz();
    }
    public function AddQuiz() : void {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $quizName = trim($_POST['quizName']);
            $questionCount = $_POST['questionCount'];
            $questionContent = $_POST['questionContent'];
            $answerCount = $_POST['answerCount'];
            $answerContent = $_POST['answerContent'];
            $correctAnswer = $_POST['correctAnswer'];

            if($this->quizModel->GetQuizByQuizName($_POST['quizName'])) {
                $_SESSION['message'] = 'Quiz name already used. Quiz save failed. Sorry :(';
                header('Location: ../quiz/build-quiz.php');
                exit;
            }
            else {
                $this->quizModel->AddQuiz($quizName, $questionCount);
                $quiz = $this->quizModel->GetQuizByQuizName($quizName);
                $answerIndex = 0;
                for ($i = 0; $i < $quiz->quiz_question_count; $i++) {
                    $this->quizModel->AddQuestion($quiz->quiz_id, $questionContent[$i], $answerCount[$i]);
                    $questionId = $this->quizModel->GetRecentId();
                    for ($j = 0; $j < $answerCount[$i]; $j++) {
                        if ($j == $correctAnswer[$i])
                            $this->quizModel->AddAnswer($questionId, $answerContent[$answerIndex], 1);
                        else
                            $this->quizModel->AddAnswer($questionId, $answerContent[$answerIndex], 0);
                        $answerIndex++;
                    }
                }
                header('Location: ../pages/main.php');
                exit;
            }
        }
    }
    public function LoadQuiz($quizName) : void {
        $activeQuiz = $this->quizModel->GetQuizByQuizName($quizName);
        $questions = $this->quizModel->GetQuizQuestions($activeQuiz->quiz_id);
        for($i = 0; $i < count($questions); $i++) {
            echo '<div class="active-quiz-question"><div class="question-number">'.($i + 1).'.</div><div class="question-content">';
            echo '<div class="active-quiz-question-question">'.$questions[$i]->question_content.'</div>';
            $answers = $this->quizModel->GetQuestionAnswers($questions[$i]->question_id);
            for($j = 0; $j < count($answers); $j++) {
                echo '<div class="active-quiz-question-answer"><label><input type="radio" name="answers['.$i.']" value="'.$j.'"></label>';
                echo '<div style="width: 90%; margin: 0 0 0 5px;">'.$answers[$j]->answer_content.'</div></div>';
            }
            echo '</div></div>';
        }
        echo '<input type="hidden" name="quizName" value="'.$quizName.'">';
    }
    public function GradeQuiz($quizName) : void {
        $activeQuiz = $this->quizModel->GetQuizByQuizName($quizName);
        $questions = $this->quizModel->GetQuizQuestions($activeQuiz->quiz_id);
        $numQuestions = count($questions);
        $numCorrect = 0;
        for($i = 0; $i < $numQuestions; $i++) {
            $answers = $this->quizModel->GetQuestionAnswers($questions[$i]->question_id);
            for($j = 0; $j < count($answers); $j++)
                if($answers[$j]->answer_correct == 1)
                    if($_POST['answers'][$i] == $j)
                        $numCorrect++;
        }
        $_SESSION['grade'] = 'Your score for this quiz is: '.$numCorrect.'/'.$numQuestions;
    }
    public function DisplayGradedQuiz($quizName) : void {
        $activeQuiz = $this->quizModel->GetQuizByQuizName($quizName);
        $questions = $this->quizModel->GetQuizQuestions($activeQuiz->quiz_id);
        for($i = 0; $i < count($questions); $i++) {
            echo '<div class="active-quiz-question"><div class="question-number">'.($i + 1).'.</div><div class="question-content">';
            echo '<div class="active-quiz-question-question">'.$questions[$i]->question_content.'</div>';
            $answers = $this->quizModel->GetQuestionAnswers($questions[$i]->question_id);
            for($j = 0; $j < count($answers); $j++) {
                if ($answers[$j]->answer_correct == 1) {
                    if ($_POST['answers'][$i] == $j) {
                        echo '<div class="active-quiz-question-answer correct"><label><input type="radio" name="answers['.$i.']" value="'.$j.'" checked disabled></label>';
                        echo '<div style="width: 90%; margin: 0 0 0 5px;">'.$answers[$j]->answer_content.'</div></div>';
                    }
                    else {
                        echo '<div class="active-quiz-question-answer"><label><input type="radio" name="answers['.$i.']" value="'.$j.'" disabled></label>';
                        echo '<div style="width: 90%; margin: 0 0 0 5px;">'.$answers[$j]->answer_content.'</div></div>';
                    }
                }
                else {
                    if ($_POST['answers'][$i] == $j) {
                        echo '<div class="active-quiz-question-answer incorrect"><label><input type="radio" name="answers['.$i.']" value="'.$j.'" checked disabled></label>';
                        echo '<div style="width: 90%; margin: 0 0 0 5px;">'.$answers[$j]->answer_content.'</div></div>';
                    }
                    else {
                        echo '<div class="active-quiz-question-answer"><label><input type="radio" name="answers['.$i.']" value="'.$j.'" disabled></label>';
                        echo '<div style="width: 90%; margin: 0 0 0 5px;">'.$answers[$j]->answer_content.'</div></div>';
                    }
                }

            }
            echo '</div></div>';
        }
    }
    public function DisplayQuizzes() : void {
        $quizArray = $this->quizModel->GetAllQuizzes();
        $quizNames = [];
        foreach($quizArray as $quiz)
            $quizNames[] = $quiz->quiz_name;
        for($i = 0; $i < count($quizArray); $i++)
            echo '<div class="quiz-selection-container"><a href="../quiz/take-quiz.php?quizName='.$quizNames[$i].'" id="quiz-'.($i + 2).'">'.
                $quizNames[$i].'</a></div>';
    }
}