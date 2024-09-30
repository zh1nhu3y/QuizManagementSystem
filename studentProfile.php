<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Student Profile Page 
 -->
<?php
session_start();
include 'dbConn.php';
if (isset($_POST['saveDetails'])) {
    $stdID = $_SESSION['stdID'];
    $fname = $_POST['txtFname'];
    $lname = $_POST['txtLname'];
    $phnum = $_POST['numPhone'];

    $query = "UPDATE student_t SET std_fn='$fname',std_ln='$lname',std_pn='$phnum' WHERE std_id = '$stdID' ";
    if (mysqli_query ($connection, $query)) {
        $sql = "SELECT * FROM student_t WHERE std_id='$stdID'";
        $results = mysqli_query ($connection, $sql);
        $row = mysqli_fetch_assoc($results);
        $_SESSION['stdFn'] = $row['std_fn'];
        $_SESSION['stdLn'] = $row['std_ln'];
        $_SESSION['stdPn'] = $row['std_pn'];

        echo '<script>alert("Details updated succesfully!")</script>';
    } else {
        echo '<script>alert("Opps something went wrong! Please Try Again.")</script>';
    }
}

if (isset($_POST['changePswrd'])) {
    $stdID = $_SESSION['stdID'];
    $password = $_POST['txtPassword'];
    $update = "UPDATE student_t SET std_pw='$password' WHERE std_id='$stdID'";
    $sql2 = mysqli_query ($connection, $update);
    if ($sql2) { 
        echo '<script>alert("Password Updated Successfully!")</script>';
    } else {
        echo '<script>alert("Something went wrong! Please Try Again.")</script>';
    }
}
mysqli_close($connection); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="shortcut icon" href="media/logo.png" />
    <link rel="stylesheet" href="styles/profile.css">
    <link rel="stylesheet" href="styles/student.css">
    <script src="javaScript/validation.js"></script>
    <style>
        .user-details h3, .user-details-1 h3{
            color: #643843;
        }
        .prof-box .submit {
            background-color: #E8A9A9;
        }
        .prof-box .submit:hover {
            background-color: #F4D3D3;
        }
    </style>
</head>
<body>
    <div class="header">
        <nav>
            <div class="logo">
                <a href=""><img src="./media/logo.png" alt="" ></a>
            </div>
            <a href="home.php" class="logo1">QuiZify</a>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="quiz.php">Quiz</a></li>
                <li><a href="flashcard.php">Flashcard</a></li>
                <li><a href="">Help Centre</a>
                    <ul>
                        <li><a href="StdHowTo.php">FAQ</a></li>
                        <li><a href="StdHowTo.php">Contact Us</a></li>
                    </ul>
                </li>
            </ul>
            <div class="login">
            <?php
            if (!empty($_SESSION['stdID'])) {
            ?>
                <div class="profile-btn" onclick="toggleMenu()"><i class="fa fa-user"></i></div>
                <div class="profile-wrap" id="profileMenu">
                    <div class="profile">
                        <div class="name">
                            <h3><?php echo $_SESSION['stdFn'] . ' ' . $_SESSION['stdLn']; ?></h3>
                        </div>
                        <hr>
                        <a href="studentProfile.php" class="profile-link">
                            <i class="fa fa-user"></i>
                            <p>My Profile</p>
                            <span>></span>
                        </a>
                        <a href="studentHistory.php" class="profile-link">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <p>History</p>
                            <span>></span>
                        </a>
                        <a href="logout.php" class="profile-link">
                            <i class="fa fa-power-off"></i>
                            <p>Logout</p>
                            <span>></span>
                        </a>
                    </div>
                </div> 
            <?php } else { ?>
                <a href="login.php" class="btn">Login</a>
            <?php
            }
            ?>
            </div>
            <script src="javaScript/profile.js"></script>
        </nav>
    </div>
    <div class="prof-cont">
        <br><br><br>
        <div class="prof-box">
            <form action="#" method="post" onsubmit="return confirmChange()">
                <div class="user-details">
                    <h3>My Details</h3>
                    <div class="input-box box1">
                        <label>First Name</label>
                        <input type="text" name="txtFname" placeholder="Enter First Name" pattern="[A-Za-z\s]+" required value="<?php echo $_SESSION['stdFn']; ?>" >
                    </div>
                    <div class="input-box box1">
                        <label>Last Name</label>
                        <input type="text" name="txtLname" placeholder="Enter Last Name" pattern="[A-Za-z\s]+" required value="<?php echo $_SESSION['stdLn']; ?>" >
                    </div>
                    
                    <div class="input-box box1">
                        <label>Phone Number (without "-")</label>
                        <input type="tel" name="numPhone" placeholder="0123456789" pattern="[0-9]{10,11}" required value="<?php echo $_SESSION['stdPn']; ?>">
                    </div>     
                    <br><br>  
                    <div class="prof-btn">  
                        <input type="submit" value="Save My Details" name="saveDetails" class="submit">
                        <input type="reset" value="Reset" class="submit">  
                    </div>        
                </div>
            </form>
        </div>
        <br><br><br>
        <div class="prof-box">  
            <form action="#" method="post" onsubmit="return validatePassword() && confirmChange()">
                <div class="user-details-1" >
                    <h3>Email & Password</h3>
                    <div class="input-box box1">
                        <label>Email Address</label>
                        <input type="email" name="txtEmail" placeholder="Enter Email" value="<?php echo $_SESSION['stdEm']; ?>" readonly>
                    </div>
                    
                    <div class="input-box box1">
                        <label>New Password</label>
                        <input type="password" name="txtPassword" id="password" placeholder="Enter New Password" 
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onfocus="pass()" required >
                        <span id="message2"></span>
                    </div>
                    
                    <div class="input-box box1">
                        <label>Confirm Password</label>
                        <input type="password" name="txtConfPassword" id="confPass" placeholder="Re-enter Password" required onkeyup="validatePassword()">
                        <span id="message1"> </span>
                    </div>
                    <br><br>
                    <input type="submit" value="Change Password" name="changePswrd" class="submit" onclick="wrongPassAlert()">
                    <br>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Home</h4>
                        <ul>
                            <li><a href="home.php">Home</a></li>
                        </ul>
                </div>
                <div class="footer-col">
                    <h4>Quiz</h4>
                        <ul>
                            <li><a href="quizSubject.php?subject=Bahasa%20Malaysia">Bahasa Malaysia</a></li>
                            <li><a href="quizSubject.php?subject=English">English</a></li>
                            <li><a href="quizSubject.php?subject=Mathematics">Mathematics</a></li>
                            <li><a href="quizSubject.php?subject=Science">Science</a></li>
                            <li><a href="quizSubject.php?subject=History">History</a></li>
                            <li><a href="quizSubject.php?subject=Pure%20Science">Pure Science</a></li>
                        </ul>
                </div>
                <div class="footer-col">
                    <h4>Flashcard</h4>
                        <ul>
                            <li><a href="flashcardSubject.php?subject=Bahasa%20Malaysia">Bahasa Malaysia</a></li>
                            <li><a href="flashcardSubject.php?subject=English">English</a></li>
                            <li><a href="flashcardSubject.php?subject=Mathematics">Mathematics</a></li>
                            <li><a href="flashcardSubject.php?subject=Science">Science</a></li>
                            <li><a href="flashcardSubject.php?subject=History">History</a></li>
                            <li><a href="flashcardSubject.php?subject=Pure%20Science">Pure Science</a></li>
                        </ul>
                </div>
                <div class="footer-col">
                    <h4>Help Centre</h4>
                        <ul>
                            <li><a href="StdHowTo.php">FAQ</a></li>
                            <li><a href="StdHowTo.php">Contact Us</a></li>
                        </ul>
                </div>
                <div class="footer-col"></li>
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>