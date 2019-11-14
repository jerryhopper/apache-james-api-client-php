<?php

use JerryHopper\JamesApiClient\domain;
use JerryHopper\JamesApiClient\user;
require ("./vendor/autoload.php");



$baseuri="http://docker:8000";
$domain = new domain($baseuri);
$user  = new user($baseuri);



die();
// list domain


print_r($user->list());

print_r($user->create("some@us.er","somepassword"));

print_r($user->delete("some@us.er"));




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










