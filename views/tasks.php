<?php
    session_start();

    if(empty($_SESSION['user'])){
            header("Location: index.php");
        }else{
            include_once '../classes/Db.class.php';
            include_once '../classes/User.class.php';
            include_once '../classes/Feature.class.php';
            $userid = $_SESSION['user'];
            echo $userid;
            if(!empty($_POST))
            {
                try
                {  
                    $project = new Feature();
                    $project->Projectname = $_POST['projectname'];
                    $project->Userid = $_SESSION['user'];
                    $project->newproject();
                    
                }
                catch(exception $e)
                {
                    $error = $e->getMessage();
                }
            }
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
<body>
   <form action="" method="post" id="registerform">
    <label id="login1" for="projectname">Project name</label><br>
    <input type="text" name="projectname" class="textfield" placeholder="Project name"><br>
    <button type="submit" class="submitbtn">Add</button><br>
    </form>
</body>
</html>