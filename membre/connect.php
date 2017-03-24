<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 23/03/17
 * Time: 18:20
 */

define("DSN", "mysql:host=localhost;dbname=eatnrun");
define("USER", "root");
define("PASS", "root");

$bdd = new PDO('mysql:host=localhost;dbname=eatnrun;charset=utf8', 'root', 'root');
