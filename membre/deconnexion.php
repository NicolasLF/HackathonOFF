<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 23/03/17
 * Time: 19:17
 */
session_start();
session_destroy();
header('location: identification.php')
?>