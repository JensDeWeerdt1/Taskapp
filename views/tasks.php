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
            
            if(isset($_GET['project'])){
                $projectid = (int) $_GET['project'];
                setcookie("projectidvalue", $projectid, time()+3600000);
            } 
            else{
                $projectid = 0;
            }
            
            if(!empty($_POST))
            {
                try
                {  
                    
                    $task = new Feature();
                    $task->Tasktitle = $_POST['tasktitle'];
                    $task->Projectid = $projectid;
                    $date = mysql_real_escape_string($_POST['date1']);
                    $newdate = date('Y-m-d', strtotime($date));
                    $task->Dateform = $newdate;
                    $task->AddTask();
                     
                    
                }
                catch(exception $e)
                {
                    $error = $e->getMessage();
                }
                
                
                
            }
            if(!empty($_POST))
            {
                try
                {  
                    $project = new Feature();
                    $project->Projectname = $_POST['projectname'];
                    $project->Userid = $_SESSION['user'];
                    $date1 = mysql_real_escape_string($_POST['date2']);
                    $newdate1 = date('Y-m-d', strtotime($date1));
                    $project->Date = $newdate1;
                    $project->Course = $_POST['course'];
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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/overwrite.css">
    <script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Amatic+SC' rel='stylesheet' type='text/css'>
</head>
<?php

        
        try {

            $conn = Db::connect();
            $tasks = $conn->query("SELECT tasktitle, date FROM tasks WHERE projectid = $projectid;");  
            $userdata = $conn->query("SELECT * FROM users WHERE id = $userid;");
            $projects = $conn->query("SELECT projectname,projectid,dateproject FROM projects WHERE userid = $userid;");
            $users = $conn->query("SELECT username FROM users;");
            $course = $conn->query("SELECT * FROM courses;");
            foreach ($userdata as $row) {
                $loggedinuser = $row['username'];
                $profileloc = $row['profile_img'];
            }     
            
        

            } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

    ?>
<body>
 <div class="container">
     <div class="row">
        <div class="span3">
        
        
        <div>
         
          <?php
           echo "<div class='loggedinimg'><img src='$profileloc' alt='avatar logged in user'></div>";
           echo "<div class='loggedinname'><h5>$loggedinuser</h5></div>";
           echo "<h4>Projects</h4>";?>
           <form action="" method="post" id="registerform">
           
           <input type="text" name="projectname" class="textfield" placeholder="Project name"><br>
           <select name="course" >
               <?php 
                    $sql = mysql_query("SELECT username FROM users");
                    while ($row = $course->fetch(PDO::FETCH_NUM)){
                    $row['coursename'] = $row[1];
                    echo "<option value=". $row['coursename'] .">" . $row['coursename'] . "</option>";
                    }
               ?>
           </select>
           <input type="text" name="date2" id="date2" alt="date" class="IP_calendar" title="d/m/Y" placeholder="Deadline">
           <button type="submit" class="btn btn-small btn-success">Add</button><br>
    </form>
          
           <?php
        while ($row = $projects->fetch(PDO::FETCH_NUM)) {
                $project['projectname'] = $row[0];
                $projid = $project['projectid'] = $row[1];
                $project['dateproject'] = $row[2];
                echo "<br><a href='tasks.php?project=" . $project['projectid'] . "'><h5>" . $project['projectname'] . "</h5></a><span class='deadline-text'>Deadline due " . $project['dateproject'] . "</span><br>";
        }  
         
        $projectid = $_COOKIE['projectidvalue'];    
        
       ?>
       </div>
        </div>
         <div class="span6"><!-- --------------------------------------------- !-->
              <form action="" method="post" id="registerform">
                 <input type="text" name="tasktitle" class="textfield" placeholder="Task title"><br>
                 <input type="text" name="date1" id="date1" alt="date" class="IP_calendar" title="d/m/Y" placeholder="Deadline">
                 <input type="hidden" name="projectnum" value="<?php echo $projectid ?>" />
                 
                <button type="submit" class="btn btn-small btn-success">Add Task</button><br>
             </form>
                
              <div>
                <?php
                    while ($row = $tasks->fetch(PDO::FETCH_NUM)) {
                        $task['tasktitle'] = $row[0];
                        $task['date'] = $row[1];
                        echo "<li class='tasks'><h5>" . $task['tasktitle'] . "</h5><span class='deadline-text'>Deadline due " . $task['date'] . "</span></li>";
                    }
                ?>
              </div>
            <div class="comment-wrapper">
                <h4 class="comment-title">Comments</h4>
                <div class="comment-insert">
                    <h3 class="who-says">
                        <span class="says-colour">Says:</span> <?php echo $loggedinuser; ?>
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
                        <?php if($projectid != null){ $comments = Feature::getComments(); } ?>
                        <?php require_once INCLUDES . 'commentbox.php'; ?>
                    </ul>
                </div>
            </div>
            <input type="hidden" id="userid" value="<?php echo $userid; ?>"/>
            <input type="hidden" id="username" value="Jens De Weerdt"/>
        </div>
    
    
    <div class="span3">
        <?php 
            while($row = $users->fetch(PDO::FETCH_ASSOC)) {
            $username = $row['username'];
            echo "<li>" . $username . "</li>";
            }
        ?>
    </div>
    </div>
</div>
</body>
</html>