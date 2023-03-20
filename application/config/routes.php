<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// ------------------------------ UserView-section --------------------------

$route['default_controller'] = 'welcome';
// $route['default_controller'] = 'EStore/EStore_Controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['shop/(:any)'] = 'EStore/EStore_Controller/showProductsByCategories/$1';

// login
$route['login'] = 'EStore/EStore_Controller/showUserLogin';
$route['registration'] = 'EStore/EStore_Controller/showUserRegistration';
$route['submit-registration'] = 'EStore/EStore_Controller/submitRegistration';
$route['submit-login'] = 'EStore/EStore_Controller/checkForLogin';

$route['logout'] = 'EStore/EStore_Controller/logout';
// end-login

$route['cart'] = 'EStore/EStore_Controller/myCart';

//Shipping_details
$route['shipping'] = 'EStore/EStore_Controller/shippingDetails';
$route['edit-addr'] = 'EStore/EStore_Controller/editCustomerAddress';
$route['submit-edited-addr'] = 'EStore/EStore_Controller/submitEditedAddress';

$route['product/(:any)'] = 'EStore/EStore_Controller/showProductDetails/$1';

$route['thanks']= 'EStore/EStore_Controller/thankYouPage';

//Rating and reviews
$route['save-ratings'] = 'EStore/EStore_Controller/saveRatings';

// -------------------------- Admin-section --------------------------

$route['admin'] = 'Admin/Admin_Controller';
$route['banner'] = 'Admin/Admin_Controller/uploadBanner';
$route['add-categories'] = 'Admin/Admin_Controller/add_categories';
// Product
$route['add-products'] = 'Admin/Admin_Controller/add_products';
$route['submit-product'] = 'Admin/Admin_Controller/submit_products';

$route['add-variation/(:any)'] = 'Admin/Admin_Controller/add_variation/$1';
$route['add-images/(:any)'] = 'Admin/Admin_Controller/add_images/$1';
$route['add-colored-images/(:any)'] = 'Admin/Admin_Controller/add_colored_images/$1';

$route['product-list'] = 'Admin/Admin_Controller/show_product_list';

$route['store-image'] = 'Admin/Admin_Controller/store_image';
$route['store-colored-image'] = 'Admin/Admin_Controller/store_colored_image';
// $route['save-variation'] = 'Admin/Admin_Controller/submit_product_variation';

$route['show-shipping'] = 'Admin/Admin_Controller/show_shipping';

//For delivery boy and Admin to confirm that parcel is received by customer
$route['status'] = 'Admin/Admin_Controller/show_shipping_status';
$route['update-shipping'] = 'Admin/Admin_Controller/update_shipping_status';

