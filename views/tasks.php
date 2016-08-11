<?php
    session_start();


    if(empty($_SESSION['user'])){
            header("Location: index.php");
        }else{
            include_once '../classes/Db.class.php';
            include_once '../classes/User.class.php';
            include_once '../classes/Feature.class.php';
            $userid = $_SESSION['user'];
            
            if(!empty($_GET['project'])){
                $projectid = (int) $_GET['project'];
                setcookie("projectidvalue", $projectid, time()+3600000);
            }
            
            
            echo $userid;
            if(!empty($_POST))
            {
                try
                {  
                    $task = new Feature();
                    $task->Tasktitle = $_POST['tasktitle'];
                    $task->Projectid = $_COOKIE['projectidvalue'];
                    $task->AddTask();
                    
                }
                catch(exception $e)
                {
                    $error = $e->getMessage();
                }
                
                
                
            }
            $projectidvalue = $_COOKIE['projectidvalue'];
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

        
        try {

            $conn = Db::connect();
            $tasks = $conn->query("SELECT tasktitle FROM tasks WHERE projectid = $projectidvalue;");  
           
            } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

    ?>
<body>
  <form action="" method="post" id="registerform">
     <input type="text" name="tasktitle" class="textfield" placeholder="Task title"><br>
     <input type="hidden" name="projectnum" value="<?php echo $projectid ?>" />
    <button type="submit" class="submitbtn">Add Task</button><br>
  </form>
  <div>
  <?php
        while ($row = $tasks->fetch(PDO::FETCH_NUM)) {
                $task['tasktitle'] = $row[0];
                echo "<br><h3>" . $task['tasktitle'] . "</h3><br>";
        }
    ?>
</div>
<div class="comment-wrapper">
   <h3 class="comment-title">Comments</h3>
    <div class="comment-list">
        <li class="comments-holder" id="_1">
            <div class="user-img">
                <img src="../images/avatar.png" alt="userimg" class="user-img-pic">
            </div>   
            <div class="comment-body">
                <h3 class="username-field">
                Jens De Weerdt
            </h3>
            <div class="comment-text">Thanks for the feedback!
            Thanks for the feedback!
            Thanks for the feedback!
            Thanks for the feedback!
            Thanks for the feedback!
            Thanks for the feedback!
               Thanks for the feedback!
               Thanks for the feedback!
               Thanks for the feedback!
               Thanks for the feedback!
               Thanks for the feedback!
               Thanks for the feedback!
               Thanks for the feedback!
               Thanks for the feedback!
               Thanks for the feedback!
               Thanks for the feedback!
               Thanks for the feedback!
               </div>
                
            </div> 
            <div class="comment-buttons-holder">
                <ul>
                    <li class="delete-btn">
                        X
                    </li>
                </ul>
            </div>
        </li>
        
           
           
           <li class="comments-holder" id="_1">
            <div class="user-img">
                <img src="../images/avatar.png" alt="userimg" class="user-img-pic">
            </div>   
            <div class="comment-body">
            <h3 class="username-field">
                Jens De Weerdt
            </h3>
            <div class="comment-text">Thanks for the feedback!<br>
            </div>
                
            </div> 
            <div class="comment-buttons-holder">
                <ul>
                    <li class="delete-btn">
                        X
                    </li>
                </ul>
            </div>
        </li>
        
        
    </div>
</div>
   
</body>
</html>