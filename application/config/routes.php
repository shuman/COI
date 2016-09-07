<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller']   = "portal";
$route['404_override']         = '';

/* controller */
$route['admin/reports/(:any)'] = 'admin/reports/$1';
$route['admin/reports']        = 'admin/reports';
$route['admin/(:any)']         = 'admin/admin/$1';
$route['admin']                = 'admin/admin';
$route['admin_ajax/(:any)']    = 'admin/admin_ajax/$1';
$route['admin_ajax']           = 'admin/admin_ajax';

$route['message/(:any)']       = "message/$1";
$route['message']              = "message/index";
$route['auth/(:any)']          = "auth/$1";
$route['auth']                 = "auth/index";
$route['ajax/(:any)']          = "ajax/$1";
$route['ajax']                 = "ajax/index";
$route['page/(:any)']          = "page/$1";
$route['page']                 = "page/index";
$route['testpad/(:any)']       = "testpad/$1";
$route['testpad']              = "testpad/index";
$route['download']             = "page/download";
$route['404']              	   = "page/page404";
//$route['free-trial']="page/free_trial";

/* portal controller */
$route['(:any)']               = 'portal/$1';





/* End of file routes.php */
/* Location: ./application/config/routes.php */