<?php

use JerryHopper\JamesApiClient\domain;
use JerryHopper\JamesApiClient\user;
require ("./vendor/autoload.php");



$baseuri="http://docker:8000";
$domain = new domain($baseuri);

$users  = new user($baseuri);




// list domain
print_r($domain->list());
//print_r($users->list());



die();



print_r($users->delete('someuser@somedomain'));
print_r($users->list());









// list domain
print_r($domain->list());

// create domain.
print_r($domain->create("somedomain.com"));

// list domain
print_r($domain->list());

// domain exists
print_r($domain->exists("somedomain"));

//delete domain
print_r($domain->delete("somedomain.com") );

// list domain
print_r($domain->list());










