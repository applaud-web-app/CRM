<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Common
{
  public static function immigration()
  {
    return $array = [
      "visa" => [
        'tourist visa' => ['field1', 'field2', 'field3'],
        'x visa' => ['field1'],
        'bussiness visa' => ['field1', 'field2', 'field3'],
        'student visa' => ['field1', 'field2', 'field3'],
        'employee visa' => ['field1', 'field2'],
      ],
        "iets" => [
        "academic" => ['field1', 'field2', 'field3'],
        "general training" => ["field1", "field2", "field3"],
      ],
        "pte" => [
          "general"=>["field1"], 
          "academic"=> ["field1", "field2", "field3"],
      ],
    ];
  }
}