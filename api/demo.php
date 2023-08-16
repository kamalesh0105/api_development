<?
#include "libs/Database.Class.php";
#Database::get_Connnection();
$config_json = file_get_contents("../../env.json");
$config = json_decode($config_json, true);
echo $config;
