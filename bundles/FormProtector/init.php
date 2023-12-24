<?php
const FORM_PROTECTOR_BASE_PATH = __DIR__. '/';
const FORM_PROTECTOR_CONFIG_PATH = FORM_PROTECTOR_BASE_PATH.'Config/';
const FORM_PROTECTOR_SERVICES_PATH = FORM_PROTECTOR_BASE_PATH.'Services/';
const FORM_PROTECTOR_CLASSES_PATH = FORM_PROTECTOR_BASE_PATH.'Classes/';
const FORM_PROTECTOR_ROUTES_PATH = FORM_PROTECTOR_BASE_PATH.'Routes/';
const FORM_PROTECTOR_MODELS_PATH = FORM_PROTECTOR_BASE_PATH.'Models/';

use FormProtector\Services\FormProtectorServiceProvider;


// load config //

require_once (FORM_PROTECTOR_CONFIG_PATH.'config.php');


// load service //
require_once (FORM_PROTECTOR_SERVICES_PATH.'FormProtectorServiceProvider.php');
// register service //
app()->register(FormProtectorServiceProvider::class);

// load all classes
$classesDirectory = scandir(FORM_PROTECTOR_CLASSES_PATH);
$classesDirectory = array_diff($classesDirectory, array('.', '..'));
foreach($classesDirectory as $file) {
    require_once (FORM_PROTECTOR_CLASSES_PATH.$file);
}

// load models
$routesDirectory = scandir(FORM_PROTECTOR_MODELS_PATH);
$routesDirectory = array_diff($routesDirectory, array('.', '..'));
foreach($routesDirectory as $file) {
    require_once (FORM_PROTECTOR_MODELS_PATH.$file);
}


// load routes //
$routesDirectory = scandir(FORM_PROTECTOR_ROUTES_PATH);
$routesDirectory = array_diff($routesDirectory, array('.', '..'));
foreach($routesDirectory as $file) {
    require_once (FORM_PROTECTOR_ROUTES_PATH.$file);
}



