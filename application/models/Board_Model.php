<?php


class Board_Model extends CI_Model {
    //put your code here
	//public $link = NULL;
    function __construct() {
        //$this->load->database();
		/*$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
        mysqli_select_db($link, "mydb") or die(mysql_error());*/
        parent::__construct();
    }
    
    /*public function getData() {
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
				return true;
			}
		}
		return false;
		
    }
	
	public function dbInsert($user, $pass, $email) {
      		   
		$email=$this->input->post('email');
		$query="INSERT INTO user (nickname, email, link_Photo, is_Admin, note_Color, password) VALUES ( \"".$user."\",  \"".$email."\", '', '0', '1',  \"".$pass."\");";
		$arg=array();
		$result = $this->db->query($query,$arg) or die(mysql_error());
		
		
		
		return true;
		
    }*/
	public function dbInsert($user, $title, $text, $group) {
      		   
		$email=$this->input->post('email');
		/* $post_data = array(
        'id'            => '',
        'user_id'   =>  '11330',
        'content'   =>  $this->input->post('poster_textarea'),
        'date_time' => date("Y-m-d H:i:s"),
        'status'        =>  '1'
		);
		$this->db->insert('posts',$post_data);
		return $this->db->insert_id();
		*/
		$post_data = array(
        'idNote'            => NULL,
        'text' => $text,
        'created_On' => date("Y-m-d H:i:s"),
        'title'        =>  $title
		);
		$this->db->insert('note',$post_data);
		$idNote = $this->db->insert_id();
		
		if($group == 0)
		{
			$query="INSERT INTO personal_note (idNote, idUser) VALUES ( \"".$idNote."\",  \"".$user."\");";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
		}
		else
		{
			$new_data = array(
			'idNote'            => $idNote,
			'last_Edited_on' => date("Y-m-d H:i:s"),
			'last_Editor'        =>  $user,
			'is_Locked'        =>  0,
			'id_Group'        =>  $group
			);
			$this->db->insert('group_note',$new_data);
			/*$query="INSERT INTO group_note (idNote, last_Edited_on, last_Editor,is_Locked,id_Group) VALUES ( ".$idNote.",  ".$post_data['created_On'].", $user, 0, ".$idGroup.");";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());*/
		}
		/*$query="INSERT INTO user (nickname, email, link_Photo, is_Admin, note_Color, password) VALUES ( \"".$user."\",  \"".$email."\", '', '0', '1',  \"".$pass."\");";
		$arg=array();
		$result = $this->db->query($query,$arg) or die(mysql_error());*/
		
		
		
		return true;
		
    }
	
	public function hideNote($user, $note) 
	{
      	
		$query="select * from personal_note where idNote = ".$note." and idUser = ".$user.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
		
        if($result->num_rows()>0)
		{
			$query="delete from personal_note where idNote = ".$note.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
			
			$query="delete from note where idNote = ".$note;
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
			
			return true;
		}
		
		$query="select * from changed_note where idNote = ".$note." and idUser = ".$user.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
		
		 if($result->num_rows()>0)
		{
			$query="update changed_note set is_Hidden = 1 where idNote = ".$note." and idUser = ".$user.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
			 return true;
		}
		
		$query="select * from group_note where idNote = ".$note;
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
		
		 if($result->num_rows()>0)
		{
			$query="INSERT INTO changed_note (idNote, idUser, text, is_Hidden) VALUES (".$note.", ".$user.", \" \", 1);";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
			 return true;
		}
		
		return false;	
		
    }
	
	public function favNote($user, $note) 
	{
      	
		$query="select * from favourite where idNote = ".$note." and idUser = ".$user.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
		
        if($result->num_rows()>0)
		{
			$query="delete from favourite where idNote = ".$note." and idUser = ".$user.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());			
			return true;
		}
		else
		{
			$query="insert into favourite (idNote, idUser) values (".$note.", ".$user.");";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());			
			return true;
		}
		return false;	
		
    }
	
	public function podaciZaEdit($user, $note) 
	{
      	$podaci = array(
			'idNote'            => $note,
			'tabela' => 0,
			'title'        =>  "nesto",
			'tekst'        =>  "nesto",
			'id_Group'        =>  0,
			'lock'        =>  0
			); 
			$link = mysqli_connect("eu-cdbr-azure-west-c.cloudapp.net", "b73d510bed34e9", "750055ad") or die(mysql_error());
				mysqli_select_db($link, "CodeIgnAMqTCttrw") or die(mysql_error());
			$query="select * from personal_note where idNote = ".$note." and idUser = ".$user.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
		
        if($result->num_rows()>0)
		{
			
			$result = mysqli_query($link, "select * from note where idNote = ".$note.";")or die(mysql_error());	
			$row = mysqli_fetch_assoc($result);
			
			$podaci['tabela'] = 0;
			$podaci['title'] = $row['title'];
			$podaci['text'] = $row['text'];
			$podaci['idGroup'] = 0;
			$podaci['lock'] = 0;
			
			mysqli_close($link);
			return $podaci;
		}
		
		$query="select * from changed_note where idNote = ".$note." and idUser = ".$user.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
		
		 if($result->num_rows()>0)
		{
			$result = mysqli_query($link, "select * from changed_note where idNote = ".$note." and idUser = ".$user.";")or die(mysql_error());
			$row = mysqli_fetch_assoc($result);
			$podaci['text'] = $row['text'];
			
			$result = mysqli_query($link, "select * from note where idNote = ".$note.";")or die(mysql_error());	
			$row = mysqli_fetch_assoc($result);
			
			$podaci['tabela'] = -1;
			$podaci['title'] = $row['title'];
			
			$podaci['idGroup'] = 0;
			$podaci['lock'] = 0;
			
			mysqli_close($link);
			
			return $podaci;
		}
		
		$query="select * from group_note where idNote = ".$note;
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
		
		 if($result->num_rows()>0)
		{
			
			$result = mysqli_query($link, "select * from group_note where idNote = ".$note.";")or die(mysql_error());
			$row = mysqli_fetch_assoc($result);
			$podaci['lock'] = $row['is_Locked'];
			$podaci['idGroup'] = $row['id_Group'];
			
			$result = mysqli_query($link, "select * from note where idNote = ".$note.";")or die(mysql_error());	
			$row = mysqli_fetch_assoc($result);
			
			$podaci['tabela'] = 1;
			$podaci['title'] = $row['title'];
			$podaci['text'] = $row['text'];
			
			
			
			mysqli_close($link);
			
			return $podaci;
			
			/*$query="INSERT INTO changed_note (idNote, idUser, text, is_Hidden) VALUES (".$note.", ".$user.", \" \", 1);";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
			 return true;*/
		}
		mysqli_close($link);
		return false;		
		
    }
	
	public function menjajNote($user, $idNote, $tabela, $id_Group, $lock, $text) 
	{
	$link = mysqli_connect("eu-cdbr-azure-west-c.cloudapp.net", "b73d510bed34e9", "750055ad") or die(mysql_error());
				mysqli_select_db($link, "CodeIgnAMqTCttrw") or die(mysql_error());
      	if($tabela == 0)
		{
			$result = mysqli_query($link, "update note set text = \"".$text."\" where idNote = ".$idNote.";")or die(mysql_error());
			$result = mysqli_query($link, "update note set created_On = NOW() where idNote = ".$idNote.";")or die(mysql_error());
			//$row = mysqli_fetch_assoc($result);
			mysqli_close($link);
			return true;
		}
		else if($tabela == -1)
		{
			$result = mysqli_query($link, "update changed_note set text = \"".$text."\" where idNote = ".$idNote." and idUser = ".$user.";")or die(mysql_error());
			//$row = mysqli_fetch_assoc($result);
			mysqli_close($link);
			return true;
		}
		else
		{
			if($lock == 0)
			{
				$result = mysqli_query($link, "update note set text = \"".$text."\" where idNote = ".$idNote.";")or die(mysql_error());
				$datum = date("Y-m-d H:i:s");
				$result = mysqli_query($link, "update group_note set last_Edited_on = NOW() where idNote = ".$idNote.";")or die(mysql_error());
				$result = mysqli_query($link, "update group_note set last_Editor = ".$user." where idNote = ".$idNote.";")or die(mysql_error());
				mysqli_close($link);
				return true;
			}
			else
			{
				$result = mysqli_query($link, "INSERT INTO changed_note (idNote, idUser, text, is_Hidden) VALUES (".$idNote.", ".$user.", \"".$text."\", '0');");
				mysqli_close($link);
				return true;
			}
		}
		mysqli_close($link);
			return false;
    }
	
	
}
		




?>
