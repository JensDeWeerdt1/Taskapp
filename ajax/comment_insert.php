<?php
    
    require_once '../classes/Db.class.php';
    require_once '../classes/User.class.php';
    require_once '../classes/Feature.class.php';
    require_once '../defines.php';
            

    if(isset($_POST['task']) && $_POST['task'] == 'comment_insert'){
        $userid = (int)$_POST['userid'];
        $comment = addslashes(str_replace("\n" , "<br>" , $_POST['comment']));//str_replace zodat je tekst kan schrijven op verschillende lijnen.
        $std = new stdClass();
        $std->user = null;
        $std->comment = null;
        $std->error = false;
        
        
        
        if(class_exists('Feature') && class_exists('User')){
            $userInfo = User::getUser($userid);
            if($userInfo == null){
                //cause some problems
                $std->error = true;
            }
            $commentInfo = Feature::insert($comment , $userid);
            if($commentInfo == null)
            {
                //cause some problems
                $std->error = true;
            }
            
            
            $std->user = $userInfo;
            $std->comment = $commentInfo;
            echo json_encode($std);
        }
        
        
        
    } else{
        header('location: ../views/tasks.php');
    }

?>