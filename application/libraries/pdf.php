<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter PDF Library
 *
 * Generate PDF's in your CodeIgniter applications.
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			Chris Harvey
 * @license			MIT License
 * @link			https://github.com/chrisnharvey/CodeIgniter-PDF-Generator-Library
 */
//require(dirname(__FILE__) . '/dompdf/include/autoload.inc.php');

//define('DOMPDF_ENABLE_AUTOLOAD', false);

require_once(dirname(__FILE__) . '/dompdf/dompdf_config.inc.php');
spl_autoload_register('DOMPDF_autoload'); 

class Pdf extends DOMPDF
{
	function __construct()
	{
		$this->ci =& get_instance();
	}

	/**
	 * Load a CodeIgniter view into domPDF
	 *
	 * @access	public
	 * @param	string	$view The view to load
	 * @param	array	$data The view data
	 * @return	void
	 */
	public function load_view($view, $data = array())
	{
		$html = $this->ci->load->view($view, $data, TRUE);

		$this->load_html($html);
	}

	public function do_pdf($file_name, $html){

		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream($file_name.'.pdf');
	}
}