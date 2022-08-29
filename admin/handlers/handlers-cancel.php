<?php
ob_start();

use TechStore\Classes\Models\Order;

require_once "../../app.php";

if ($request->getHas("id") && is_numeric($request->get("id"))) {

  $id = $request->get("id");
  $orderObject = new Order;
  
  $orderObject->update("`status` = 'canceled'", $id);

  $session->set("success", 'order canceled');
  $request->aredirect("order.php?id=$id");
} else {
  $request->aredirect("orders.php");
}

ob_end_flush();
