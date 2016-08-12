<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Taskapp/defines.php';

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
    <script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Amatic+SC' rel='stylesheet' type='text/css'>
</head>
<?php

        
        try {

            $conn = Db::connect();
            $tasks = $conn->query("SELECT tasktitle FROM tasks WHERE projectid = $projectidvalue;");  
            $userdata = $conn->query("SELECT * FROM users WHERE id = $userid;");
            foreach ($userdata as $row) {
                $name = $row['username'];
            }         

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
    <div class="comment-insert">
        <h3 class="who-says">
            <span class="says-colour">Says:</span> <?php echo $name; ?>
        </h3>
        <div class="comment-insert-container">
            <textarea id="comment-post-text" class="comment-insert-text"></textarea>
        </div>
        <div class="comment-post-btn-wrapper" id="commentbtn">
            Comment
        </div>
    </div>
    <div class="comment-list">
        <ul class=comments-holder-ul>
            <?php $comments = Feature::getComments(); ?>
            <?php require_once INCLUDES . 'commentbox.php'; ?>
        </ul>
    </div>
</div>
<input type="hidden" id="userid" value="<?php echo $userid; ?>"/>
<input type="hidden" id="username" value="Jens De Weerdt"/>
</body>
</html>