<?php
ob_start();
require_once ("../../app.php");

use TechStore\Classes\Validation\Validator;
use TechStore\Classes\Models\Cat;

if ($request->postHas('submit')) {

  $name = $request->post('name');

   // validation
    $validator = new Validator();
    $validator->validate("name", $name, ["Required", "Str", "Max"]);

    if($validator->hasErrors()) {

      $session->set("errors", $validator->getErrors());
      $request->aredirect("add-category.php");

    } else {

    $catObject = new Cat;
    $catObject->insert("name" , $name);
    $session->set("success", "category added SeccessFliy");
    $request->aredirect("categories.php");

    }

    
} else {
  $request->aredirect("add-category.php");
}
ob_end_flush();
