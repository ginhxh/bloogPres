<?php
require_once '../signup/config_seesion.inc.php';  

session_unset();
session_destroy();
header('location:../authore/index.php');

