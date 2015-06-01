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
				$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and cn.is_Hidden = 0 ORDER BY created_On desc")
				or die(mysql_error());
				
				$_SESSION["group"] = 0;
			}
			else if($group == -1){
				$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") ORDER BY created_On desc ;")
				or die(mysql_error());
				
				$_SESSION["group"] = 0;
			}
			else
			{
				$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group." and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and gn.id_Group = ".$group." and cn.is_Hidden = 0 ORDER BY created_On desc")
				or die(mysql_error());
				
				$_SESSION["group"] = $group;
			}
			
			
			$this->load->model('Group_Model', 'grM');
			
			$grupe = $this->grM->grupe($idUser);
			$users = $this->grM->users($_SESSION["group"]);
			$is_Admin = $this->grM->isAdmin($_SESSION["group"]);
			$this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/container', 'rezultat'=>$result, 'idUser'=>$idUser, 'grupe'=> $grupe, 'ime'=>$imeUser, 'korisnici' => $users, 'admin'=>$is_Admin));
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
			if ($this->board->dbInsert($user, $title, $text, $group) == TRUE) {
				redirect('BoardController');
			} else {
				return false;
			};
		}
			
			/*$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
				
				$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." ORDER BY created_On desc")
				or die(mysql_error());
			
            $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'board/container', 'rezultat'=>$result, 'idUser'=>$idUser));*/
			
	}
	public function editUser (){
      //$_SESSION["cur"]=$this->input->post("idNote");;
      redirect('UserController/editUser');
		//return true;
  }
	public function hideNote (){
      $note=$this->input->post("idNote");
	  $user = $_SESSION["idUser"];
	  
	  $this->load->model('Board_Model', 'board');
			if ($this->board->hideNote($user, $note) == TRUE) {
				redirect('BoardController');
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
			if ($this->grM->nova($user, $title) == TRUE) {
				redirect('BoardController');
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
          
         redirect('BoardController');
      }
	  else{
			$nick=$this->input->post("nick");
			//$text=$this->input->post("text");
			$group=$_SESSION["group"];
			//$mail=$this->input->post("email");
			$this->load->model('Group_Model', 'grM');
			$group = $_SESSION["group"];
			if ($this->grM->add_User($group, $nick) == TRUE) {
				redirect('BoardController');
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
					redirect('BoardController');
				} else {
					redirect('BoardController');
				};
			
	}
	
	
	public function search(){
		
		
		$this->form_validation->set_rules('title','title','required|max_length[45]');
		$title=$this->input->post("title");
		
	  if(isset($_POST['submit'])){ 
	  if(isset($_GET['go'])){ 
	  if(preg_match("/^[  a-zA-Z]+/", $_POST['name'])){ 
	  $name=$_POST['name']; 
	  //connect  to the database
				
	  $db=mysql_connect  ("localhost", "root",  "") or die ('Ne mogu da se konektujem: ' . mysql_error()); 
	//-select  the database to use 
	$mydb=mysql_select_db($db,"mydb")or die(mysql_error()); 
	  //-query  the database table 
	  $sql="SELECT  idNote, text, created_On, title FROM note WHERE text LIKE '%" . $name .  "%' OR title LIKE '%" . $name ."%'"; 
	  //-run  the query against the mysql query function 
	  $result=mysql_query($sql); 
	  //-create  while loop and loop through result set 
	  while($row=mysql_fetch_array($result)){ 
	          $text  =$row['text']; 
	          $created_On=$row['created_On']; 
	          $title=$row['title']; 
			  $id=$rowp['idNote'];
	  //-display the result of the array 
	  echo "<ul>\n"; 
	  echo "<li>" . "<p>"   .$text . " " . $title .  "</p></li>\n"; 
	  echo "</ul>"; 
	} 
	  } 
	  else{ 
	  echo  "<p>Please enter a search query</p>"; 
	  } 
	  }  else{ echo  "<p>123</p>";} 
	  } else{   echo  "<p>1234</p>";} 
		
		
	}
	
	
	
	
	
	
	
	
        
       //SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = 1
	   //$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = 1) or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = 1 and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=1)))")
}
?>