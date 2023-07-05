<?php
class Quiz {

    private Database $db;

    public function __construct() {
        $this->db = new Database;
    }
    public function AddQuiz($quizName, $quizQuestionCount) : bool {
        $this->db->Query('INSERT INTO quiz(quiz_name, quiz_question_count) VALUES(:quizName, :quizQuestionCount)');
        $this->db->Bind('quizName', $quizName);
        $this->db->Bind('quizQuestionCount', $quizQuestionCount);

        return $this->db->execute();
    }
    public function AddQuestion($quizId, $questionContent, $answerCount) : bool {
        $this->db->Query('INSERT INTO question(question_quiz_id, question_content, question_answer_count) VALUES(:quizId, :questionContent, :answerCount)');
        $this->db->Bind('quizId', $quizId);
        $this->db->Bind('questionContent', $questionContent);
        $this->db->Bind('answerCount', $answerCount);

        return $this->db->execute();
    }
    public function AddAnswer($questionId, $answerContent,$isAnswerCorrect) : bool {
        $this->db->Query('INSERT INTO answer(answer_question_id, answer_content, answer_correct) VALUES(:questionId, :answerContent, :isAnswerCorrect)');
        $this->db->Bind('questionId', $questionId);
        $this->db->Bind('answerContent', $answerContent);
        $this->db->Bind('isAnswerCorrect', $isAnswerCorrect);

        return $this->db->execute();
    }
    public function GetQuizByQuizName($quizName) : mixed {
        $this->db->Query('SELECT * FROM quiz WHERE quiz_name = :quizName');
        $this->db->Bind('quizName', $quizName);

        return $this->db->GetSingleResult();
    }
    public function GetAllQuizzes() : array | bool {
        $this->db->Query('SELECT * FROM quiz');
        return $this->db->GetResultSet();
    }
    public function GetQuizQuestions($quizId) : array {
        $this->db->Query('SELECT question_id, question_content FROM question WHERE question_quiz_id = :quizId');
        $this->db->Bind('quizId', $quizId);
        return $this->db->GetResultSet();
    }
    public function GetQuestionAnswers($questionId) : array {
        $this->db->Query('SELECT answer_id, answer_content, answer_correct FROM answer WHERE answer_question_id = :questionId');
        $this->db->Bind('questionId', $questionId);

        return $this->db->GetResultSet();
    }
    public function GetRecentId() : int {
        return $this->db->LastInsertId();
    }
}