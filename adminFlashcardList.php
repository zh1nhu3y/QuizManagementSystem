<!-- 
Programmer Name: Phuah Kuang Yi
Program Name   : Quizify System
Description    : Admin Flashcard List Page
 -->
<?php
include 'dbConn.php' ;
session_start();
$query = "SELECT * FROM flashcard_t";
$results = mysqli_query($connection, $query);
$count = mysqli_num_rows($results);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuiZify Admin Flashcard Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="stylesheet" href="styles/tables.css">
    <link rel="shortcut icon" href="media/logo.png" />
    <script src="javaScript/validation.js"></script>
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
        <div class="infoAdmin" align="left">
            <h1>Flashcard List</h1>
            <div align="left">
                <form class="adminsearchbox" action="" method="get" >
                    Enter Flashcard ID: <input type="text" placeholder="Search Flashcard ID..." name="txtFlashcardID" id="">
                    <input type="submit" value="Search" name='Search'>
                </form>
                <button class="all-btn" onclick="window.location.href='adminFlashcardList.php';">Refresh</button>
                <div class="clear"></div>
            </div><br>
            <hr><br>
            <p>Total Flashcards: <?php echo $count; ?></p><br>
            <?php
                if (isset ($_GET['Search'])) {
                    $id = $_GET['txtFlashcardID'];
                    $query = "SELECT * FROM flashcard_t INNER JOIN teacher_t ON flashcard_t.tcr_id = teacher_t.tcr_id WHERE fc_id = '$id'";
                    $results = mysqli_query($connection, $query); 
                    $count = mysqli_num_rows($results); 
                
                    if ($count != 0) {
            ?>
            <table class="container1">
            <tr>
                <th>Flashcard ID</th>
                <th>Flashcard Title</th>
                <th>Teacher Name</th>
                <th>Flashcard Date</th>
                <th>Flashcard Subject</th>
                <th colspan=2>Actions</th>
            </tr>
            
            <?php
            while ($row = mysqli_fetch_assoc($results)) {
            ?>
                <tr>
                    <td><?php echo $row['fc_id']; ?></td>
                    <td><?php echo $row['fc_title']; ?></td>
                    <td><?php echo $row['tcr_fn'] . ' ' . $row['tcr_ln']; ?></td>
                    <td><?php echo $row['fc_dt']; ?></td>
                    <td><?php echo $row['fc_sub']; ?></td>
                    <td><a href="adminEditFlashcard.php?myID=<?php echo $row['fc_id']; ?>"><i class='fas fa-edit'></i> Edit</a></td>
                    <td><a href="adminDeleteFlashcard.php?myID=<?php echo $row['fc_id']; ?>" onclick="return confirmDelete();"><i class='fas fa-trash-alt'></i> Delete</a></td> 
                </tr>
            <?php
            }
            mysqli_close($connection);
            ?>
            </table>
            <?php
                } else {
                    echo 'Search not Found';
                }
            } else {
                $query = "SELECT * FROM flashcard_t INNER JOIN teacher_t ON flashcard_t.tcr_id = teacher_t.tcr_id";
                $results = mysqli_query($connection, $query);
                ?>

                    <table class="container1">
                            <tr>
                            <th>Flashcard ID</th>
                            <th>Flashcard Title</th>
                            <th>Teacher Name</th>
                            <th>Flashcard Date</th>
                            <th>Flashcard Subject</th>
                            <th colspan=2>Actions</th>
                            </tr>
                    
                    <?php
                    while ($row = mysqli_fetch_assoc($results)) {
                    ?>
                            <tr>
                            <td><?php echo $row['fc_id']; ?></td>
                            <td><?php echo $row['fc_title']; ?></td>
                            <td><?php echo $row['tcr_fn'] . ' ' . $row['tcr_ln']; ?></td>
                            <td><?php echo $row['fc_dt']; ?></td>
                            <td><?php echo $row['fc_sub']; ?></td>
                            <td><a href="adminEditFlashcard.php?myID=<?php echo $row['fc_id']; ?>"><i class='fas fa-edit'></i> Edit</a></td>
                            <td><a href="adminDeleteFlashcard.php?myID=<?php echo $row['fc_id']; ?>" onclick="return confirmDelete();"><i class='fas fa-trash-alt'></i> Delete</a></td> 
                            </tr>
                    <?php
                    }
                }
                    ?>
                </table>
                
        </div>
    </section>

</body>
</html>