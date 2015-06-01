<?php



class BoardController extends CI_Controller {
	
	public function index() {
			//session_start();
			if(!($_SESSION["ulogovan"]=="yes")){
				redirect('HomeController/homepage');
			}
			$_SESSION["group"]=0;
			$idUser=$_SESSION["idUser"];
			$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
			$group = $_SESSION["group"];
			if($group == 0){
				$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and cn.is_Hidden = 0 ORDER BY created_On desc")
				or die(mysql_error());
			}
			else
			{
				$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group." and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and gn.id_Group = ".$group." and cn.is_Hidden = 0 ORDER BY created_On desc")
				or die(mysql_error());
			}
			
            $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/container', 'rezultat'=>$result, 'idUser'=>$idUser));
			
	}
	
	public function newNote() {
			//session_start();
			$title=$this->input->post("title");
			$text=$this->input->post("text");
			$user=$_SESSION["idUser"];
			//$mail=$this->input->post("email");
			$this->load->model('Board_Model', 'board');
			$group = $_SESSION["group"];
			if ($this->board->dbInsert($user, $title, $text, $group) == TRUE) {
				redirect('BoardController');
			} else {
				return false;
			};
			
			/*$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
				
				$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." ORDER BY created_On desc")
				or die(mysql_error());
			
            $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/container', 'rezultat'=>$result, 'idUser'=>$idUser));*/
			
	}
	public function editUser (){
      $_SESSION["cur"]=$this->input->post("idNote");;
      //redirect('UserController/editUser');
		//return true;
  }
	public function hideNote (){
      $note=$this->input->post("idNote");
	  $user = $_SESSION["idUser"];
	  
	  $this->load->model('Board_Model', 'board');
			if ($this->board->hideNote($user, $note) == TRUE) {
				redirect('BoardController');
			} else {
				redirect('UserController/editUser');
			};
      redirect('UserController/editUser');
		//return true;
  }
        
       //SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = 1
	   //$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = 1) or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = 1 and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=1)))")
}
?>