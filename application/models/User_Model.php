<?php


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
      		   
		$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
		mysqli_select_db($link, "mydb") or die(mysql_error());
		$result = mysqli_query($link, "select * from user where nickname = \"".$nickname."\"")
               or die(mysql_error());
		
        if($row = mysqli_fetch_assoc($result))
		{
			$idUser=$row['idUser'];
			$pass = $row['password'];
			
			if($pass == $password)
			{
				session_start();
				$_SESSION["idUser"] = $idUser;
				$_SESSION["ulogovan"] = "yes";
				$_SESSION["group"]=0;
				$_SESSION["cur"]=0;
				$_SESSION["druga grupa"] = 0;
				return true;
			}
		}
		return false;
		
    }
	
	public function dbInsert($user, $pass, $email) {
      		   
		//$email=$this->input->post('email');
		$query="INSERT INTO user (nickname, email, link_Photo, is_Admin, note_Color, password) VALUES ( \"".$user."\",  \"".$email."\", '', '0', '1',  \"".$pass."\");";
		$arg=array();
		$result = $this->db->query($query,$arg) or die(mysql_error());
		
		
		/*$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
		mysqli_select_db($link, "mydb") or die(mysql_error());
		$result = mysqli_query($link, " INSERT INTO user (nickname, email, link_Photo, is_Admin, note_Color, password) VALUES ( \"".$user."\",  \"".$email."\", '', '0', '1',  \"".$pass."\");")
               or die(mysql_error());*/
		
        /*if($row = mysqli_fetch_assoc($result))
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
		return false;*/
		return true;
		
    }
	public function checkPass($user,$password) {
      		   
		$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
		mysqli_select_db($link, "mydb") or die(mysql_error());
		$result = mysqli_query($link, "select * from user where idUser = \"".$user."\"")
               or die(mysql_error());
		
        if($row = mysqli_fetch_assoc($result))
		{
			//$idUser=$row['idUser'];
			$pass = $row['password'];
			
			if($pass == $password)
			{
				return true;
			}
		}
		return false;
		
    }
	
	public function changePass($user,$password) {
      		   
		$query="update user set password = \"".$password."\" where idUser = ".$user.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());	
		
    }
	
	public function changeMail($user,$mail) {
      		   
		$query="update user set email = \"".$mail."\" where idUser = ".$user.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());	
		
    }
	
	
}

?>
