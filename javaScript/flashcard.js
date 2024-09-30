const container = document.querySelector(".container");
const addQuestionCard = document.getElementById("add-question-card");
const cardButton = document.getElementById("save-btn");
const question = document.getElementById("question");
const answer = document.getElementById("answer");
const errorMessage = document.getElementById("error");
const addQuestion = document.getElementById("add-flashcard");
const closeBtn = document.getElementById("close-btn");
let editBool = false;

//Add question when user clicks 'Add Flashcard' button
addQuestion.addEventListener("click", () => {
    container.classList.add("hide");
    // question.value = "";
    // answer.value = "";
    addQuestionCard.classList.remove("hide");
});

// Hide Create flashcard 
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

// Save Button Pressed


