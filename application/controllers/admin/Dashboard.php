<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/dashboardmodel');
	}
	function index() {
		if(!$this->dashboardmodel->isLogin())
		{
			$this->dashboardmodel->loadLayout("login","Please login with your Username and Password.");			
		}
		else
		{
			$this->template->set_template('2-column-left');
			$this->template->write_view('header', 'admin/template/pages/2columns-left/header',array("dashboardmodel"=>$this->dashboardmodel));
			$this->template->write_view('left', 'admin/template/pages/2columns-left/left');
			$this->template->write_view('customer', 'admin/template/pages/2columns-left/customer');
			$this->template->write_view('content', 'admin/customer-chat',array("dashboardmodel"=>$this->dashboardmodel));            
			//$this->template->write_view('breadcrumbs', 'admin/template/breadcrumbs',array("path"=>array("Home"=>base_url(),"Dashboard"=>base_url())));
			//$this->template->write_view('footer', 'admin/template/footer');
			$this->template->render();
		}
	}
	public function indexPost()
	{	
		$this->form_validation->set_rules('username', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->dashboardmodel->loadLayout("login","Please login with your Username and Password.");			
		}
		else
		{
			if(!$this->dashboardmodel->login($this->input->post()))
			{
				$this->dashboardmodel->loadLayout("login","Invalid login or password.");									
			}
			else
			{
				if($this->session->userdata('currenturl')!="")
				{
					$tempurl = $this->session->userdata('currenturl');
					$this->session->unset_userdata('currenturl');
					redirect($tempurl, 'refresh');
				}
				else
					redirect('admin/', 'refresh');
			}
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/admin/', 'refresh');
	}
	public function statuschange()
	{
		$this->session->set_userdata('status_mode',$this->input->get('status'));
		redirect('/admin/', 'refresh');
	}
}
