<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/TEMP/config.php');
session_destroy();
header("Location: Login.php");