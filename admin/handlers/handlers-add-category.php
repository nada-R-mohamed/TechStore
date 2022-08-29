<?php
ob_start();
require_once "../../app.php";

use TechStore\Classes\Models\Cat;
use TechStore\Classes\Validation\Validator;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name       = $request->post('name_category');

  // validation
  $validator = new Validator();
  $validator->validate("Name", $name, ["Required", "Str", "Max"]);

  if ($validator->hasErrors()) {
    $session->set("errors", $validator->getErrors());
    $request->aredirect("add-category.php");
  } else {

    $catObject = new Cat;

    $catObject->insert("`name`", "'$name'");

    $session->set("success", "category added SeccessFliy");
    $request->aredirect("index.php");
  }
} else {
  $request->aredirect("add-category.php");
}
ob_end_flush();
