<?php

date_default_timezone_set('UTC');

// Composer
require_once __DIR__ . '/../../vendor/autoload.php';

// Dotenv
$dotenv = Dotenv\Dotenv::create(__DIR__, "../../.env");
$dotenv->load();

// Twig
$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views');
$twig = new Twig_Environment($loader, [
//    'cache' => '/path/to/compilation_cache',
]);

// Configuration
define('APP_NAME', $_ENV['APP_NAME']);
$twig->addGlobal('APP_NAME', APP_NAME);

// Database configuration
if($_ENV['DEBUG_MODE'] !== "true") {

    // In production, enforce HTTPS cookies
    ini_set('session.cookie_secure', 1);

}

define('SQL_HOST', $_ENV['SQL_HOST']);
define('SQL_USER', $_ENV['SQL_USER']);
define('SQL_PASSWORD', $_ENV['SQL_PASSWORD']);
define('GITHUB_KEY', $_ENV['GITHUB_KEY']);

define('SQL_DATABASE', 'app_database');

// Create session
ini_set('session.cookie_httponly', 1);
session_start();

// Logged in status

if(!isset($_SESSION["logged_in"])) {
    define('LOGGED_IN', false);
    define('USERNAME', null);
    define('USER_ID', $_SESSION["logged_in_user_id"]);
} else {
    define('LOGGED_IN', true);
    define('USERNAME', $_SESSION["logged_in"]);
    define('USER_ID', $_SESSION["logged_in_user_id"]);
}


$twig->addGlobal('logged_in', LOGGED_IN);
$twig->addGlobal('username', USERNAME);

function client_area_logged_out_handler() {
    header("Location: /user/login.php?goto=/client-area");
    die();
}