<?php ob_start();
require_once "../app.php";

use TechStore\Classes\Cart;
use TechStore\Classes\Models\Order;
use TechStore\Classes\Models\OrdersDetails;
use TechStore\Classes\Validation\Validator;


$cartObject = new Cart;
$orderObject = new Order;
$ordersDetailsObject = new OrdersDetails;


if ($request->postHas('submit') AND $cartObject->count() !== 0) {

  $name     = $request->post('name');
  $email    = $request->post('email');
  $phone    = $request->post('phone');
  $address  = $request->post('address');

  $validator = new Validator();

  $validator->validate("name", $name, ["Required", "Str", "Max"]);
  $validator->validate("phone", $phone, ["Required", "Str", "Max"]);

  if (!empty($email)) {
    $validator->validate("email", $email, ["Email", "Max"]);
    $email  =  "'$email'";
  }else {
    $email = "null";
  }

  if (!empty($address)) {
    $validator->validate("address", $address, ["Str", "Max"]);
    $address  =  "'$address'";
  } else {
    $address = "null";
  }

  if ($validator->hasErrors()) {
    $session->set("errors", $validator->getErrors());
    $request->redirect("cart.php");
  } else {

    $orderId = $orderObject->insertAndGetId("name, email, phone, address", "'$name', $email, '$phone', $address");

    foreach ($cartObject->all() as $productId => $product) {
      $qty = $product['qty'];
      $ordersDetailsObject->insert("product_id, order_id, qty", "'$productId', '$orderId', '$qty'");
    }

    $cartObject->empty();
    $request->redirect("products.php");
  }

} else {

  $request->redirect("products.php");
}

ob_end_flush();
