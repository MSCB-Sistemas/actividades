<?php
// login_helper_mysql.php
// Control de intentos de login con mysql_* (antiguo).


error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ini_set('display_errors', 0);


function loginCheck($username, $passwordInput, $passwordDb) {
    // El login ahora se realiza usando password_hash y password_verify en login.php
    return false;
}
?>
