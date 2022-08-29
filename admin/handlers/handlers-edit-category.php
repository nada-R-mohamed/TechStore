<?php
ob_start();

require_once "../../app.php";

use TechStore\Classes\Validation\Validator;
use TechStore\Classes\Models\Cat;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id         = $request->post('id');
  $name       = $request->post('name');

  // validation
  $validator = new Validator();
  $validator->validate("Name", $name, ["Required", "Str", "Max"]);

  if ($validator->hasErrors()) {
    $session->set("errors", $validator->getErrors());
    $request->aredirect("edit-category.php");
  } else {

    $productObject = new Cat;

    $productObject->update("`name` = '$name'", "'$id'");

    $session->set("success", "Category Edit SeccessFliy");
    $request->aredirect("edit-category.php");
  }
} else {
  $request->aredirect("edit-category.php");
}

ob_end_flush();
