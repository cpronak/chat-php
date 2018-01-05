<?php
class Messages extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('front/messagesmodel');
	}

	public function index()
	{
		if ($this->input->cookie('chat-userid') == '') {
			redirect('/user', 'location', 301);
		}
		else {
			$this->load->view('front/messages/index', array(
				'messages' => $this->messagesmodel->get_latest_messages(),
				'title' => 'Chat'
			));
		}
	}

	public function create()
	{
		if ($this->input->cookie('chat-userid') === '') {
			redirect('/user', 'location', 301);
		}

		$this->form_validation->set_rules('msg', 'Message', 'required');
		$data['title'] = 'Chat';
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('front/messages/index',array(
				'messages' => $this->messagesmodel->get_latest_messages(),
				'title' => 'Chat'
			));
		}
		else
		{
			$this->messagesmodel->add_message();
			redirect('/user', 'location', 301);
		}
  }
}
