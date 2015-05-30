<?php

// autor Dusan Spasojevic

class RegisterController extends CI_Controller {
    
  public function signup() {
            
            $this->load->view('home/signUp');
        }
        
  public function register(){
       
      $this->load->helper('security');
      
	  $this->form_validation->set_rules('username','username','required|max_length[16]|min_length[4]|callback_username_is_taken');
	  $this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_email_is_taken');
	  $this->form_validation->set_rules('password', 'password', 'required|max_length[16]|min_length[3]');
	   $this->form_validation->set_rules('re-password', 're-password', 'required|matches[password]');
      
	  if($this->form_validation->run()!=true){
          
          $this->load->view("home/signUp");
      }else{
          
          $user=$this->input->post("username");
          $pass=$this->input->post("password");
          $mail=$this->input->post("email");
          
          if(self::createUser($user,$pass,$mail)==true) {
              
              //KORISNIK JE USPESNO DODAT U BAZU  
              $data['username']=$user;
              $this->load->view("home/success_signUp",$data);
              
          }else {
              echo "Izninjavamo se trenutno ne mozemo obraditi vas zahtev,pokusajte ponovo";
          }
                  
      }
  }
  
  
  public function username_is_taken(){
      
	  $name=$this->input->post('username');
      $query="SELECT * FROM user WHERE nickname = \"".$name."\"";
      $arg=array();
      $result = $this->db->query($query,$arg) or die(mysql_error());
      
      If($result->num_rows()>0)
	  {
        $this->form_validation->set_message('username_is_taken','Sorry username <i>'. $name.' </i> is taken');
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
 
  
        
}