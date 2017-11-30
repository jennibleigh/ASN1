<?php
    require_once('database.php');

    // Get semesterID
    $semesterID=$_POST['semesterID'];
    $semesterName = $_POST['semesterName'];
    $subjectID=$_POST['subjectID'];
    $subjectName = $_POST['subjectName'];
    $username = 'jennibleigh';
    $password = '';
    
    $db = mysqli_connect('localhost', $username, $password, 'CSU_Info_DB');
    
    
    $query = "SELECT class.CRN, class.className, class.courseDescription, class.sectionOffered, class.courseDay, 
    class.courseTime, class.courseLocation, instructor.lastName, 
    instructor.firstName FROM class INNER JOIN instructor ON class.instructorID = instructor.instructorID WHERE semesterID =? AND subjectID=?";
    
 $stmt = $db->prepare($query);
 $stmt->bind_param('ii', $semesterID, $subjectID);
 $stmt->execute();
 $stmt->store_result();
 $stmt->bind_result($CRN, $courseName, $courseDescription, $sectionOffered, $courseDay, $courseTime, $courseLocation,
 $lastName, $firstName);
 
 echo($CRN);
 

    

?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>CSU Class Registration</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
    <div id="page">

    <div id="header">
        <h1>Class Availability</h1>
    </div>

    <div id="main">
`
        <h1>Class Availability</h1>
        <div>
            <form action="index.php" method="post">
            <select name="semesterID">
                <option value="1111">Fall</option>
                <option value="2222">Summer</option>
                <option value="9999">Spring</option>
            </select>
            
        
            <select name="subjectID">
                <option value="1234">Accounting</option>
                <option value="4321">Biology</option>
                <option value="4444">Math</option>
            </select>
            <input type="submit" name = "submit">
            </form>
            
            
        </div>
            <h2><?php echo $semesterName; ?></h2>
            <?php
             echo("
            <table>
            <tr><th>CRN</th><th>Course Name</th><th>Course description</th><th>Section Offered</th><th>Day</th><th>Time</th><th>Location</th><th>Last Name</th><th>First Name</th></tr>");
             while ($stmt->fetch())
              {
                  echo("
            <tr><td>" . $CRN . "</td><td>" . $courseName . "</td><td>" . $courseDescription . "</td><td>" . $sectionOffered . "</td><td>" . $courseDay . "</td><td>" . $courseTime . "</td><td>" . $courseLocation . "</td><td>" .
 $lastName . "</td><td>" . $firstName . "</td></tr>
     
            ");
            }
            echo("</table>");
            $stmt->close();
            ?>
            
               
    </div><!-- end page -->
</body>
</html>