<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('front/usermodel');
	}
	public function index()
	{
		if ($this->input->cookie('chat-userid') != '') {
			redirect('/messages/index', 'location', 301);
			return;
		}
		else if($this->input->post()){
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('department', 'Department', 'required');
			if ($this->form_validation->run() === TRUE)
			{
				if(!$this->usermodel->addchat($this->input->post()))
				{	
					return false;
				}
				else{
					set_cookie('chat-userid', $this->session->userdata('chat_id'), 86400);
					redirect('/messages/index', 'location', 301);
					return;
				}
			}
		}
		$this->load->view('front/users/login', array('title' => 'Chat'));
	}
}
