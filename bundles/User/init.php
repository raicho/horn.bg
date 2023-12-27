<?php
const USER_BASE_PATH = __DIR__. '/';
const USER_CONFIG_PATH = USER_BASE_PATH.'Config/';
const USER_SERVICES_PATH = USER_BASE_PATH.'Services/';
const USER_CLASSES_PATH = USER_BASE_PATH.'Classes/';
const USER_MODELS_PATH = USER_BASE_PATH.'Models/';
const USER_MIDDLEWARES_PATH = USER_BASE_PATH.'Middlewares/';
const USER_ROUTES_PATH = USER_BASE_PATH.'Routes/';

const USER_MAIL_PATH = USER_BASE_PATH.'Mail/';

use User\Services\UserServiceProvider;
use Rkstylex\Services\Loader;

// load config //
require_once (USER_CONFIG_PATH.'config.php');
// load service //
require_once (USER_SERVICES_PATH.'UserServiceProvider.php');
// register service //

app()->register(UserServiceProvider::class);
// load all classes
Loader::loadFilesInDirectory(USER_CLASSES_PATH);
// load models
Loader::loadFilesInDirectory(USER_MODELS_PATH);
// register middlewares //
Loader::loadFilesInDirectory(USER_MIDDLEWARES_PATH);
// register routes //
Loader::loadFilesInDirectory(USER_ROUTES_PATH);

// register mails //
Loader::loadFilesInDirectory(USER_MAIL_PATH);
