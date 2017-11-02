<?php


$config['insert_action'] = "rogzit";

$config['update_action'] = "frissit";

//$config['checkbox_field_checker'] = "_checkbox_CHECKER";

$config['db_error'] = "Nincs eredménye az adatbázis lekérdezésnek, vagy hiba történt lekérdezéskor: ";

$config['db_insert_error'] = "Nem sikerült törölni ezt az elemet vagy nem létező elem: ";


/*
 * LISTA NÉZET NEVE AZ URI-BAN
 */

$config['list_view_Universallist'] = "lista";
$config['list_view_URIAccessedList'] = "lista2";
$config['list_view_FilteredVisibility'] = "lista3";



/*
 * UPDATE NÉZET
 */

$config['update_view_Universallist'] = "szerkeszt";
$config['update_view_URIAccessedList'] = "szerkeszt2";
$config['update_view_FilteredVisibility'] = "szerkeszt3";


/*
 * ÚJ ELEM FELVITELE
 */

$config['new_view_Universallist'] = "uj";
$config['new_view_URIAccessedList'] = "uj2";
$config['new_view_FilteredVisibility'] = "uj3";



/*
 * TÁBLANEVEK ÉKEZETTEL
 */

$config['butor_category'] = "Kategóriák";
$config['butor_subcategory'] = "Alkategóriák";
$config['butor_product'] = "Termékek";
$config['butor_product_version'] = "Termékekváltozatok";
$config['butor_news'] = "Hírek";
$config['butor_mail'] = "Hírlevélre feliratkozók";



/*
 * TÁBLANEVEK ÉKEZETTEL VÉGE 
 */




$config['NO_WORKER_IN_DB'] = "MÉG NEM VITTEK FEL DOLGOZÓT A DOLGOZÓ-NYILVÁNTARTÁSBA! Előbb töltse fel az osztályának a dolgozói adatbázisát!";


/*
 * BEJELNTKEZÉSI MEGKÖTÉS ALÓL KIVÉTEL TÁBLÁK
 */
 
 $config['user_access_exception_table'] = "butor_mail";