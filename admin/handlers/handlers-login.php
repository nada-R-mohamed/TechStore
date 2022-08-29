<?php
ob_start();

require_once ("../../app.php");

use TechStore\Classes\Validation\Validator;
use TechStore\Classes\Models\Admin;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email        = $request->post('email');
  $password     = $request->post('password');

  $validator = new Validator();

  $validator->validate("email", $email, ["Required","Email", "Max"]);
  $validator->validate("password", $password, ["Required","Str", "Max"]);


  if ($validator->hasErrors()) {
    $session->set("errors", $validator->getErrors());
    $request->aredirect("login.php");
  } else {

    $admin  =  new Admin();
    $isLogin = $admin->login($email, $password, $session);
    if ($isLogin) {
      $request->aredirect("index.php");

    } else {
      $session->set("errors", ["credentials are not correct"]);
      $request->aredirect("login.php");
    }

  }

} else {
  
  $request->aredirect("login.php");
}

ob_end_flush();
