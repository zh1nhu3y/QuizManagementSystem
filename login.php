<!-- 
Programmer Name: Law Mei Jun, Pan Zhin Huey
Program Name   : Quizify System
Description    : Login Page 
 -->
<?php
session_start();
include 'dbConn.php';

if (isset($_POST['login'])) {
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];
    $query = "SELECT * FROM student_t WHERE std_em='$email' AND std_pw='$password'";
    $results = mysqli_query ($connection, $query);
    $row = mysqli_fetch_assoc($results); 
    $count = mysqli_num_rows($results); 

    $query2 = "SELECT * FROM admin_t WHERE ad_em = '$email' AND ad_pw = '$password'";
    $results2 = mysqli_query ($connection, $query2);
    $row2 = mysqli_fetch_assoc($results2); 
    $count2 = mysqli_num_rows($results2);

    $query3 = "SELECT * FROM teacher_t WHERE tcr_em ='$email' AND tcr_pw='$password'";
    $results3 = mysqli_query ($connection, $query3);
    $row3 = mysqli_fetch_assoc($results3); 
    $count3 = mysqli_num_rows($results3); 
    
    if ($count == 1) {
        $_SESSION['stdID'] = $row['std_id'];
        $_SESSION['stdFn'] = $row['std_fn'];
        $_SESSION['stdLn'] = $row['std_ln'];
        $_SESSION['stdPn'] = $row['std_pn'];
        $_SESSION['stdEm'] = $row['std_em'];

        header ("Location: home.php");
    } elseif ($count2 == 1) {
        $_SESSION['adID'] = $row2['ad_id'];
        $_SESSION['adFn'] = $row2['ad_fn'];
        $_SESSION['adLn'] = $row2['ad_ln'];

        header ("Location: adminTeacherList.php");
    } elseif ($count3 == 1) {
        $_SESSION['tcrID'] = $row3['tcr_id'];
        $_SESSION['tcrFn'] = $row3['tcr_fn'];
        $_SESSION['tcrLn'] = $row3['tcr_ln'];
        $_SESSION['tcrPn'] = $row3['tcr_pn'];
        $_SESSION['tcrEm'] = $row3['tcr_em'];

        header ("Location: teacherHome.php");
    } else {
        echo '<script>alert("Invalid Email or Password!")</script>';
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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/forms.css">
    <link rel="shortcut icon" href="media/logo.png" />
</head>
<body>
    <div class="login-cont">
        <div class="login-box">
            <h1>Login</h1>
            <form action="" method="post">
                <label>Email Address</label>
                <div>
                    <i class="fa-solid fa-user"></i>
                    <input type="email" name="txtEmail" placeholder="Enter Email" required>
                </div>
                <label>Password</label>
                <div>
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="txtPassword" placeholder="Enter Password" required>
                </div>
                <input type="submit" value="Login" name="login">
            </form>
            <a href="signup.php" class="signup">Sign Up</a>
        </div>
    </div>
</body>
</html>