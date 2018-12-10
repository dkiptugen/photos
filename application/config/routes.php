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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['category/(:num)/(:any)'] = 'home/category/$1/$2';
$route['login'] = "merchant/auth";
$route['dashboard'] = "merchant/dashboard";
$route['logout'] = "merchant/logout";
$route['authenticate'] = "merchant/authenticate"; 
$route['addMagazine'] = "merchant/addMagazine";
$route['details/(:num)/(:any)'] = "merchant/magazinesdetails/$1";
$route['details/(:any)/(:num)/(:any)'] = "merchant/edition/$1/$2/$3";
$route['ajax/(:num)'] = "merchant/ajax/$1";
$route['updatemedia/(:num)'] = "merchant/updatemedia/$1";
$route['updatetext/(:num)'] = "merchant/updatetext/$1";
$route['sellers'] = "merchant/sellers";
$route['sellers/(:num)/(:any)'] = "merchant/seller_details/$1";
$route['issues'] = "merchant/issues";
$route['issues/(:num)/(:any)'] = "merchant/getissue/$1";
$route['publication_autoload'] = "merchant/publication_autoload";
$route['genre_autoload'] = "merchant/genre_autoload";
$route['country_autoload'] = "merchant/country_autoload";
$route['createOrder'] = "merchant/createOrder";
$route['subscriptions'] = "merchant/mysubscriptions";
$route['forsale'] = "merchant/forsale";
$route['approved'] = "merchant/approved";
$route['returned'] = "merchant/returned";
$route['rejected'] = "merchant/rejected";
$route['archived'] = "merchant/archived";
$route['readbook/(:num)'] = "merchant/readbook/$1";
$route['subscriptions'] = "merchant/mysubscriptions";
$route['getorders/(:num)']="merchant/getorders/$1" ; 
$route['getpurchaseditems/(:num)']="merchant/getpurchaseditems/$1";
$route['updateOrder/(:num)']="merchant/updateOrder/$1" ;
$route['confirmPayment/(:num)']="merchant/confirmPayment/$1" ; 
$route['seller/(:num)/(:any)']="merchant/seller_details/$1/$2" ;
$route['sales'] = "merchant/sales"; 
$route['checkout'] = "merchant/checkout";
$route['f_checkout'] = "home/checkout";
$route['callback']= "home/callback";
$route['archiveedition']= "merchant/archiveedition"; 

