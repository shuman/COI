<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index(){
		echo 'hello';
	}

	function display($title='', $content='No Content'){
        $data['admin']       = TRUE;
        $data['title']       = (!empty($title)) ? $title : 'Cut Out Image Service Portal - Client Area';
        /* Template HTML */
        $html['content']     = $content;
        $html['header']      = $this->load->view('tpl_header', $data, TRUE);
        $html['topfixedbar'] = $this->load->view('admin/tpl_admin_topfixedbar', '', TRUE);
        $html['navigation']  = $this->load->view('admin/tpl_admin_navigation','', TRUE);
        $html['footer']      = $this->load->view('tpl_footer','', TRUE);

    	$this->load->view('tpl_index', $html);
    }

	function income(){
		echo "income";
	}

	function all_clients(){
		$title = "Clients List";

		$content = $this->load->view("admin/page_clients_list", '', TRUE);

		$this->display($title, $content);
	}
}



