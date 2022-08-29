<?php

namespace TechStore\Classes\Validation;

class Validator
{
  public $errors = [];

  public function validate(string $name, $value, array $rules)
  {
    foreach ($rules as $rule) {

      $className =  "TechStore\\Classes\\Validation\\" . $rule;
      $obg = new $className;

      $error = $obg->check($name, $value);

      if ($error != false) {
        $this->errors[] = $error;
        break;
      }
    }
  }

  public function getErrors() : array
  {
    return $this->errors;
  }

  public function hasErrors() :bool
  {
    return ! empty($this->errors);
  }
}
