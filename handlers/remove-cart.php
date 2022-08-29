<?php
ob_start();
require_once("../app.php");

use TechStore\Classes\Cart;

require_once "../app.php";

if ($request->getHas('id')) {

  $id = $request->get('id');

  $cartObject = new Cart;
  $cartObject->remove($id);

  $request->redirect("cart.php");
}

ob_end_flush();
