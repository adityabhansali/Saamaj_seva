<?php
//Error Reporting 
ini_set('error_reporting',1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
/*
Date: 3.03.2023
Required Classes 
Developer: RK
*/
require_once 'Classes/db.class.php';
require_once 'Classes/FamilyMembers.php';
require_once 'Classes/Auth.php';
//require_once 'classes/attachment.class.php';

//Database configration 
/* $servername = 'localhost'; */
/* $username = 'root'; */
/* $password = ''; */
/* $database = 'SASSS_MainBD'; */
$env_vars = parse_env_file(__DIR__ . '/.env');
define('DB_HOST', $env_vars['DB_HOST']);
define('DB_USER', $env_vars['DB_USER']);
define('DB_PASSWORD', $env_vars['DB_PASSWORD']);
define('DB_DATABASE', $env_vars['DB_NAME']);
define('Admin_EMAIL', $env_vars['Admin_EMAIL']);
define("APPURL","http://localhost/temp/");
define("AdminURL","http://localhost/temp/Views/Admin/");
define("Controllers",APPURL."Controllers/");
define("Classes",APPURL."Classes/");
//define('LOGIN_URL', 'login.php');
define("CSSPath","");
define("ScriptPath","");
define("MediaPath","");
$db = new db();
checkAuthorization();


// Function to check if the current page is authorized
function checkAuthorization() {
    // Start the session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
   // echo "<pre>";print_r($_SESSION);echo"</pre>";

    // Get the current page name
    $current_page = basename($_SERVER['PHP_SELF']);
    if($current_page == "Login.php" && (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)){
        header("Location: Dashboard.php");
        exit;
    }

    // Check if authorization is required for the current page
    if (isAuthorizationRequired($current_page)) {
        // Check if the user is logged in
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            // User is not logged in, redirect to login.php
            header("Location: Login.php");
            exit; // Stop further execution of the script
        }
    }

}
// Function to check if authorization is required for the current page

function isAuthorizationRequired($page_name) {
    $authorized_pages = array(
        'Dashboard.php',
        // Add more pages as needed
    );
    // Check if the current page is in the array of authorized pages
    return in_array($page_name, $authorized_pages);
}
/*
Date: 3.03.2023
To call env file in PHP 
Developer: RK
*/
function parse_env_file($file_path) {
    $env_variables = [];

    $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Ignore lines starting with #
        }
        list($key, $value) = explode('=', $line, 2);
        $env_variables[$key] = $value;
    }

    return $env_variables;
}
