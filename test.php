<?php
require_once("app.php");

use TechStore\Classes\Models\OrdersDetails;

$det= new OrdersDetails;
$details= $det->selectWithProducts(6);


echo "<pre>";
print_r($details);
echo "</pre>";