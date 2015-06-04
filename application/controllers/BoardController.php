<?php



class BoardController extends CI_Controller {
	
	public function index() {
			//session_start();
			if(!($_SESSION["ulogovan"]=="yes")){
				redirect('HomeController/homepage');
			}
			if(isset($_REQUEST["id"]))
			{
				$group = $_GET["id"];
			} 
			else
			{
				$group = 0;
			}
			
			$_SESSION["group"]=$group;
			$idUser=$_SESSION["idUser"];
			$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
			$result = $result = mysqli_query($link, "SELECT * from user where idUser = ".$idUser.";");	
			$row = mysqli_fetch_assoc($result);
			$imeUser = $row['nickname'];
			$group = $_SESSION["group"];
			if($group == 0){
				$result = mysqli_query($link, "SELECT idNote, created_On, text, title, 1 as fav FROM note n WHERE (exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser.")))) and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 1 as fav from Note n, changed_note cn, group_note gn where (n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and cn.is_Hidden = 0) and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT idNote, created_On, text, title, 0 as fav FROM note n WHERE (exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser.")))) and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 0 as fav from Note n, changed_note cn, group_note gn where (n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and cn.is_Hidden = 0) and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") ORDER BY fav desc, created_On desc")
				or die(mysql_error());
				
				
				
				/*
				
				SELECT idNote, created_On, text, title, 1 as fav FROM note n WHERE (exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser.")))) and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 1 as fav from Note n, changed_note cn, group_note gn where (n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and cn.is_Hidden = 0) and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT idNote, created_On, text, title, 0 as fav FROM note n WHERE (exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser.")))) and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 0 as fav from Note n, changed_note cn, group_note gn where (n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and cn.is_Hidden = 0) and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") ORDER BY fav desc, created_On desc
				
				*/
				
				
				
				$_SESSION["group"] = 0;
			}
			else if($group == -1){
				$result = mysqli_query($link, "SELECT idNote, created_On, text, title, 1 as fav FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") union SELECT idNote, created_On, text, title, 0 as fav FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") ORDER BY fav desc, created_On desc ;")
				or die(mysql_error());
				
				/*
				
				SELECT idNote, created_On, text, title, 1 as fav FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") union SELECT idNote, created_On, text, title, 0 as fav FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") ORDER BY fav desc, created_On desc ;
				
				*/
				
				$_SESSION["group"] = -1;
			}
			else
			{
				$result = mysqli_query($link, "SELECT idNote, created_On, text, title, 1 as fav FROM note n WHERE exists (select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group." and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 1 as fav from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and gn.id_Group = ".$group." and cn.is_Hidden = 0 and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT idNote, created_On, text, title, 0 as fav FROM note n WHERE exists (select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group." and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 0 as fav from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and gn.id_Group = ".$group." and cn.is_Hidden = 0 and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") ORDER BY fav desc, created_On desc;")
				or die(mysql_error());
				
				/*
				
				SELECT idNote, created_On, text, title, 1 as fav FROM note n WHERE exists (select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group." and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 1 as fav from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and gn.id_Group = ".$group." and cn.is_Hidden = 0 and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT idNote, created_On, text, title, 0 as fav FROM note n WHERE exists (select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group." and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 0 as fav from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and gn.id_Group = ".$group." and cn.is_Hidden = 0 and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") ORDER BY fav desc, created_On desc;
				
				*/
				
				$_SESSION["group"] = $group;
			}
			
			
			$this->load->model('Group_Model', 'grM');
			
			$grupe = $this->grM->grupe($idUser);
			$users = $this->grM->users($_SESSION["group"]);
			$is_Admin = $this->grM->isAdmin($_SESSION["group"]);
			$this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/container', 'rezultat'=>$result, 'idUser'=>$idUser, 'grupe'=> $grupe, 'ime'=>$imeUser, 'korisnici' => $users, 'admin'=>$is_Admin, 'filter'=>0, 'arg' => ""));
            //$this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/container', 'rezultat'=>$result, 'idUser'=>$idUser));
			//$this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/container', 'rezultat'=>$result, 'idUser'=>$idUser));
			
	}
	
	public function newNote() {
			
			$this->load->helper('security');
      
	  $this->form_validation->set_rules('title','title','required|max_length[45]');
	  $this->form_validation->set_rules('text', 'text', 'required|max_length[400]');
      
	  if($this->form_validation->run()!=true){
          
         redirect('BoardController');
      }
	  else{
			$title=$this->input->post("title");
			$text=$this->input->post("text");
			$user=$_SESSION["idUser"];
			//$mail=$this->input->post("email");
			$this->load->model('Board_Model', 'board');
			$group = $_SESSION["group"];
			if($group == -1)
			{
				$group = 0;
			}
			if ($this->board->dbInsert($user, $title, $text, $group) == TRUE) {
				redirect('BoardController?id='.$_SESSION["group"]);
			} else {
				return false;
			};
		}
			
			
	}
	public function editUser (){
      //$_SESSION["cur"]=$this->input->post("idNote");;
      redirect('UserController/editUser');
		//return true;
  }
	public function hideNote (){
      $note=$this->input->post("idNote");
	  $user = $_SESSION["idUser"];
	  $group = $_SESSION["group"];
	  $this->load->model('Board_Model', 'board');
			if ($this->board->hideNote($user, $note) == TRUE) {
				redirect('BoardController?id='.$group);
			} else {
				redirect('BoardController');
			};
      
		//return true;
  }
  
  
  public function newGroup() {
			
			$this->load->helper('security');
      
	  $this->form_validation->set_rules('title','title','required|max_length[45]');
	  //$this->form_validation->set_rules('text', 'text', 'required|max_length[400]');
      
	  if($this->form_validation->run()!=true){
          
         redirect('BoardController');
      }
	  else{
			$title=$this->input->post("title");
			//$text=$this->input->post("text");
			$user=$_SESSION["idUser"];
			//$mail=$this->input->post("email");
			$this->load->model('Group_Model', 'grM');
			$group = $_SESSION["group"];
			$group = $this->grM->nova($user, $title);
			if ($group != NULL) {
				redirect('BoardController?id='.$group);
			} else {
				return false;
			};
		}
			
			
			
	}
	
	public function leaveGroup() {
			
			 $group=$this->input->post("grupa");
			  $user = $_SESSION["idUser"];
			  
			 $this->load->model('Group_Model', 'grM');
				if ($this->grM->leaveGroup($user, $group) == TRUE) {
					redirect('BoardController');
				} else {
					redirect('BoardController');
				};
			
	}
	
	 public function add_User() {
			
			$this->load->helper('security');
      
	  $this->form_validation->set_rules('nick','nick','required|max_length[15]');
	  //$this->form_validation->set_rules('text', 'text', 'required|max_length[400]');
      
	  if($this->form_validation->run()!=true){
          
         redirect('BoardController?id='.$group);
      }
	  else{
			$nick=$this->input->post("nick");
			//$text=$this->input->post("text");
			$group=$_SESSION["group"];
			//$mail=$this->input->post("email");
			$this->load->model('Group_Model', 'grM');
			$group = $_SESSION["group"];
			if ($this->grM->add_User($group, $nick) == TRUE) {
				redirect('BoardController?id='.$group);
			} else {
				return false;
			};
		}
			
			
			
	}
    
	public function ban_User() {
			
			 $user=$this->input->post("user");
			  $group = $_SESSION["group"];
			  
			 $this->load->model('Group_Model', 'grM');
				if ($this->grM->leaveGroup($user, $group) == TRUE) {
					redirect('BoardController?id='.$group);
				} else {
					redirect('BoardController');
				};
			
	}
	
	
	public function search(){
		
			
	if(!($_SESSION["ulogovan"]=="yes")){
				redirect('HomeController/homepage');
			}
			/*if(isset($_REQUEST["id"]))
			{
				$group = $_GET["id"];
			} 
			else
			{
				$group = 0;
			}*/
			
			//$_SESSION["group"]=$group;
			$idUser=$_SESSION["idUser"];
			$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
			$result = $result = mysqli_query($link, "SELECT * from user where idUser = ".$idUser.";");	
			$row = mysqli_fetch_assoc($result);
			$imeUser = $row['nickname'];
			$group = $_SESSION["group"];
			if($group == 0){
				$result = mysqli_query($link, "SELECT idNote, created_On, text, title, 1 as fav FROM note n WHERE (exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser.")))) and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 1 as fav from Note n, changed_note cn, group_note gn where (n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and cn.is_Hidden = 0) and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT idNote, created_On, text, title, 0 as fav FROM note n WHERE (exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser.")))) and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 0 as fav from Note n, changed_note cn, group_note gn where (n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and cn.is_Hidden = 0) and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") ORDER BY fav desc, created_On desc")
				or die(mysql_error());
				
				$_SESSION["group"] = 0;
			}
			else if($group == -1){
				$result = mysqli_query($link, "SELECT idNote, created_On, text, title, 1 as fav FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") union SELECT idNote, created_On, text, title, 0 as fav FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") ORDER BY fav desc, created_On desc ;")
				or die(mysql_error());
				
				$_SESSION["group"] = -1;
			}
			else
			{
				$result = mysqli_query($link, "SELECT idNote, created_On, text, title, 1 as fav FROM note n WHERE exists (select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group." and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 1 as fav from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and gn.id_Group = ".$group." and cn.is_Hidden = 0 and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT idNote, created_On, text, title, 0 as fav FROM note n WHERE exists (select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group." and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 0 as fav from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and gn.id_Group = ".$group." and cn.is_Hidden = 0 and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") ORDER BY fav desc, created_On desc;")
				or die(mysql_error());
				
				$_SESSION["group"] = $group;
			}
			
			$arg=$this->input->post("arg");
			//if (($arg != "") && ($arg != NULL))
			$this->load->model('Group_Model', 'grM');
			
			$grupe = $this->grM->grupe($idUser);
			$users = $this->grM->users($_SESSION["group"]);
			$is_Admin = $this->grM->isAdmin($_SESSION["group"]);
			if (($arg != "") && ($arg != NULL)){
			$this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/container', 'rezultat'=>$result, 'idUser'=>$idUser, 'grupe'=> $grupe, 'ime'=>$imeUser, 'korisnici' => $users, 'admin'=>$is_Admin, 'filter'=>1, 'arg' => $arg));
			}
			else
			{
				$this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/container', 'rezultat'=>$result, 'idUser'=>$idUser, 'grupe'=> $grupe, 'ime'=>$imeUser, 'korisnici' => $users, 'admin'=>$is_Admin, 'filter'=>0, 'arg' => ""));
			}//$this->load->view('board/container', 'rezultat'=>$result, 'idUser'=>$idUser, 'grupe'=> $grupe, 'ime'=>$imeUser, 'korisnici' => $users, 'admin'=>$is_Admin, 'filter'=>1, 'arg' => $arg);
	
		
		
	}
	
	public function favNote (){
      $note=$this->input->post("idNote");
	  $user = $_SESSION["idUser"];
	  $group = $_SESSION["group"];
	  $this->load->model('Board_Model', 'board');
			if ($this->board->favNote($user, $note) == TRUE) {
				redirect('BoardController?id='.$group);
			} else {
				redirect('BoardController');
			};
      
		//return true;
  }
  public function stranicaEdit (){
      
       if(!($_SESSION["ulogovan"]=="yes")){
				redirect('HomeController/homepage');
			};
			$idUser = $_SESSION["idUser"];
			$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
			$result = mysqli_query($link, "SELECT * from user where idUser = ".$idUser.";");	
			$row = mysqli_fetch_assoc($result);
			$imeUser = $row['nickname'];			
            $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/editpost', 'idUser'=>$idUser, 'ime'=>$imeUser));
  }
	
	
	
	
	
	
	
	
        
       //SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = 1
	   //$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = 1) or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = 1 and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=1)))")
}
?>