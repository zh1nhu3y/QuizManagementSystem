<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Quiz Score Page 
 -->
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Score</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="shortcut icon" href="media/logo.png" />
    <style>
        body {
            background: black;
        }
        .score-container {
            margin: auto;
            text-align: center;
            background: white;
            /* padding: 0px 50px 70px 50px; */
            width: 400px;
            height: 300px;
            border-radius: 10px;
            margin-top: 150px;
            box-sizing: border-box;
            border: 2px solid #7895CB;
        }

        .score-title {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 10px;
            padding-top: 60px;
            /* color: white; */
        }

        .score-value {
            font-size: 36px;
            color: #4caf50;
            margin-top: 30px;
        }
        .score-container a {
            text-decoration: none;
            
        }
        .score-container a i {
            color: black;
            font-size: 30px;
            float: right;
            padding: 7px 13px 0 0;
            border-radius: 10px 10px 0 0;
            box-sizing: border-box;
            width: 100%;
            background: #C5DFF8;
            text-align: right;
        }
    </style>
</head>
<body>
    <div id="score-container" class="score-container" >
            <a href="quiz.php"><i class="fa-solid fa-xmark"></i></a>
        
        <div class="score-title"><span style="color: #4A55A2">Quiz Ended! </span><br><br>Your Score</div>
        <div id="score-value" class="score-value"><?php echo $_SESSION['score']; ?></div>
    </div>
</body>
</html>