<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/SocietyManagement/config.php');
session_destroy();
header("Location: Login.php");