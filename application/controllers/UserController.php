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
              $this->load->view("home/success_signUp",$data);
              
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
  
  public function edituser (){
      
       if(!($_SESSION["ulogovan"]=="yes")){
				redirect('HomeController/homepage');
			}
			$_SESSION["group"]=1;
			$idUser=$_SESSION["idUser"];
			$link = mysqli_connect("localhost", "root", "") or die(mysql_error());
				mysqli_select_db($link, "mydb") or die(mysql_error());
			$group = $_SESSION["group"];
			if($group == 0){
				$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from personal_note pn where pn.idNote = n.idNote AND pn.idUser = ".$idUser.") or exists (select * from group_note gn where gn.idNote = n.idNote and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." ORDER BY created_On desc")
				or die(mysql_error());
			}
			else
			{
				$result = mysqli_query($link, "SELECT * FROM note n WHERE exists (select * from group_note gn where gn.idNote = n.idNote and gn.id_Group = ".$group." and exists (select * from ismember im where im.id_Group = gn.id_Group AND im.id_User = ".$idUser." and not exists (select * from changed_note cn where cn.idNote = gn.idNote AND cn.idUser=".$idUser."))) UNION SELECT n.idNote, cn.text, gn.last_Edited_On, n.title from Note n, changed_note cn, group_note gn where n.idNote = gn.idNote and n.idNote = cn.idNote and cn.idUser = ".$idUser." and gn.id_Group = ".$group." ORDER BY created_On desc")
				or die(mysql_error());
			}
			
            $this->load->view('templates/page', array('menu'=> 'board/toolbar', 'container'=>'users/edituser', 'rezultat'=>$result, 'idUser'=>$idUser));
  }
         
}


