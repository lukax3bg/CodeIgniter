<?php

class LoginController extends CI_Controller {
    
      
	
	public function signin() {
		$this->load->view('home/signIn');
	}
	
        public function checkLogin(){
			
            $this->form_validation->set_rules('username','username','required');
            $this->form_validation->set_rules('password','password','required|callback_verifyUser');
            
            if($this->form_validation->run()== false){
                $this->load->view('home/signIn');
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
            echo $name;
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
        
         
}


