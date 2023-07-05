document.getElementById("new-answer-choice").addEventListener('click', newAnswer);
document.getElementById("submit-question").addEventListener('click', saveQuestion);

const answerField =
    '<div class="answer">' +
    '<label class="answer-select"><input type="radio" name="answer" class="answer-choice"></label>' +
    '<label class="answer-text-label"><textarea class="answer-text" id="text-answer-1"></textarea></label>' +
    '<button type="button" class="delete-answer" onclick="this.parentNode.remove(); deleteAnswer();">X</button></div>';
const questionBuilder =
    '<div id="question-container">' +
    '<h2 class="question-header">Question:</h2>' +
    '<div class="question">' +
    '<label class="question-text-label"><textarea class="question-text" id="question-text"></textarea></label>' +
    '</div></div>' +
    '<div id="answer-container">' + '<h2 class="question-header">Answer Choices:</h2>' + answerField + '</div>';
let numQuestions = 0;

function newAnswer() {
    document.getElementById("answer-container").insertAdjacentHTML("beforeend", answerField);
    let answers = document.getElementsByClassName("answer");
    let radio = document.getElementsByClassName("answer-choice");
    let answerTextarea = document.getElementsByClassName("answer-text");
    for(let i = 0; i < answers.length; i++) {
        answers[i].id = 'answer-' + (i + 1);
        radio[i].id = 'radio-' + (i + 1);
        radio[i].value = i + 1;
        answerTextarea[i].id = 'text-answer-' + (i + 1);
    }
}
function saveQuestion() {
    let answerRadio = document.getElementsByClassName("answer-choice");
    let answerText = document.getElementsByClassName("answer-text");
    let correctAnswer = false;
    for(let i = 0; i < answerRadio.length; i++) {
        if(answerText[i].value === '') {
            alert("Please make sure no answer is empty, or delete empty answers");
            return;
        }
        if(answerRadio[i].checked)
            correctAnswer = true;
    }
    if(document.getElementById("question-text").value === '') {
        alert("Please input something into the question area");
        return;
    }
    if(!correctAnswer) {
        alert("Please select the correct answer before saving question");
        return;
    }

    let savedQuestions = document.getElementById("saved-questions");
    let savedQuestionHTML = "";
    savedQuestionHTML +=
        '<div class="saved-question"><div class="saved-question-question">' +
        '<textarea class="saved-question-text" name="questionContent[]" readonly>' +
        document.getElementById("question-text").value + '</textarea></div><div class="saved-question-answers">';
    for(let i = 0; i < answerRadio.length; i++) {
        if(answerRadio[i].checked) {
            savedQuestionHTML +=
                '<div class=saved-answer>' +
                '<label><input type="radio" name="correctAnswer[' + numQuestions + ']" class="saved-answer-choice" value="' + i + '" checked></label>' +
                '<textarea class="saved-answer-text" style="display: inline;" name="answerContent[]" readonly>' +
                document.getElementById("text-answer-" + (i + 1)).value + '</textarea></div>';
        }
        else {
            savedQuestionHTML +=
                '<div class=saved-answer>' +
                '<label><input type="radio" name="correctAnswer[' + numQuestions + ']" class="saved-answer-choice" disabled></label>' +
                '<textarea class="saved-answer-text" style="display: inline;" name="answerContent[]" readonly>' +
                document.getElementById("text-answer-" + (i + 1)).value + '</textarea><br>' + '</div>';
        }
    }
    savedQuestionHTML +=
        '</div>' + '<input type="hidden" name="answerCount[]" value="' + answerRadio.length + '">' +
        '<button type="button" class="edit-button" onclick="editQuestion(this.parentNode); return this.parentNode.remove()">' +
        'Edit</button></div>';
    savedQuestions.insertAdjacentHTML("beforeend", savedQuestionHTML);
    document.getElementById("question-builder").innerHTML = questionBuilder;
    newAnswer();

    document.getElementById("new-answer-choice").addEventListener('click', newAnswer);
    document.getElementById("submit-question").addEventListener('click', saveQuestion);
    numQuestions += 1;
}
function editQuestion(parentDiv) {
    const questionTextArea = document.getElementById("question-text");
    questionTextArea.value = parentDiv.getElementsByClassName("saved-question-text")[0].innerHTML;

    const savedAnswers = parentDiv.getElementsByClassName("saved-answer-text");
    let answers = document.getElementsByClassName("answer");
    while(answers.length < savedAnswers.length)
        newAnswer();
    answers = document.getElementsByClassName("answer-text");
    for(let i = 0; i < savedAnswers.length; i++) {
        answers[i].value = savedAnswers[i].innerHTML;
    }
    numQuestions -= 1;
}
function saveQuiz() {
    let questionCount = '<input type="hidden" name="questionCount" value="' + numQuestions + '">';
    document.getElementById("question-form").insertAdjacentHTML("beforeend", questionCount);
    if(document.getElementById("saved-questions").innerHTML === "") {
        alert("Please save questions before submitting quiz");
        return false;
    }
    if(document.getElementById("quiz-name").value === "") {
        alert("Please enter a quiz name before submitting quiz");
        return false;
    }
    return true;
}
function deleteAnswer() {
    let answers = document.getElementsByClassName('answer-text');
    for(let i = 0; i < answers.length; i++) {
        answers[i].id = 'text-answer-' + (i + 1);
    }
}