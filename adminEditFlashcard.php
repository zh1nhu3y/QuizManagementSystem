<!-- 
Programmer Name: Phuah Kuang Yi
Program Name   : Quizify System
Description    : Admin Edit Flashcard Page
 -->
<?php
session_start();
include 'dbConn.php';

$myID = $_GET['myID'];
if(isset($_POST['update'])){
    $ftitle = $_POST['txtFTitle'];
    $fsubject = $_POST['txtFSubject'];
    $updateQuery = "UPDATE `flashcard_t` SET `fc_title`='$ftitle',`fc_sub`='$fsubject' WHERE fc_id='$myID'";
    if(mysqli_query($connection, $updateQuery)) {
        echo 'Record updated successfully';
        header("Location: adminFlashcardList.php");
    } else {
        echo 'Sorry, something when wrong!';
    }
}
// load data to the form (display)
$query = "SELECT * FROM flashcard_t WHERE fc_id = " . $myID;
$results = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($results); //$row['email'];
$count = mysqli_num_rows($results);//1 or 0
if ($count == 1){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Flashcard Edit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="stylesheet" href="styles/adminEdit.css">
    <script src="javaScript/validation.js"></script>
    <link rel="shortcut icon" href="media/logo.png" />
</head>
<body>
    <aside>
       <div class="adminMenu">
        <div class="side-bar">
                    <header>
                        <img src="media/logo.png" alt="">
                        <h1><?php echo $_SESSION['adFn'] . ' ' . $_SESSION['adLn']; ?></h1>
                    </header>

                    <div class="menu">
                        <div class="item"><a href="adminStudentList.php"><i class="fa-solid fa-user-group"></i>Student</a></div>
                        <div class="item"><a href="adminTeacherList.php"><i class="fa-solid fa-school"></i>Teacher</a></div>
                        <div class="item"><a href="adminQuizList.php"><i class="fas fa-newspaper"></i>Quiz</a></div>
                        <div class="item"><a href="adminFlashcardList.php"><i class="fas fa-pen"></i>Flashcard</a></div>       
                        <div class="item"><a href="logout.php"><i class="fas fa-power-off"></i>Logout</a></div>

                    </div>
                </div>
            </div>
        </div>
    </aside>

    <section>
        <br>
        <h2>Flashcard Details</h2><br>
        <div class="div1">
        <form action="" method="post">
            <label for="ftitle">Flashcard Title:</label>
            <input type="text" id="ftitle" name="txtFTitle" placeholder="Title name.." value="<?php echo $row['fc_title']; ?>" pattern="[A-Za-z\s]+" required>
            <br>
            <label for="qsubject">Flashcard Subject:</label>
            <select id="qsubject" name="txtFSubject" class="form-control">
                <?php
                $options = array('Bahasa Malaysia', 'English', 'Mathematics', 'History', 'Science', 'Pure Science');
                $selected = $row['quiz_sub'];
                foreach ($options as $option) {
                    if ($selected == $option) {
                        echo "<option selected='selected' value='$selected'>$selected</option>";
                    } else {
                        echo "<option value='$option'>$option</option>";
                    }
                }
                ?>
            </select>
            <br>
            <input type="submit" value="Update" name="update" onclick="return confirmChange()">
        </form>
        </div>

    </section>
    
</body>
</html>

<?php
}else {
        header("Location: adminFlashcardList.php");
    }
mysqli_close($connection);
?>
