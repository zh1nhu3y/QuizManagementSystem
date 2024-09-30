<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Teacher Create Flashcard Page (flashcard contents)
 -->
<?php
session_start();
include 'dbConn.php' ;
$fcID = $_GET['fcID'];
$query = "SELECT * FROM `flashcard_t` WHERE fc_id = '$fcID'";
$results = mysqli_query ($connection, $query);
$row = mysqli_fetch_assoc($results); 
$title = $row['fc_title'];
$subject = $row['fc_sub'];

$query2 = "SELECT * FROM `flashcard_content_t` WHERE fc_id = '$fcID'";
$results2 = mysqli_query($connection, $query2);
$count2 = mysqli_num_rows($results2); 

if (isset($_POST['save'])) {
    $ques = $_POST['question'];
    $ans = $_POST['answer'];
    $query = "INSERT INTO `flashcard_content_t`(`fc_id`, `fc_ques`, `fc_ans`) VALUES ('$fcID','$ques','$ans')";
    if (mysqli_query($connection, $query)) {
        header("Location: createFlashcard2.php?fcID=".$fcID."");
    } else {
        echo '<script>alert("Sorry, something went wrong. Please try again.")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Flashcard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="styles/teacher.css">
    <link rel="stylesheet" href="styles/flashcard.css">
    <link rel="shortcut icon" href="media/logo.png" />
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

    <div class="container">
        <div class="header">
            <h1><span style="color: #FD841F; margin-right:10px;">Flashcard Title:</span> <?php echo $title?></h1>
            <h2><span style="color: #E8AA42; margin-right:10px;">Subject:</span> <?php echo $subject?></h2>
        </div>
        <div class="add-flashcard-con">
            <button id="add-flashcard">Add Flashcard</button>
            <button id = "save-flashcard">Save</button>
        </div>
        <script>
            var saveBtn = document.getElementById("save-flashcard");
            saveBtn.addEventListener("click", function (){
                location = "myFlashcard.php";
                alert("Flashcard Saved!");
            })
        </script>
        <div id="card-con">
            <div class="card-list-container">
            <?php
                if ($count2 != 0) {
                    while ($row2 = mysqli_fetch_assoc($results2)) {

            ?>
            <!-- Display Card of Question And Answers Here -->
                        <div class="card">
                            <p class="question-div" id="question-div"><?php echo $row2['fc_ques']; ?></p>
                            <div href="#" class="show-hide-btn" id="show-hide-btn">Answer:</div>
                            <p class="answer-div" id="answer-div"><?php echo $fcAns= $row2['fc_ans']; ?></p>
                            <div class="buttons-con">
                                <a href="editFlashcard.php?contID=<?php echo $row2['cont_id'] ?>" class="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="deleteFlashcard.php?contID=<?php echo $row2['cont_id']?>&fcID=<?php echo $fcID?>" class="delete"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </div>
            <?php }} ?>
            </div>
        </div>
    </div>

    <!-- Input form for user -->
    <form action="#" method="post">
        <div class="question-container hide" id="add-question-card">
            <h2>Add Flashcard</h2>
            <div class="wrapper">
                <!-- Error message -->
                <div class="error-con">
                    <span class="hide" id="error">Input fields cannot be empty</span>
                </div>
                <!-- Close Button -->
                <i class="fa-solid fa-xmark" id="close-btn"></i>
            </div>

            <label for="question">Questions:</label>
            <textarea id="question" name="question" placeholder="Type the question here..." rows="2" required></textarea>

            <label for="answer">Answer:</label>
            <textarea id="answer" name="answer" rows="4" placeholder="Type the answer here..." required></textarea>
            <input type="submit" value="Save" id="save-btn" name="save">
        </div>
    </form>
    <script src="javaScript/flashcard.js"></script>
</body>
</html>
<?php
mysqli_close($connection);
?>