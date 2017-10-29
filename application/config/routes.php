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
//$route['default_controller'] = 'welcome';
$route['default_controller'] = 'ButorController/getCategories';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['users/signin'] = 'Users_w/signin';
$route['users/login'] = 'Users_w/check_user';
$route['users/felhasznalok'] = 'Users_w/userList';
$route['users/kijelentkezes'] = 'Users_w/logout';

$route['lista/lista/(.+)'] = "Universallist/getList/$1" ;
$route['lista/szerkeszt/(.+)/(.+)'] = "Universallist/editItem/$1/$2";
$route['lista/uj/(.+)'] = "Universallist/index/$1";
$route['lista/(.+)'] =  'Universallist/index/$1';


$route['img-to-db'] = 'ImgToDB/insertNames';

$route['kategoriak'] = 'ButorController/getCategories';
$route['kategoria/(.+)'] = 'ButorController/getCategory/$1';
$route['alkategoriak/(.+)'] = 'ButorController/getSubcategories/$1';
$route['alkategoriak/(.+)/(.+)'] = 'ButorController/getSubcategories/$1/$2';

$route['alkategoria/(.+)/(.+)'] = 'ButorController/getSubcategory/$1/$2';
$route['alkategoria/(.+)'] = 'ButorController/getSubcategory/$1';

$route['termek/(.+)/(.+)/(.+)'] = 'ButorController/getProduct/$1/$2/$3';
$route['termek/(.+)/(.+)'] = 'ButorController/getProduct/$1/$2';
$route['termek/(.+)'] = 'ButorController/getProduct/$1';

$route['termek-valtozatok/(.+)/(.+)/(.+)/(.+)'] = 'ButorController/getProductVersions/$1/$2/$3/$4';
$route['termek-valtozatok/(.+)/(.+)/(.+)'] = 'ButorController/getProductVersions/$1/$2/$3';
$route['termek-valtozatok/(.+)'] = 'ButorController/getProductVersions/$1';
$route['termek-valtozat/(.+)'] = 'ButorController/getProductVersion/$1';
$route['termek-valtozat/(.+)/(.+)'] = 'ButorController/getProductVersion/$1/$2';


$route['menu'] = 'ButorController/getProductMenu';

$route['kepek'] = 'GetImages/getImages';
$route['kepek/(.+)'] = 'GetImages/getImages/$1';
$route['kepek-mentes/(.+)'] = 'GetImages/save/$1';
$route['termekek-lekerdezese/(.+)'] = 'GetImages/querySelectedProducts/$1';

$route['butorstudio/(.+)'] = 'ButorController/getCompanyInfo/$1';

$route['tartalom'] = 'ButorController/queryContent';

$route['feltoltes'] = "Upload";

$route['kvt'] = "GetImages/makeDir";
