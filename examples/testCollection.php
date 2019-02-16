<?php

use mapache_commons\Collection;
use mapache_commons\Debug;

include "../lib/Collection.php";
include "../lib/Debug.php";

$countries=array("USA","Canada","Mexico","MapacheLand");
$countriesAssoc=array("First"=>"USA","Second"=>"Canada","Third"=>"Mexico","Fourth"=>"MapacheLand");

$countriesList=[];
$countriesList[]=['Country'=>"USA",'Population'=>300];
$countriesList[]=['Country'=>"Canada",'Population'=>50];
$countriesList[]=['Country'=>"Mexico",'Population'=>80];

$arrayComplex=array('Name'=>'John'
        ,'Age'=>33
        ,'Address'=>['Name'=>'MapacheLand','City'=>'Racoon City']);

Debug::var_dump(Collection::first($countries));
Debug::var_dump(Collection::first($countriesAssoc));
Debug::var_dump(Collection::firstKey($countriesAssoc));

echo Collection::generateTable($countriesList);

Debug::var_dump(Collection::arrayKeyLower($arrayComplex));
Debug::var_dump(Collection::arrayKeyUpper($arrayComplex));