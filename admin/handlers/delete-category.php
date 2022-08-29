<?php

ob_start();

require_once "../../app.php";

use TechStore\Classes\Models\Cat;


if ($request->getHas("id") && is_numeric($request->get("id"))) {

  $id = $request->get("id");

  $catObject = new Cat;

  $catObject->delete($id);

  $session->set("success", "Category deleted SeccessFliy");
  $request->aredirect("category.php");
}else {
  $request->aredirect("index.php");
}

ob_end_flush();
