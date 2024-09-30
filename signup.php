<!-- 
Programmer Name: Law Mei Jun, Pan Zhin Huey
Program Name   : Quizify System
Description    : Sign Up Page 
 -->
<?php
include 'dbConn.php';

if (isset($_POST['signup'])) {
    $fname = $_POST['txtFname'];
    $lname = $_POST['txtLname'];
    $hpnumber = $_POST ['numPhone'];
    $role = $_POST ['txtRole'];
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];

    if ($role == "Student") {
        $query = "INSERT INTO `student_t`(`std_fn`, `std_ln`, `std_pn`, `std_em`, `std_pw`) VALUES ('$fname','$lname','$hpnumber','$email','$password')";
        if (mysqli_query($connection, $query)) {
            header("Location: login.php");
        } else {
            echo '<script>alert("Sorry, something went wrong. Please try again.")</script>';
        }
    } elseif ($role == "Teacher") {
        $query = "INSERT INTO `teacher_t`(`tcr_fn`, `tcr_ln`, `tcr_pn`, `tcr_em`, `tcr_pw`) VALUES ('$fname','$lname','$hpnumber','$email','$password')";
        if (mysqli_query($connection, $query)) {
            header("Location: login.php");
        } else {
            echo '<script>alert("Sorry, something went wrong. Please try again.")</script>';
        }
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
    <title>Sign Up</title>
    <link rel="shortcut icon" href="images/logo_shortcut.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/forms.css">
    <script src="javaScript/validation.js"></script>
    <link rel="shortcut icon" href="media/logo.png" />
</head>
<body>
    <div class="signup-cont">
        <div class="signup-box">
            <h1>Sign Up</h1>
            <form action="#" method="post" onsubmit="return validatePassword()">
                <div class="user-details">
                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" name="txtFname" placeholder="Enter First Name" pattern="[A-Za-z\s]+" required>
                    </div>
                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" name="txtLname" placeholder="Enter Last Name" pattern="[A-Za-z\s]+"  required>
                    </div>
                    
                    <div class="input-box">
                        <label>Phone Number (without "-")</label>
                        <input type="tel" name="numPhone" placeholder="0123456789" pattern="[0-9]{10,11}" required>
                    </div>
                    <div class="input-box">
                        <label>You are a:</label>
                        <select name="txtRole" class="role" required>
                            <option value="" disabled selected>--Select--</option>
                            <option value="Student">Student</option>
                            <option value="Teacher">Teacher</option>
                        </select>
                    </div>
                    
                    <div class="input-box">
                        <label>Email Address</label>
                        <input type="email" name="txtEmail" placeholder="Enter Email" required>
                    </div>
                    <div class="input-box"></div>
                    <div class="input-box">
                        <label>Password</label>
                        <input type="password" name="txtPassword" id="password" placeholder="Enter Password" 
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  onfocus="pass()" required>
                        <span id="message2"></span>
                    </div>
                    <div class="input-box">
                        <label>Confirm Password</label>
                        <input type="password" name="txtConfPassword" id="confPass" placeholder="Re-enter Password" required onkeyup="validatePassword()">
                        <span id="message1"> </span>
                    </div>
                    <input type="submit" value="Sign Up" name="signup" onclick="wrongPassAlert()">
                </div>
            </form>
        </div>
    </div>
</body>
</html>