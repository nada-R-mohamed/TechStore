<?php
ob_start();

require_once ("../../app.php");

use TechStore\Classes\Validation\Validator;
use TechStore\Classes\Models\Admin;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name             = $request->post('name');
  $email            = $request->post('email');
  $password         = $request->post('password');
  $confirm_password = $request->post('confirm_password');

  $validator = new Validator();

  $validator->validate("name", $name, ["Required", "Str", "Max"]);
  $validator->validate("email", $email, ["Required", "Email", "Max"]);

  if (!empty($password) && !empty($confirm_password) ) {
    $validator->validate("password", $password, ["Str", "Max"]);
    $validator->validate("confirm_password", $confirm_password, ["Str", "Max"]);
    if ($password != $confirm_password) {
      $validator->errors = ["No Password Matching"];
    }
  }

  if ($validator->hasErrors()) {

    $session->set("errors", $validator->getErrors());
    $request->aredirect("profile.php");

  } else {

    $admin  = new Admin();

    if (! empty($password)) {

      // update query with password
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $admin->update("name = '$name', email = '$email', `password` = '$hashedPassword' ", $session->get("adminId"));
    } else {

      // update query without password
      $admin->update("name = '$name', email = '$email'", $session->get("adminId"));
    }
     
    $session->set("success", "profile editing successFully");
    $request->aredirect('handlers/handlers-logout.php');
  }

} else {

  $request->aredirect("index.php");
}

ob_end_flush();