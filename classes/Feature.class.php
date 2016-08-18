
<?php

require_once 'User.class.php';

class Feature
	{
        private $m_sProjectname;
        private $m_iUserid;
        private $m_sTasktitle;
        private $m_iProjectId;
        private $m_sDate;
        private $m_sDate1;
        private $m_sCourse;
        private $m_sCoursename;
        
    
        
        public function __set($p_sProperty, $p_vValue)
        {
            switch($p_sProperty)
            {

                case 'Id':
                    $this->m_iId = $p_vValue;
                break;
                    
                case "Projectname":
                    if(!empty($p_vValue))
                    {
                        $this->m_sProjectname = $p_vValue;
                    }
                    else
                    {
                        throw new Exception("Projectnaam mag niet leeg zijn!");
                    }
                break;
                case "Userid":
                    $this->m_iUserid = $p_vValue;
                break;
                    case "Tasktitle":
                    if(!empty($p_vValue))
                    {
                        $this->m_sTasktitle = $p_vValue;
                    }
                    else
                    {
                        throw new Exception("Projectnaam mag niet leeg zijn!");
                    }
                break;
                case "Projectid":
                    $this->m_iProjectId = $p_vValue;
                break;
                case "Dateform":
                    $this->m_sDate = $p_vValue;
                break;
                case "Date":
                    $this->m_sDate1 = $p_vValue;
                break;
                case "Course":
                    $this->m_sCourse = $p_vValue;
                break;
                case "Coursename":
                    $this->m_sCoursename = $p_vValue;
                break;
                default: echo("Not existing property: " . $p_sProperty);
            } 
        }

        public function __get($p_sProperty)
        {
            switch($p_sProperty)
            {
                case 'Id':
                    return($this->m_iId);
                break;
                case 'Projectname':
                    return($this->m_sProjectname);
                break;
                case 'Userid':
                    return($this->m_iUserid);
                break;
                case 'Tasktitle':
                    return($this->m_sTasktitle);
                break;
                case 'Projectid':
                    return($this->m_iProjectId);
                break;
                case 'Dateform':
                    return($this->m_sDate);
                break;
                case 'Date':
                    return($this->m_sDate1);
                break;
                case 'Course':
                    return($this->m_sCourse);
                break;
                case 'Coursename':
                    return($this->m_sCoursename);
                break;
                
                
                default: echo("Not existing property: " . $p_sProperty);
            }
        }
    
        public function newproject()
        {
            
                $conn = new PDO('mysql:host=localhost;dbname=Taskapp', "root", "");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $data = $conn->query("INSERT INTO projects(projectname, userid, dateproject, course) VALUES(" . $conn->quote($this->m_sProjectname) . ", ". $conn->quote($this->m_iUserid) . ", ". $conn->quote($this->m_sDate1) . ", " . $conn->quote($this->m_sCourse) .")");
                header("Location: tasks.php");
            
		}
    
        public function newcourse()
        {
            
                $conn = new PDO('mysql:host=localhost;dbname=Taskapp', "root", "");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $data = $conn->query("INSERT INTO courses(coursename) VALUES(" . $conn->quote($this->m_sCoursename) . ")");
                header("Location: tasks.php");
            
		}
    
        public function deletecourse($deleteid)
        {
            
                $conn = new PDO('mysql:host=localhost;dbname=Taskapp', "root", "");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $data = $conn->query("DELETE from courses WHERE courseid = $deleteid");
                header("Location: tasks.php");
            
		}
    
        public function makeadmin($useradminid)
        {
            
                $conn = new PDO('mysql:host=localhost;dbname=Taskapp', "root", "");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $data = $conn->query("UPDATE users SET Admin = 1 WHERE id=$useradminid");
                header("Location: tasks.php");
            
		}
    
        public function AddTask()
        {
            
                $conn = new PDO('mysql:host=localhost;dbname=Taskapp', "root", "");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $data = $conn->query("INSERT INTO tasks(tasktitle, projectid, date) VALUES(" . $conn->quote($this->m_sTasktitle) . ", ". $conn->quote($this->m_iProjectId) . ", ". $conn->quote($this->m_sDate) .")");
                header("Location: tasks.php");
            
		}
    
        public static function getComments(){
            $output = array();
            $sql = "select * from comments order by comment_id desc";
            $query = mysql_query($sql);
            if($query){
                if(mysql_num_rows($query) > 0)
                {
                    while($row = mysql_fetch_object($query)){
                        $output[] = $row;
                    }
                }
            }
            return $output;
        }
        //return a stdClass Object from database
        public static function insert($comment_txt , $userid){
            //insert data in database
            
            $comment_txt = addslashes($comment_txt);
            $sql = "INSERT INTO comments(comment_id, comment, userid) values('' , '$comment_txt' , $userid)";
            $query = mysql_query($sql);
            
            
            
            if($query){
                $insert_id = mysql_insert_id();
                $std = new stdClass();
                $std->comment_id = $insert_id;
                $std->comment = $comment_txt;
                $std->userid = (int)$userid;
                return $std;
            }
            
            return null;
            
            
        }
    
        public static function delete($commentId){
            $sql = "delete from comments where comment_id=$commentId";
            $query = mysql_query($sql);
            if($query){
                return true;
            }
            return null;
        }
}

?>