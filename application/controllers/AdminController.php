<?php



class AdminController extends CI_Controller {
	
	public function index() {
			//session_start();
			if(!($_SESSION["ulogovan"]=="yes")){
				redirect('HomeController/homepage');
			}
			if($_SESSION["isAdmin"]==0){
				redirect('BoardController');
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
			if($row['link_Photo'] == NULL)
						{
							$linkSl = "pic10.jpg";
						}
						else
						{
							$linkSl = $row['link_Photo'];
						}
			$group = $_SESSION["group"];
			$linkovi;
			$linkovi['nesto'] = "nesto";
			if(($group==0) || ($group==-1)){
				$result = mysqli_query($link, "select idNote, created_On, text, title, 0 as fav  from note n where exists(select * from group_note gn where gn.idNote = n.idNote)")
				or die(mysql_error());
				
				$result1 = mysqli_query($link, "select idNote, created_On, text, title, 0 as fav  from note n where exists(select * from group_note gn where gn.idNote = n.idNote)")
				or die(mysql_error());
				
				while($row = mysqli_fetch_assoc($result1))
				{
					$notePom = $row['idNote'];
					
					$result2 =  mysqli_query($link, "SELECT * from user u, group_note gn where gn.last_Editor = u.idUser and gn.idNote = ".$notePom.";") or die(mysql_error());
					if($row = mysqli_fetch_assoc($result2))
					{
						if($row['link_Photo'] == NULL)
						{
							$linkovi["'".$notePom."'"] = "pic10.jpg";
						}
						else
						{
							$linkovi["'".$notePom."'"] = $row['link_Photo'];
						}
					}
					else
					{
						$linkovi["'".$notePom."'"] = $linkSl;
					}
				}
				}
				else
				{
					$result = mysqli_query($link, "select idNote, created_On, text, title, 0 as fav  from note n where exists(select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group.")")
					or die(mysql_error());
					
					$result1 = mysqli_query($link, "select idNote, created_On, text, title, 0 as fav  from note n where exists(select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group.")")
					or die(mysql_error());
					
					while($row = mysqli_fetch_assoc($result1))
					{
						$notePom = $row['idNote'];
						
						$result2 =  mysqli_query($link, "SELECT * from user u, group_note gn where gn.last_Editor = u.idUser and gn.idNote = ".$notePom.";") or die(mysql_error());
						if($row = mysqli_fetch_assoc($result2))
						{
							if($row['link_Photo'] == NULL)
							{
								$linkovi["'".$notePom."'"] = "pic10.jpg";
							}
							else
							{
								$linkovi["'".$notePom."'"] = $row['link_Photo'];
							}
						}
						else
						{
							$linkovi["'".$notePom."'"] = $linkSl;
						}
					}
				}
				
				/*
				
				SELECT idNote, created_On, text, title, 1 as fav FROM note n WHERE (exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser.")))) and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 1 as fav from Note n, changed_note cn, group_note gn where (n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and cn.is_Hidden = 0) and exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT idNote, created_On, text, title, 0 as fav FROM note n WHERE (exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser.")))) and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title, 0 as fav from Note n, changed_note cn, group_note gn where (n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and cn.is_Hidden = 0) and not exists (select * from favourite f where f.idNote = n.idNote and f.idUser = ".$idUser.") ORDER BY fav desc, created_On desc
				
				*/
				
				
				
				//$_SESSION["group"] = 0;
			
			
			
			
			$this->load->model('Group_Model', 'grM');
			$nesto = -1;
			$grupe = $this->grM->grupe($nesto);
			$users = $this->grM->users($_SESSION["group"]);
			$is_Admin = 1;
			$this->load->view('templates/page', array('menu'=> 'board/adminToolbar', 'container'=>'board/admincontainer', 'rezultat'=>$result, 'idUser'=>$idUser, 'grupe'=> $grupe, 'ime'=>$imeUser, 'korisnici' => $users, 'admin'=>$is_Admin, 'filter'=>0, 'arg' => "", 'slika'=>$linkSl, 'linkovi'=>$linkovi));
            //$this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/admincontainer', 'rezultat'=>$result, 'idUser'=>$idUser));
			//$this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/admincontainer', 'rezultat'=>$result, 'idUser'=>$idUser));
			
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
				redirect('AdminController?id='.$group);
			} else {
				redirect('AdminController');
			};
      
		//return true;
  }
  
  
 
	
	public function leaveGroup() {
			
			 $group=$this->input->post("grupa");
			  $user = $_SESSION["idUser"];
			  $nesto = -1;
			 $this->load->model('Group_Model', 'grM');
				if ($this->grM->leaveGroup($nesto, $group) == TRUE) {
					redirect('AdminController');
				} else {
					redirect('AdminController');
				};
			
	}
	
	 
    
	public function ban_User() {
			
			  $user=$this->input->post("user");
			  $group = $_SESSION["group"];
			  
			 $this->load->model('Group_Model', 'grM');
				if ($this->grM->leaveGroup($user, $group) == TRUE) {
					redirect('AdminController?id='.$group);
				} else {
					redirect('AdminController');
				};
			
	}
	public function make_Admin() {
			
			  $user=$this->input->post("user");
			  $group = $_SESSION["group"];
			  
			 $this->load->model('Group_Model', 'grM');
				if ($this->grM->makeAdmin($group, $user) == TRUE) {
					redirect('AdminController?id='.$group);
				} else {
					redirect('AdminController');
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
			if($row['link_Photo'] == NULL)
						{
							$linkSl = "pic10.jpg";
						}
						else
						{
							$linkSl = $row['link_Photo'];
						}
			$linkovi;
			$linkovi['nesto'] = "nesto";
			//$linkSl = $row['link_Photo'];
			$group = $_SESSION["group"];
			if(($group==0) || ($group==-1)){
				$result = mysqli_query($link, "select idNote, created_On, text, title, 0 as fav  from note n where exists(select * from group_note gn where gn.idNote = n.idNote)")
				or die(mysql_error());
				
				$result1 = mysqli_query($link, "select idNote, created_On, text, title, 0 as fav  from note n where exists(select * from group_note gn where gn.idNote = n.idNote)")
				or die(mysql_error());
				
				while($row = mysqli_fetch_assoc($result1))
				{
					$notePom = $row['idNote'];
					
					$result2 =  mysqli_query($link, "SELECT * from user u, group_note gn where gn.last_Editor = u.idUser and gn.idNote = ".$notePom.";") or die(mysql_error());
					if($row = mysqli_fetch_assoc($result2))
					{
						if($row['link_Photo'] == NULL)
						{
							$linkovi["'".$notePom."'"] = "pic10.jpg";
						}
						else
						{
							$linkovi["'".$notePom."'"] = $row['link_Photo'];
						}
					}
					else
					{
						$linkovi["'".$notePom."'"] = $linkSl;
					}
				}
				}
			else
				{
					$result = mysqli_query($link, "select idNote, created_On, text, title, 0 as fav  from note n where exists(select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group.")")
					or die(mysql_error());
					
					$result1 = mysqli_query($link, "select idNote, created_On, text, title, 0 as fav  from note n where exists(select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group.")")
					or die(mysql_error());
					
					while($row = mysqli_fetch_assoc($result1))
					{
						$notePom = $row['idNote'];
						
						$result2 =  mysqli_query($link, "SELECT * from user u, group_note gn where gn.last_Editor = u.idUser and gn.idNote = ".$notePom.";") or die(mysql_error());
						if($row = mysqli_fetch_assoc($result2))
						{
							if($row['link_Photo'] == NULL)
							{
								$linkovi["'".$notePom."'"] = "pic10.jpg";
							}
							else
							{
								$linkovi["'".$notePom."'"] = $row['link_Photo'];
							}
						}
						else
						{
							$linkovi["'".$notePom."'"] = $linkSl;
						}
					}
				}
			
			$arg=$this->input->post("arg");
			//if (($arg != "") && ($arg != NULL))
			$this->load->model('Group_Model', 'grM');
			
			$nesto = -1;
			$grupe = $this->grM->grupe($nesto);
			$users = $this->grM->users($_SESSION["group"]);
			$is_Admin = 1;
			if (($arg != "") && ($arg != NULL)){
			$this->load->view('templates/page', array('menu'=> 'board/adminToolbar', 'container'=>'board/admincontainer', 'rezultat'=>$result, 'idUser'=>$idUser, 'grupe'=> $grupe, 'ime'=>$imeUser, 'korisnici' => $users, 'admin'=>$is_Admin, 'filter'=>1, 'arg' => $arg, 'slika'=>$linkSl, 'linkovi'=>$linkovi));
			}
			else
			{
				$this->load->view('templates/page', array('menu'=> 'board/adminToolbar', 'container'=>'board/adminContainer', 'rezultat'=>$result, 'idUser'=>$idUser, 'grupe'=> $grupe, 'ime'=>$imeUser, 'korisnici' => $users, 'admin'=>$is_Admin, 'filter'=>0, 'arg' => "", 'slika'=>$linkSl, 'linkovi'=>$linkovi));
			}//$this->load->view('board/admincontainer', 'rezultat'=>$result, 'idUser'=>$idUser, 'grupe'=> $grupe, 'ime'=>$imeUser, 'korisnici' => $users, 'admin'=>$is_Admin, 'filter'=>1, 'arg' => $arg);
	
		
		
	}
	
	public function favNote (){
      $note=$this->input->post("idNote");
	  $user = $_SESSION["idUser"];
	  $group = $_SESSION["group"];
	  $this->load->model('Board_Model', 'board');
			if ($this->board->favNote($user, $note) == TRUE) {
				redirect('AdminController?id='.$group);
			} else {
				redirect('AdminController');
			};
      
		//return true;
  }
  public function stranicaEdit (){
      
      $note=$this->input->post("idNote");
	  $user = $_SESSION["idUser"];
	  $idUser = $_SESSION["idUser"];
	  $group = $_SESSION["group"];
			$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
			$result = mysqli_query($link, "SELECT * from user where idUser = ".$idUser.";");	
			$row = mysqli_fetch_assoc($result);
			$imeUser = $row['nickname'];
			$this->load->model('Board_Model', 'board');
			$podaci = $this->board->podaciZaEdit($user, $note);
			
            $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/editpost', 'idUser'=>$idUser, 'gruop'=>$group, 'note'=>$note, 'ime'=>$imeUser, 'podaci'=>$podaci));
  }
  
  public function editujNote (){
      
      $idNote=$this->input->post("idNote");
	  $tabela=$this->input->post("tabela");
	  $id_Group=$this->input->post("id_Group");
	  $lock=$this->input->post("lock");
	  $text=$this->input->post("text");
	  
	  
	  $user = $_SESSION["idUser"];
	  $group = $_SESSION["group"];
			
			$this->load->model('Board_Model', 'board');
			if ($this->board->menjajNote($user, $idNote, $tabela, $id_Group, $lock, $text) == TRUE) {
				redirect('AdminController?id='.$group);
			} else {
				redirect('AdminController');
			};
			
           // $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/editpost', 'idUser'=>$idUser, 'gruop'=>$group, 'note'=>$note, 'ime'=>$imeUser, 'podaci'=>$podaci));
  }
	
	
	
	
	
	
	
	
        
       //SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = 1
	   //$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = 1) or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = 1 and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=1)))")
}
?>