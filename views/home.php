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
    <title>Quiz</title>
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
   </div>
    
</body>
</html>