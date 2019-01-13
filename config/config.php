<?php
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', 'root');
define('MYSQL_DB', 'mikal');
define('PASSWORD_HASH', 's22Chrcte/Hl.0t1XkO');
define('DEBUG_MODE',true);

if(DEBUG_MODE){
    error_reporting(E_ALL | E_STRICT);
}

// $conn = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
// if(!$conn){
//     if(DEBUG_MODE){
//         echo ('Failed To Connect To Database: '.mysqli_connect_errno().': '.mysqli_connect_error());
//     }else{
//         echo ('Failed To Connect To Database. Try reloading the page or contact the admin.');
//     }
// }

