<?php
const ADMIN_BASE_PATH = __DIR__. '/';
const ADMIN_CONFIG_PATH = ADMIN_BASE_PATH.'Config/';
const ADMIN_SERVICES_PATH = ADMIN_BASE_PATH.'Services/';
const ADMIN_CLASSES_PATH = ADMIN_BASE_PATH.'Classes/';
const ADMIN_MODELS_PATH = ADMIN_BASE_PATH.'Models/';
const ADMIN_MIDDLEWARES_PATH = ADMIN_BASE_PATH.'Middlewares/';
const ADMIN_ROUTES_PATH = ADMIN_BASE_PATH.'Routes/';
const ADMIN_MAIL_PATH = ADMIN_BASE_PATH.'Mail/';

use Admin\Services\AdminServiceProvider;
use Rkstylex\Services\Loader;

// load config //
require_once (ADMIN_CONFIG_PATH.'config.php');
// load service //
require_once (ADMIN_SERVICES_PATH.'AdminServiceProvider.php');
// register service //

app()->register(AdminServiceProvider::class);
// load all classes
Loader::loadFilesInDirectory(ADMIN_CLASSES_PATH);
// load models
//Loader::loadFilesInDirectory(ADMIN_MODELS_PATH);
// register middlewares //
Loader::loadFilesInDirectory(ADMIN_MIDDLEWARES_PATH);
// register routes //
Loader::loadFilesInDirectory(ADMIN_ROUTES_PATH);
// register mails //
//Loader::loadFilesInDirectory(ADMIN_MAIL_PATH);
