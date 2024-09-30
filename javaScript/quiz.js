const container = document.querySelector(".container");
const addQuestionCard = document.getElementById("add-question-card");
const cardButton = document.getElementById("save-button");
const question = document.getElementById("question");
const answer = document.getElementById("answer");
const errorMessage = document.getElementById("error");
const addQuestion = document.getElementById("add-quiz");
const closeBtn = document.getElementById("close-btn");
let editBool = false;

//Add question when user clicks 'Add Quiz' button
addQuestion.addEventListener("click", () => {
    container.classList.add("hide");


    addQuestionCard.classList.remove("hide");
});

// Hide Create quiz
closeBtn.addEventListener("click", hideQuestion)
function hideQuestion () {
    container.classList.remove("hide");
    addQuestionCard.classList.add("hide");
    if (editBool) {
        editBool = false;
        submitQuestion();
    }
};

// Submit Question
cardButton.addEventListener("click", (submitQuestion = () => {
    container.classList.remove("hide");
    editBool = false;
    var tempQuestion = question.value.trim();
    var tempAnswer = answer.value.trim();
    if (!tempQuestion || !tempAnswer) {
        container.classList.add("hide");
        errorMessage.classList.remove("hide");
    } else {
        container.classList.remove("hide");
        errorMessage.classList.add("hide");
        hideQuestion();
    }
}));



