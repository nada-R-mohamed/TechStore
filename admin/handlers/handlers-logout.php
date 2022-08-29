<?php
ob_start();

require_once "../../app.php";

use TechStore\Classes\Models\Admin;

$admin = new Admin();

$admin->logout($session);

$request->aredirect("login.php");

ob_end_flush();
