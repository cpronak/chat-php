<?php
class Messagesmodel extends CI_Model {

	public function get_latest_messages()
	{
		return array_reverse($this->db->order_by('id', 'desc')->get_where('livehelp_messages', array('chat'=>$this->input->cookie('chat-userid')))->result_array());
	}

	public function add_message()
	{
		$data = array(
			'chat' => $this->input->cookie('chat-userid', TRUE),
			'username' => 'username send right now static',
			'datetime' => date('Y-m-d H:i:s'),
			'message' => $this->input->post('msg'),
			'align' => 1,
			'status' => 0,
		);
		return $this->db->insert('livehelp_messages', $data);
	}
}
