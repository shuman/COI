<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MY_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper('text');
	}

	function index(){

		if ( ! has_permission('message_board', $this->user_id, $this->company->id) ) {
			$data['page_title'] = '';
			$data['msg'] = 'You don\'t have access to message board for "<strong>'.$this->company->name.'</strong>" !';
			$page_content = $this->load->view('page_limit_access', $data, TRUE);
		}
		else{
			$data['messages'] = $this->portal_lib->load_message_threads();
			$page_content = $this->load->view('page_message_thread', $data, TRUE);
		}

		$title = 'Messages - Cut Out Image';
		$this->display($title, $page_content);	
	}

	function compose(){
		if ( ! has_permission('message_board', $this->user_id, $this->company->id) ) {
			$data['page_title'] = '';
			$data['msg'] = 'You don\'t have access to message board for "<strong>'.$this->company->name.'</strong>" !';
			$page_content = $this->load->view('page_limit_access', $data, TRUE);
		}
		else{
			$data['messages'] = $this->portal_lib->load_messages(300);
			$page_content = $this->load->view('page_compose_message', $data, TRUE);
		}

		$title = 'Messages - Cut Out Image';
		$this->display($title, $page_content);
	}

	function thread(){
		$thread_id = $this->uri->segment(3);
		if($thread_id){
			if ( ! has_permission('message_board', $this->user_id, $this->company->id) ) {
				$data['page_title'] = '';
				$data['msg'] = 'You don\'t have access to message board for "<strong>'.$this->company->name.'</strong>" !';
				$page_content = $this->load->view('page_limit_access', $data, TRUE);
			}
			else{
				$this->mod_portal->remove_message_status($this->user_id, $this->company->id, $thread_id);

				$data['thread_id'] = $thread_id;
				$data['threads']  = $this->portal_lib->load_message_threads();
				$data['messages'] = $this->portal_lib->load_message_single($thread_id);
				$page_content     = $this->load->view('page_message_single', $data, TRUE);
			}
			$title = 'Messages - Cut Out Image';
			$this->display($title, $page_content);	
		}
		else{
			redirect(site_url('message'));
		}
	}
}