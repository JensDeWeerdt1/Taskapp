
<?php

require_once 'User.class.php';

class Feature
	{
        private $m_sProjectname;
        private $m_iUserid;
        private $m_sTasktitle;
        private $m_iProjectId;
        
    
        
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
                
                
                default: echo("Not existing property: " . $p_sProperty);
            }
        }
    
        public function newproject()
        {
            
                $conn = new PDO('mysql:host=localhost;dbname=Taskapp', "root", "");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $data = $conn->query("INSERT INTO projects(projectname, userid) VALUES(" . $conn->quote($this->m_sProjectname) . ", ". $conn->quote($this->m_iUserid) .")");
                header("Location: home.php");
            
		}
    
        public function AddTask()
        {
            
                $conn = new PDO('mysql:host=localhost;dbname=Taskapp', "root", "");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $data = $conn->query("INSERT INTO tasks(tasktitle, projectid) VALUES(" . $conn->quote($this->m_sTasktitle) . ", ". $conn->quote($this->m_iProjectId) .")");
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
    
        public static function update($data){
            
        }
    
        public static function delete($commentId){
            
        }
}

?>