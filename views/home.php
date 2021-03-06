<?php
    session_start();

    if(empty($_SESSION['user'])){
            header("Location: index.php");
        }else{
            include_once '../classes/Db.class.php';
            include_once '../classes/User.class.php';
            $userid = $_SESSION['user'];
        }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Taskapp</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Amatic+SC' rel='stylesheet' type='text/css'>
</head>
    <?php

        //CHANGE TO FUNCTION IN USER CLASS
        try {

            $conn = Db::connect();
            $userdata = $conn->query("SELECT * FROM users WHERE id = $userid;"); 
            $projects = $conn->query("SELECT projectname,projectid FROM projects WHERE userid = $userid;"); 

            foreach ($userdata as $row) {
                $name = $row['firstname'] . " " . $row['lastname'];
            }
            
            } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

    ?>
<body>
        
   
   <div>
       <h1><?php echo $name; ?></h1>
       <a href="projects.php">Add project</a>
   </div>
   <div>
      <?php
        while ($row = $projects->fetch(PDO::FETCH_NUM)) {
                $project['projectname'] = $row[0];
                $projid = $project['projectid'] = $row[1];
                echo "<br><a href='tasks.php?project=" . $project['projectid'] . "'><h3>" . $project['projectname'] . "</h3></a><br>";
        }
       ?>
   </div>
   
   
    
</body>
</html>