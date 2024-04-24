<?php
define('HOSTNAME', 'localhost');
define('USERNAME', 'username');
define('PASSWORD', '');
define('DATABASE', 'newdb');

$connection=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);
if (!$connection) {
    # code...
    die("Connection failed");
}
?>