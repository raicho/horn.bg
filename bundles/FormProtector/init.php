<?php
const FORM_PROTECTOR_BASE_PATH = __DIR__. '/';
const FORM_PROTECTOR_CONFIG_PATH = FORM_PROTECTOR_BASE_PATH.'Config/';
const FORM_PROTECTOR_SERVICES_PATH = FORM_PROTECTOR_BASE_PATH.'Services/';
const FORM_PROTECTOR_CLASSES_PATH = FORM_PROTECTOR_BASE_PATH.'Classes/';
const FORM_PROTECTOR_ROUTES_PATH = FORM_PROTECTOR_BASE_PATH.'Routes/';
const FORM_PROTECTOR_MODELS_PATH = FORM_PROTECTOR_BASE_PATH.'Models/';

use FormProtector\Services\FormProtectorServiceProvider;
use Rkstylex\Services\Loader;

// load config //
Loader::loadFilesInDirectory(FORM_PROTECTOR_CONFIG_PATH);
// load service //
require_once (FORM_PROTECTOR_SERVICES_PATH.'FormProtectorServiceProvider.php');
// register service //
app()->register(FormProtectorServiceProvider::class);
// load all classes
Loader::loadFilesInDirectory(FORM_PROTECTOR_CLASSES_PATH);
// load all models
Loader::loadFilesInDirectory(FORM_PROTECTOR_MODELS_PATH);
// load all routes //
Loader::loadFilesInDirectory(FORM_PROTECTOR_ROUTES_PATH);

