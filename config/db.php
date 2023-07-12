<?php

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB", "mp3");

$connnection = mysqli_connect(HOST, USER, PASSWORD, DB);

if(!$connnection) die("Error " . mysqli_connect_error());
// print("Connected!!!!!!!!!!!!!!!");