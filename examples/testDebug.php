<?php

use mapache_commons\Debug;

include "../lib/Collection.php";
include "../lib/Debug.php";

$countries=array("USA","Canada","Mexico","MapacheLand");
$countriesAssoc=array("First"=>"USA","Second"=>"Canada","Third"=>"Mexico","Fourth"=>"MapacheLand");

Debug::var_dump($countries);
Debug::var_dump($countries,true);