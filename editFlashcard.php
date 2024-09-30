<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Teacher Edit Flashcard Page (edit selected flashcard content)
 -->
<?php
session_start();
include 'dbConn.php' ;
$contID = $_GET['contID'];
$query = "SELECT * FROM `flashcard_content_t` WHERE cont_id = '$contID'";
$results = mysqli_query ($connection, $query);
$row = mysqli_fetch_assoc($results); 

if (isset($_POST['save'])) {
    $ques = $_POST['question'];
    $ans = $_POST['answer'];
    $query = "UPDATE `flashcard_content_t` SET `fc_ques`='$ques',`fc_ans`='$ans' WHERE cont_id = '$contID'";
    if (mysqli_query($connection, $query)) {
        header("Location: createFlashcard2.php?fcID=".$row['fc_id']."");
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Flashcard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/flashcard.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="shortcut icon" href="media/logo.png" />
    <link rel="stylesheet" href="styles/teacher.css">
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
            <h1>Mei Jun</h1>
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
        <div class="question-container" id="add-question-card">
            <h2>Edit Flashcard</h2>
            <div class="wrapper">
                <!-- Error message -->
                <div class="error-con">
                    <span class="hide" id="error">Input fields cannot be empty</span>
                </div>
                <!-- Close Button -->
                <a href="createFlashcard2.php?fcID=<?php echo $row['fc_id'] ?>">
                    <i class="fa-solid fa-xmark" id="close-btn"></i>
                </a>
            </div>

            <label for="question">Questions:</label>
            <textarea id="question" name="question" cols="30" placeholder="Type the question here..." rows="2" required><?php echo $row['fc_ques'] ?></textarea>
            <label for="answer">Answer:</label>
            <textarea id="answer" name="answer" cols="30" rows="4" placeholder="Type the answer here..." required><?php echo $row['fc_ans'] ?></textarea>
            <input type="submit" value="Save" id="save-btn" name="save">
        </div>
    </form>

    <script>
        const cardButton = document.getElementById("save-btn");
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