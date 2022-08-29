<?php

namespace TechStore\Classes\Validation;

class Image implements ValidationRule
{
  public function check($name, $value)
  {

    $allowedExt = ['png', 'jpg', 'jpeg', 'gif'];

    $ext = pathinfo($value['name'],PATHINFO_EXTENSION);

    if (! in_array($ext, $allowedExt)) {
      
      return "$name extension is not allowed, please upload png,jpg,jpeg,gif";
    }
    return false;
  }
}
