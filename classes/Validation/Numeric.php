<?php

namespace TechStore\Classes\Validation;

class Numeric implements ValidationRule
{
  public function check($name, $value)
  {
    if (! is_numeric($value)) {
      return "$name must countain onle numbers";
    }
    return false;
  }
}
