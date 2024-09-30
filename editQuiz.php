<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Teacher Edit Quiz Page (edit selected quiz question)
 -->
<?php
session_start();
include 'dbConn.php';

$quesID = $_GET['quesID'];
$query = "SELECT * FROM `quiz_ans_t` WHERE ques_id = '$quesID'";
$results = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($results);

if(isset($_POST['save'])) {
    $ques = $_POST['question'];
    $ansA = $_POST['answerA'];
    $ansB = $_POST['answerB'];
    $ansC = $_POST['answerC'];
    $ansD = $_POST['answerD'];
    $corrAns = $_POST['correct-ans'];

    $query2 = "UPDATE `quiz_ans_t` SET  `question`='$ques',`ans_a`='$ansA',`ans_b`='$ansB',`ans_c`='$ansC',`ans_d`='$ansD',`cor_ans`='$corrAns' WHERE '$quesID' = ques_id";
    if (mysqli_query($connection, $query2)) {
        header("Location: createQuiz2.php?quizID=".$row['quiz_id']."");
    } else {
        echo '<script>alert("Sorry, something went wrong. Please try again.")</script>';
    }
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz</title>
    <link rel="stylesheet" href="styles/teacher.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="shortcut icon" href="media/logo.png" />
    <link rel="stylesheet" href="styles/flashcard.css">
    <link rel="stylesheet" href="styles/quiz.css">
</head>
<body>
    <div class="menu-btn">
        <i class="fas fa-bars"></i>
    </div>
    <div class="side-bar">
        <header>
            <div class="close-btn">
                <i class="fas fa-times"></i>
            </div>
            <img src="media/logo.png" alt="">
            <h1><?php echo $_SESSION['tcrFn'] . ' ' . $_SESSION['tcrLn']; ?></h1>
        </header>

        <div class="menu">
            <div class="item"><a href="teacherHome.php"><i class="fas fa-house"></i>Home</a></div>
            <div class="item"><a class="sub-btn"><i class="fas fa-newspaper"></i>Quiz
                <i class="fa fa-angle-right dropdown"></i>
                </a>
                <div class="sub-menu">
                    <a href="createQuiz1.php" class="sub-item">Create Quiz</a>
                    <a href="myQuiz.php" class="sub-item">My Quiz</a>
                </div>
            </div>
            <div class="item"><a class="sub-btn"><i class="fas fa-pen"></i>Flashcard
                <i class="fa fa-angle-right dropdown"></i>
                </a>
                <div class="sub-menu">
                    <a href="createFlashcard1.php" class="sub-item">Create Flashcard</a>
                    <a href="myFlashcard.php" class="sub-item">My Flashcard</a>
                </div>
            </div>
            <div class="item"><a href="teacherProfile.php"><i class="fas fa-user"></i>Profile</a></div>
            <div class="item"><a href="helpDesk.php"><i class="fas fa-circle-info"></i>Helpdesk</a></div>
            <div class="item"><a href="logout.php"><i class="fas fa-power-off"></i>Logout</a></div>

        </div>
    </div>
    <script src="javaScript/nav.js"></script>

    <form action="#" method="post">
        <div class="quiz-question-container" id="add-question-card">
            <h2>Edit Quiz</h2>
            <div class="wrapper">
                <!-- Error message -->
                <div class="error-con">
                    <span class="hide" id="error">Input fields cannot be empty</span>
                </div>
                <!-- Close Button -->
                <a href="createQuiz2.php?quizID=<?php echo $row['quiz_id'] ?>">
                <i class="fa-solid fa-xmark xButton" id="close-btn"></i>
                </a>
            </div>

            <label for="question">Question:</label>
            <textarea id="question" name="question" placeholder="Type the question here..." rows="4" required><?php echo $row['question']?></textarea>

            <label for="answer">Answer A:</label>
            <textarea id="answer" name="answerA" rows="2" placeholder="Type the answer here..." required><?php echo $row['ans_a']?></textarea>
            
            <label for="answer">Answer B:</label>
            <textarea id="answer" name="answerB" rows="2" placeholder="Type the answer here..." required><?php echo $row['ans_b']?></textarea>
            
            <label for="answer">Answer C:</label>
            <textarea id="answer" name="answerC" rows="2" placeholder="Type the answer here..." required><?php echo $row['ans_c']?></textarea>
            
            <label for="answer">Answer D:</label>
            <textarea id="answer" name="answerD" rows="2" placeholder="Type the answer here..." required><?php echo $row['ans_d']?></textarea>
            
            <!-- <label for="answer">Correct Answer:</label> -->
            <!-- <textarea id="answer" name="correct-ans" rows="1" placeholder="Type the correct answer here..." required><?php echo $row['cor_ans']?></textarea> -->
            <label for="answer">Correct Answer:</label>
            <select name="correct-ans" id="answer">
                <option value="" disabled selected>Select The Correct Answer</option>
                <?php
                $options = array('A', 'B', 'C', 'D');
                $selected = $row['cor_ans'];
                foreach ($options as $option) {
                    if ($selected == $option) {
                        echo "<option selected='selected' value='$selected'>$selected</option>";
                    } else {
                        echo "<option value='$option'>$option</option>";
                    }
                }
                ?>
            </select>
            <input type="submit" value="Save" id="save-button" name="save">
        </div>
    </form>

    <script>
        const cardButton = document.getElementById("save-button");
        const question = document.getElementById("question");
        const answer = document.getElementById("answer");
        const errorMessage = document.getElementById("error");
        cardButton.addEventListener("click", (submitQuestion = () => {
        var tempQuestion = question.value.trim();
        var tempAnswer = answer.value.trim();
        if (!tempQuestion || !tempAnswer) {
            errorMessage.classList.remove("hide");
        } else {
            errorMessage.classList.add("hide");
        }
        }));
    </script>
</body>
</html>