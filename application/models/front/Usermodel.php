<?php
class Usermodel extends CI_Model{
	function addchat($data = "")
    {
		//echo "<pre>"; print_r($record); die;
		if($data == "")
			return false;
		else
		{
			//$record = $this->geoip->info($_SERVER['REMOTE_ADDR']);
			$record = $this->geoip->info('111.93.69.234');
			//echo "<pre>"; print_r($data); die;
			$dataArray = array("name"=>$data['name'],"datetime"=>date('Y-m-d h:i:s'),'email'=>$data['email'],'server'=>'','department'=>$data['department'],'status'=>0,'ipaddress'=>$_SERVER['REMOTE_ADDR'],'useragent'=>$_SERVER['HTTP_USER_AGENT'],'resolution'=>'','city'=>$record->city?$record->city:'','state'=>$record->region?$record->region:'','country'=>$record->country_name?$record->country_name:'','url'=>$_SERVER['REQUEST_URI'],'referrer'=>$_SERVER['HTTP_REFERER']);
			//echo "<pre>"; print_r($dataArray); die;
			$query = $this->db->insert('livehelp_chats', $dataArray);
			$id = $this->db->insert_id();
			if($id)
			{
				$array = array("chat_id"=>$id);
				$this->session->set_userdata($array);
				return true;
			} 
			else
				return false;
		}
    }
}
?>