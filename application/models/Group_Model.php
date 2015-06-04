<?php


class Group_Model extends CI_Model {
    //put your code here
	//public $link = NULL;
    function __construct() {
        //$this->load->database();
		/*$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
        mysqli_select_db($link, "mydb") or die(mysql_error());*/
        parent::__construct();
    }
    
    public function grupe($idUser) {
        $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
		
		$result = mysqli_query($link, "SELECT * FROM `group` g WHERE exists (select * from ismember im where im.id_User = ".$idUser." and g.idGroup = im.id_Group) ;")
				or die(mysql_error());
		
		return $result;
    }
	
	public function users($idGroup) {
        $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
		
		$result = mysqli_query($link, "SELECT * FROM user u WHERE exists (select * from ismember im where im.id_Group = ".$idGroup." and u.idUser = im.id_User and u.idUser <> ".$_SESSION["idUser"].") ;")
				or die(mysql_error());
		
		return $result;
    }
	public function isAdmin($idGroup) {
        $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
		
		$result = mysqli_query($link, "SELECT * FROM ismember  WHERE id_Group = ".$idGroup." and id_User = ".$_SESSION["idUser"]." ;")
				or die(mysql_error());
		if($row = mysqli_fetch_assoc($result))
		{
			$is_Admin = $row["is_Admin"];
			return $is_Admin;
			
			
		}
		return 0;
    }
	
	public function nova($user, $title) {
      		   
		$email=$this->input->post('email');
		
		$post_data = array(
        'idGroup'  => '',
		'name' =>  $title,
        'id_Creator' => $user,
        'created_On' => date("Y-m-d H:i:s"),
		);
		$this->db->insert('group',$post_data);
		$idGroup = $this->db->insert_id();
		
		$query="INSERT INTO ismember (id_Group, id_User, is_Admin, joined_On) VALUES ( \"".$idGroup."\",  \"".$user."\",  1,  \"".date("Y-m-d H:i:s")."\");";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());		
		
		
		
		return $idGroup;
		
    }
	
	public function leaveGroup($user, $group) 
	{
      	
		$query="DELETE changed_note
				FROM changed_note
				INNER JOIN group_note
				ON changed_note.idNote = group_note.idNote AND 
				group_note.id_Group = ".$group." AND 
				changed_note.idUser = ".$user.";";
			//delete from changed_note cn where cn.idUser = 1 and cn.idNote in (select tren_tabela.idNote from (select idNote from group_note gn where gn.id_Group = 6) tren_tabela);
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
		
		$query="delete from ismember where id_Group = ".$group." and id_User = ".$user.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
			
		
		$query="select * from ismember where id_Group = ".$group.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
		
        if($result->num_rows()==0)
		{
			$query="DELETE note FROM note INNER JOIN group_note ON note.idNote = group_note.idNote AND group_note.id_Group = ".$group.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
			
			$query="delete from group_note where id_Group = ".$group.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
			
			$query="delete from `group` where idGroup = ".$group.";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
			
			
			return true;
		}
		
		
		
		return true;	
		
    }
	
	public function add_User($idGroup, $user) {
        $link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
				
		$result = mysqli_query($link, "select * from user where nickname = \"".$user."\"")
				or die(mysql_error());
		if($row = mysqli_fetch_assoc($result))
		{
			$idUser = $row["idUser"];
			$resultat = mysqli_query($link, "INSERT INTO ismember (id_Group, id_User, is_Admin, joined_On) VALUES ( \"".$idGroup."\",  \"".$idUser."\",  0,  \"".date("Y-m-d H:i:s")."\");")
				or die(mysql_error());
			
			
		}
		
		
		return true;
    }
	
	
	
	
}

?>
