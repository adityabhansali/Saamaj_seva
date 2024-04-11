<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Saamj_seva/config.php');
session_destroy();
header("Location: Login.php");