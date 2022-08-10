<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//Authentication
$route['auth/validation'] = 'Auth/validation';
$route['auth/destroy'] = 'Auth/destroy';

/*
| -------------------------------------------------------------------------
| API
| -------------------------------------------------------------------------
*/

/** API USER */
$route['api/user'] = 'Backend/User';
$route['api/user/show/(:any)'] = 'Backend/User/show/$1';
$route['api/user/check-username'] = 'Backend/User/showUsername';
$route['api/user/add'] = 'Backend/User/insert';
$route['api/user/delete/(:any)'] = 'Backend/User/delete/$1';
$route['api/user/edit/(:any)'] = 'Backend/User/edit/$1';
$route['api/user/update/(:any)'] = 'Backend/User/update/$1';

/** API MOTOR */
$route['api/motor'] = 'Backend/Motor';
$route['api/motor/show/(:any)'] = 'Backend/Motor/show/$1';
$route['api/motor/add'] = 'Backend/Motor/insert';
$route['api/motor/delete/(:any)'] = 'Backend/Motor/delete/$1';
$route['api/motor/edit/(:any)'] = 'Backend/Motor/edit/$1';
$route['api/motor/update/(:any)'] = 'Backend/Motor/update/$1';

/** API SERVICE */
$route['api/service'] = 'Backend/Service';
$route['api/service/show/(:any)'] = 'Backend/Service/show/$1';
$route['api/service/add'] = 'Backend/Service/insert';
$route['api/service/delete/(:any)'] = 'Backend/Service/delete/$1';
$route['api/service/edit/(:any)'] = 'Backend/Service/edit/$1';
$route['api/service/update/(:any)'] = 'Backend/Service/update/$1';

/** API SPAREPART */
$route['api/spart-cat'] = 'Backend/Sparepart_category';
$route['api/spart-cat/show/(:any)'] = 'Backend/Sparepart_category/show/$1';
$route['api/spart-cat/add'] = 'Backend/Sparepart_category/insert';
$route['api/spart-cat/delete/(:any)'] = 'Backend/Sparepart_category/delete/$1';
$route['api/spart-cat/edit/(:any)'] = 'Backend/Sparepart_category/edit/$1';
$route['api/spart-cat/update/(:any)'] = 'Backend/Sparepart_category/update/$1';

$route['api/spart-prod'] = 'Backend/Sparepart_product';
$route['api/spart-prod/ready-stock'] = 'Backend/Sparepart_product/readyStock';
$route['api/spart-prod/show/(:any)'] = 'Backend/Sparepart_product/show/$1';
$route['api/spart-prod/add'] = 'Backend/Sparepart_product/insert';
$route['api/spart-prod/delete/(:any)'] = 'Backend/Sparepart_product/delete/$1';
$route['api/spart-prod/edit/(:any)'] = 'Backend/Sparepart_product/edit/$1';
$route['api/spart-prod/update/(:any)'] = 'Backend/Sparepart_product/update/$1';
$route['api/spart-prod/update-stock/(:any)'] = 'Backend/Sparepart_product/updateStock/$1';

/** API MONTIR */
$route['api/montir'] = 'Backend/Montir';
$route['api/montir/show/(:any)'] = 'Backend/Montir/show/$1';
$route['api/montir/add'] = 'Backend/Montir/insert';
$route['api/montir/delete/(:any)'] = 'Backend/Montir/delete/$1';
$route['api/montir/edit/(:any)'] = 'Backend/Montir/edit/$1';
$route['api/montir/update/(:any)'] = 'Backend/Montir/update/$1';

/** API TRANSAKSI */
$route['api/transaksi/show'] = 'Backend/Transaksi/show';
$route['api/transaksi/show/(:any)'] = 'Backend/Transaksi/show/$1';
$route['api/transaksi/add'] = 'Backend/Transaksi/insert';
$route['api/transaksi/delete/(:any)'] = 'Backend/Transaksi/delete/$1';
$route['api/transaksi/edit/(:any)'] = 'Backend/Transaksi/edit/$1';
$route['api/transaksi/update/(:any)'] = 'Backend/Transaksi/update/$1';
$route['api/transaksi/update-status/(:any)'] = 'Backend/Transaksi/updateStatus/$1';

/** API PENJUALAN */
$route['api/penjualan/show'] = 'Backend/Penjualan/show';
$route['api/penjualan/show/(:any)'] = 'Backend/Penjualan/show/$1';
$route['api/penjualan/add'] = 'Backend/Penjualan/insert';
$route['api/penjualan/delete/(:any)'] = 'Backend/Penjualan/delete/$1';
$route['api/penjualan/edit/(:any)'] = 'Backend/Penjualan/edit/$1';
$route['api/penjualan/update/(:any)'] = 'Backend/Penjualan/update/$1';
$route['api/penjualan/update-status/(:any)'] = 'Backend/Penjualan/updateStatus/$1';


/** API STATISTIK & COUNTER */
$route['api/counter/dashboard'] = 'Backend/Counter/dashboard';
$route['api/statistik/transaksi/(:any)'] = 'Backend/Counter/statistikTransaksi/$1';


/** API TRANSAKSI */
$route['api/foo/test'] = 'Backend/Foo';

/*
| -------------------------------------------------------------------------
| WEB
| -------------------------------------------------------------------------
*/

$route['login']     = 'Auth/login';
$route['dashboard'] = 'WEB_Controller/dashboard';
$route['motor']     = 'WEB_Controller/showMotor';
$route['service']   = 'WEB_Controller/showService';
$route['spart-cat']   = 'WEB_Controller/showSpartCat';
$route['spart-prod']   = 'WEB_Controller/showSpartProd';
$route['montir']   = 'WEB_Controller/showMontir';
$route['user']   = 'WEB_Controller/showUser';

/** Services */
$route['transaksi']   = 'WEB_Controller/showTransaksi';
$route['transaksi/add']   = 'WEB_Controller/addTransaksi';
$route['transaksi/detail/(:any)']   = 'WEB_Controller/detailTransaksi/$1';

/** Spareparts */
$route['transaksi/add-sparepart']   = 'WEB_Controller/addPenjualan';
$route['penjualan']   = 'WEB_Controller/showPenjualan';
$route['penjualan/detail/(:any)']   = 'WEB_Controller/detailPenjualan/$1';


$route['reports/transaksi']   = 'Reports/transaksi';
$route['reports/transaksi/(:any)']   = 'Reports/transaksi/$1';
$route['reports/transaksi-by-date/(:any)']  = 'Reports/transaksiByDate/$1';
$route['reports/transaksi-by-month/(:any)'] = 'Reports/transaksiByMonth/$1';

$route['reports/penjualan']   = 'Reports/penjualan';
$route['reports/penjualan/(:any)']   = 'Reports/penjualan/$1';
$route['reports/penjualan-by-date/(:any)']  = 'Reports/penjualanByDate/$1';
$route['reports/penjualan-by-month/(:any)'] = 'Reports/penjualanByMonth/$1';

$route['reports/sparepart']   = 'Reports/sparepart';
$route['reports/sparepart-by-date/(:any)']   = 'Reports/sparepartByDate/$1';
$route['reports/sparepart-by-month/(:any)']   = 'Reports/sparepartByMonth/$1';

// $route['reports/foo']   = 'Reports/foo';
