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

/* INDEX ROUTE */ 
$route['default_controller'] = "login_controller"; // INDEX PAGE
$route['404_override'] = '';

/* AUTHENTICATION ROUTE */ 
$route['login'] = "login_controller"; // LOGIN
$route['logout'] = "logout_controller/logout"; // LOGOUT

/* ADMIN ROUTE */ 
$route['admin'] = "admin_controller"; // HOME ADMIN
$route['admin/add_user'] = "admin_controller/add_user"; //HOME ADMIN : ADD USER
$route['admin/remove_user/(:num)'] = "admin_controller/remove_user/$1"; //HOME ADMIN : REMOVE USER
$route['admin/change_password'] = "admin_controller/change_password"; // CHANGE PASSWORD VIEW
$route['admin/check_password'] = "admin_controller/check_password"; // CHECK FOR CHANGE PASSWORD

/* USER ROUTE */ 
$route['user'] = "user_controller"; // HOME USER
$route['user/add_source'] = "user_controller/add_source";  //HOME USER : ADD SOURCE
$route['user/remove_source/(:num)'] = "user_controller/remove_source/$1"; //HOME USER : REMOVE SOURCE


/* End of file routes.php */
/* Location: ./application/config/routes.php */