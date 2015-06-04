<?php

class UserController extends CI_Controller {
    
      
	
	public function signin() {
		$this->load->view('home/homepage');
	}
	
	
        public function checkLogin(){
			
            $this->form_validation->set_rules('username','username','required');
            $this->form_validation->set_rules('password','password','required|callback_verifyUser');
            
            if($this->form_validation->run()== false){
                $this->load->view('home/homepage');
            }
			else
			{
				//$this->load->view('home/signIn');
                redirect('BoardController');
                return;
            }
			//redirect('BoardController');
        
		}   
		public function logout(){
			
			session_start();
			unset($_SESSION["nome"]);  
			session_destroy();
			redirect('HomeController/homepage');
			
			
		}

        public function verifyUser() {
			
            $name=$this->input->post('username');
            $pass=$this->input->post('password');
            
            $this->load->model('User_Model', 'user');
            //echo $this->user->login($name,$pass);
			//return;
            if($this->user->login($name,$pass)){
                return true;
            }else{
                $this->form_validation->set_message('verifyUser','Incorect password or username.');
                return false;
            }
			
			
        }
        
		public function signup() {
            
            $this->load->view('home/homepage');
        }
        
  public function register(){
       
      $this->load->helper('security');
      
	  $this->form_validation->set_rules('usernameR','usernameR','required|max_length[16]|min_length[4]|callback_usernameR_is_taken');
	  $this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_email_is_taken');
	  $this->form_validation->set_rules('passwordR', 'passwordR', 'required|max_length[16]|min_length[3]');
	   $this->form_validation->set_rules('re-password', 're-password', 'required|matches[passwordR]');
      
	  if($this->form_validation->run()!=true){
          
          $this->load->view("home/homepage");
      }else{
          
          $user=$this->input->post("usernameR");
          $pass=$this->input->post("passwordR");
          $mail=$this->input->post("email");
          
          if(self::createUser($user,$pass,$mail)==true) {
              
              //KORISNIK JE USPESNO DODAT U BAZU  
              $data['usernameR']=$user;
              redirect('BoardController');
              
          }else {
              echo "Izninjavamo se trenutno ne mozemo obraditi vas zahtev,pokusajte ponovo";
          }
                  
      }
  }
  
  
  public function usernameR_is_taken(){
      
	  $name=$this->input->post('usernameR');
      $query="SELECT * FROM user WHERE nickname = \"".$name."\"";
      $arg=array();
      $result = $this->db->query($query,$arg) or die(mysql_error());
      
      If($result->num_rows()>0)
	  {
        $this->form_validation->set_message('usernameR_is_taken','Sorry username <i>'. $name.' </i> is taken');
		return false;
      } else 
	  {
          return TRUE;
      }
  }
      
  
   public function email_is_taken(){
      
      $email=$this->input->post('email');
      $query="SELECT * FROM user WHERE email = \"".$email."\"";
      $arg=array();
      $result = $this->db->query($query,$arg) or die(mysql_error());
      
      If($result->num_rows()>0)
	  {
        $this->form_validation->set_message('email_is_taken','Sorry e-mail <i>'. $email.' </i> is taken');
		return false;
      } else 
	  {
          return TRUE;
      }
      
  }
  
  public function createUser ($user, $pass, $mail){
      
      $this->load->model('User_Model', 'user');
      if ($this->user->dbInsert($user, $pass, $mail) == TRUE) {
            return true;
        } else {
            return false;
        };
		//return true;
  }
  
  public function editUser (){
      
       if(!($_SESSION["ulogovan"]=="yes")){
				redirect('HomeController/homepage');
			};
			$idUser = $_SESSION["idUser"];
			$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
			$result = mysqli_query($link, "SELECT * from user where idUser = ".$idUser.";");	
			$row = mysqli_fetch_assoc($result);
			$imeUser = $row['nickname'];			
            $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'users/edituser', 'idUser'=>$idUser, 'ime'=>$imeUser));
  }
   public function editPost (){
      
       if(!($_SESSION["ulogovan"]=="yes")){
				redirect('HomeController/homepage');
			};
			$idUser = $_SESSION["idUser"];
			$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
			$result = mysqli_query($link, "SELECT * from user where idUser = ".$idUser.";");	
			$row = mysqli_fetch_assoc($result);
			$imeUser = $row['nickname'];			
            $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'users/editpost', 'idUser'=>$idUser, 'ime'=>$imeUser));
  }
  
  
  public function changeMail()
  {
	$this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_email_is_taken');
	if($this->form_validation->run()!=true){
          $idUser = $_SESSION["idUser"];
          $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'users/edituser', 'idUser'=>$idUser));
      }else{
          
          $user = $_SESSION['idUser'];
          $mail=$this->input->post("email");
          
          $this->load->model('User_Model', 'user');
          $this->user->changeMail($user,$mail);

			$idUser = $_SESSION["idUser"];
          $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'users/edituser', 'idUser'=>$idUser));	  
      }
  }
  
  public function changePass()
  {
	$this->form_validation->set_rules('password','password','required|callback_checkPass');
	$this->form_validation->set_rules('new-password', 'new-password', 'required|max_length[16]|min_length[3]');
	$this->form_validation->set_rules('re-password', 're-password', 'required|matches[new-password]');
	
	
	if($this->form_validation->run()!=true){
          $idUser = $_SESSION["idUser"];
          $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'users/edituser', 'idUser'=>$idUser));
      }else{
          
          $user = $_SESSION['idUser'];
          $pass=$this->input->post("new-password");
          
          $this->load->model('User_Model', 'user');
          $this->user->changePass($user,$pass);

			$idUser = $_SESSION["idUser"];
          $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'users/edituser', 'idUser'=>$idUser));	  
      }
	
  }
    public function checkPass()
	{
		$user = $_SESSION['idUser'];
		$pass=$this->input->post("password");
		
		$this->load->model('User_Model', 'user');
            //echo $this->user->login($name,$pass);
			//return;
            if($this->user->checkPass($user,$pass)){
                return true;
            }else{
                $this->form_validation->set_message('checkPass','Incorect password');
                return false;
            }
	}      
}


