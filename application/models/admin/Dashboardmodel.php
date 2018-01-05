<?php
class Dashboardmodel extends CI_Model{
	var $resultset = array();
	function loadLayout($path="",$global_message = "")
	{
		switch($path)
		{
			case "login":
				$this->template->set_template('empty');
				$this->template->write_view('content', 'admin/login',array("dashboardmodel"=>$this,"global_message"=>(($global_message=="")?alertMessage($this->session->userdata('alert')):$global_message))); 
				$this->template->render();
			break;
		}
	}
	
    function isLogin()
	{
		return ($this->session->userdata('userid')!="")?true:false;
	}	
	
	function getLoginPostUrl()
	{
		return base_url("admin/dashboard/indexPost");
	}
	
	function login($data = "")
    {
		if($data == "")
			return false;
		else
		{
			$query = $this->db->get_where('admin_user', array('email_id' => $data['username'],'password'=>md5($data['password']),'status'=>1));
			if($query->num_rows()>0)
			{
				$result = $query->result_array();	
				//echo "<pre>re"; print_r($result); die;
								
				$array = array("userid"=>$result[0]['id'],"email_id"=>$result[0]['email_id'],"name"=>$result[0]['name'],"status_mode"=>$data['status_mode']);
				$this->session->set_userdata($array);
				return true;
			}
			else
				return false;
		}
    }
	
	function getLogoutUrl()
	{
		return base_url("admin/dashboard/logout");
	}
	function getStatusChange($value)
	{
		return base_url("admin/dashboard/statuschange?status=".$value);
	}
}
?>