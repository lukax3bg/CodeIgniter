<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->view('users/edituser', array('error' => ' ' ));
	}

	function do_upload()
	{				

		$config['upload_path'] = 'assets/images/uploads/';
		$config['allowed_types'] = 'png|jpg|gif';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$new_name = time();
		$config['file_name'] = $new_name;
		
		$path = $_FILES['userfile']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			
			$this->load->view('users/edituser', $error);
		}
		else
		{
			$query="update user set link_Photo = \"".$new_name.".".$ext."\" where idUser = ".$_SESSION['idUser'].";";
			$arg=array();
			$result = $this->db->query($query,$arg) or die(mysql_error());
			
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('users/edituser', $data);
			
		}
	}
}
?>