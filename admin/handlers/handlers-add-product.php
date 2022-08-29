<?php

ob_start();
require_once "../../app.php";

use TechStore\Classes\Models\Product;
use TechStore\Classes\File;
use TechStore\Classes\Validation\Image;
use TechStore\Classes\Validation\Validator;


if ($request->postHas('submit')) {

  $name       = $request->post('name');
  $cat_id     = $request->post('cat_id');
  $price      = $request->post('price');
  $pieces_no  = $request->post('pieces_no');
  $desc       = $request->post('desc'); 
  $img        = $request->files('img');

  // validation
  $validator = new Validator();
  $validator->validate('name', $name, ["Required", "Str", "Max"]);
  $validator->validate("category", $cat_id, ["Required", "Numeric"]);
  $validator->validate('price', $price, ["Required", "Numeric"]);
  $validator->validate('pieces number', $pieces_no, ["Required", "Numeric"]);
  $validator->validate('description', $desc, ["Required", "Str"]);
  $validator->validate('image', $img, ["RequiredFile", "Image"]);


    if ($validator->hasErrors()) {

      $session->set("errors", $validator->getErrors());
      $request->aredirect("add-product.php");

    } else {

      //upload image

      $file = new File($img);
      $imgUploadName = $file->rename()->upload();

      //DB query

      $product = new Product;
      $product->insert("name, `desc`, price, pieces_no, img, cat_id", 
        "'$name', '$desc', '$price', '$pieces_no', '$imgUploadName', '$cat_id'");

      $session->set("success", "Product added SeccessFlly");
      $request->aredirect("products.php");

    }
    
} else {

  $request->aredirect("add-product.php");
}

ob_end_flush();
