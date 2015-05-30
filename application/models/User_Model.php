<?php

/**
 * Description of MUser
 *
 * @author Bogdana
 */
class User_Model extends CI_Model {
    //put your code here
	//public $link = NULL;
    function __construct() {
        //$this->load->database();
		/*$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
        mysqli_select_db($link, "mydb") or die(mysql_error());*/
        parent::__construct();
    }
    
    public function getData() {
        //$this->db->like('nickname', $nickname, 'both');
        //return $this->db->get('user')->result();
		$result = mysqli_query($link, "select * from user where username = ".$nickname)
                or die(mysql_error());
				
		
    }
    
    public function exist($nickname) {
        $this->db->select('idUser');
        $this->db->from('user');
        $this->db->where('nickname',$nickname);
        
        $query = $this->db->get();
        
        if($query->num_rows() == 1){    
            foreach ($query->result() as $row) {
                return $row->idUser;
            }
        } else {     
            return '-1';
        }
    }
    
    public function login($nickname,$password) {
        /*$this->db->select('nickname,password');
        $this->db->from('user');
        $this->db->where('nickname',$nickname);
        $this->db->where('password',$password);*/
        
		
			   
		$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
		mysqli_select_db($link, "mydb") or die(mysql_error());
		$result = mysqli_query($link, "select * from user where nickname = \"".$nickname."\"")
               or die(mysql_error());
		
        //$query=$this->db->get();
        if($row = mysqli_fetch_assoc($result))
		{
			$idUser=$row['idUser'];
			$pass = $row['password'];
			
			if($pass == $password)
			{
				session_start();
				$_SESSION["idUser"] = $idUser;
				$_SESSION["ulogovan"] = true;
				return true;
			}
		}
		return false;
		
        /*if($query->num_rows() == 1) { 
            return true;
        } else {        
            return false;
        }*/
    }
}

?>
