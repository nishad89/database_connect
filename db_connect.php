<?php

/****  For Production Server ****/
// define ("DB_HOST", "host"); // set database host
// define ("DB_USER", "username"); // set database user

// define ("DB_PASS","Password"); // set database password
// define ("DB_NAME","db_name"); // set database name


/****  For Local Host ****/
define ("DB_HOST", "host"); // set database host
define ("DB_USER", "username"); // set database user

define ("DB_PASS","Password"); // set database password
define ("DB_NAME","db_name"); // set database name



// define ("site_url","www.yoursite.com"); // site url for production
define ("site_url","http://localhost/yoursite"); // site url development

define('abs_path_root', getcwd()); //Absolute path to the root directory of the project
define( 'img_folder', abs_path_root . "/uploads/");
define( 'img_url', site_url . "/uploads/");


$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");


function admin_area() {	
    session_start();
    if(!checkAdmin())
        header ('Location: login.php');
    return TRUE;
}

function checkAdmin(){

    if(isset($_SESSION['sitename_user_name'])){
        if( !is_null($_SESSION['sitename_user_name']))
            return TRUE;
    }
    
    return FALSE;
}

function login($username, $password){
    $username = mysql_real_escape_string($username);
    $password = mysql_real_escape_string($password);
    
    $sql = "SELECT * FROM users WHERE name='$username' AND password='$password'";
    $results =mysql_query($sql);
    if(mysql_num_rows($results) != 0){
        $row = mysql_fetch_array($results);
        $_SESSION['sitename_user_name'] = $row['name'];
        header ('Location: index.php');
    }
}

function logout(){
    unset($_SESSION['sitename_user_name']);
    header ('Location: login.php');
}

function is_loggedin(){
    if( isset($_SESSION['sitename_user_name'])){
            header ('Location: index.php');
    }
    
    return FALSE;
}

function error($err){    
    die($err);
}
