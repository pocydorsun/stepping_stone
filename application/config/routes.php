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
$route['admin/add_new_user'] = "admin_controller/add_new_user"; //HOME ADMIN : ADD USER
$route['admin/remove_user/(:num)'] = "admin_controller/remove_user/$1"; //HOME ADMIN : REMOVE USER
$route['admin/change_password'] = "admin_controller/change_password"; // CHANGE PASSWORD VIEW
$route['admin/check_password'] = "admin_controller/check_password"; // CHECK FOR CHANGE PASSWORD
$route['admin/approve'] = "admin_controller/approve"; //HOME ADMIN APPROVE
$route['admin/plan_approve/(:num)'] = "admin_controller/plan_approve/$1"; // approve
$route['admin/plan_not_approve/(:num)'] = "admin_controller/plan_not_approve/$1"; // not approve

/* USER ROUTE */ 
$route['user'] = "user_controller"; // HOME USER
$route['user/profile'] = "user_controller/edit_profile"; //HOME USER : EDIT USER PROFILE
$route['user/check_password'] = "user_controller/check_password"; // CHECK FOR CHANGE PASSWORD
$route['user/change_name'] = "user_controller/change_name"; //  UPDATE FIRST NAME AND LAST NAME

$route['user/target'] = "user_controller/target_manager"; // HOME target
$route['user/add_target'] = "user_controller/add_target"; //ADD target
$route['user/edit_target/(:num)'] = "user_controller/edit_target/$1"; //EDIT target
$route['user/remove_target/(:num)'] = "user_controller/remove_target/$1"; //REMOVE target

$route['user/cost'] = "user_controller/cost_manager"; // HOME COST
$route['user/save_cost'] = "user_controller/save_cost"; // HOME COST
$route['user/edit_cost/(:num)'] = "user_controller/edit_cost/$1"; //EDIT cost
$route['user/remove_cost/(:num)'] = "user_controller/remove_cost/$1"; //REMOVE cost

$route['user/plan'] = "user_controller/plan_manager"; // HOME plan
$route['user/plan_send/(:num)'] = "user_controller/plan_send/$1"; //REMOVE send plan
$route['user/create'] = "user_controller/create_plan"; // HOME plan
$route['user/add_plan'] = "user_controller/add_plan"; //ADD plan
$route['user/remove_plan/(:num)'] = "user_controller/remove_plan/$1"; //REMOVE target


/* End of file routes.php */
/* Location: ./application/config/routes.php */