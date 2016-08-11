
<?php

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
}

?>