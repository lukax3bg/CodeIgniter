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
	
	
}

?>
