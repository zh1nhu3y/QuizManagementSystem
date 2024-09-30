<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Teacher Profile Page 
 -->
<?php
session_start();
include 'dbConn.php';
if (isset($_POST['saveDetails'])) {
    $tcrID = $_SESSION['tcrID'];
    $fname = $_POST['txtFname'];
    $lname = $_POST['txtLname'];
    $phnum = $_POST['numPhone'];

    $query = "UPDATE teacher_t SET tcr_fn='$fname',tcr_ln='$lname',tcr_pn='$phnum' WHERE tcr_id = '$tcrID' ";
    if (mysqli_query ($connection, $query)) {
        $sql = "SELECT * FROM teacher_t WHERE tcr_id='$tcrID'";
        $results = mysqli_query ($connection, $sql);
        $row = mysqli_fetch_assoc($results);
        $_SESSION['tcrFn'] = $row['tcr_fn'];
        $_SESSION['tcrLn'] = $row['tcr_ln'];
        $_SESSION['tcrPn'] = $row['tcr_pn'];

        echo '<script>alert("Details updated succesfully!")</script>';
    } else {
        echo '<script>alert("Opps something went wrong! Please Try Again.")</script>';
    }
}

if (isset($_POST['changePswrd'])) {
    $tcrID = $_SESSION['tcrID'];
    $password = $_POST['txtPassword'];
    $update = "UPDATE teacher_t SET tcr_pw='$password' WHERE tcr_id='$stdID'";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="styles/teacher.css">
    <link rel="shortcut icon" href="media/logo.png" />
    <script src="javaScript/validation.js"></script>
    <link rel="stylesheet" href="styles/profile.css">
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

    <div class="prof-cont">
        <br><br><br>
        <div class="prof-box">
            <form action="#" method="post" onsubmit="return confirmChange()">
                <div class="user-details">
                    <h3>My Details</h3>
                    <div class="input-box box1">
                        <label>First Name</label>
                        <input type="text" name="txtFname" placeholder="Enter First Name" pattern="[A-Za-z\s]+" required value="<?php echo $_SESSION['tcrFn']; ?>">
                    </div>
                    <div class="input-box box1">
                        <label>Last Name</label>
                        <input type="text" name="txtLname" placeholder="Enter Last Name" pattern="[A-Za-z\s]+" required value="<?php echo $_SESSION['tcrLn']; ?>" >
                    </div>
                    
                    <div class="input-box box1">
                        <label>Phone Number (without "-")</label>
                        <input type="tel" name="numPhone" placeholder="0123456789" pattern="[0-9]{10,11}" required value="<?php echo $_SESSION['tcrPn']; ?>">
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
                        <input type="email" name="txtEmail" placeholder="Enter Email" value="<?php echo $_SESSION['tcrEm']; ?>" readonly>
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
</body>
</html>