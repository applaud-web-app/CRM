<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Common
{
  public static function immigration()
  {
       $defaultArray = [

        "visa" => [
          'tourist visa',
          'x visa',
          'business visa',
          'student visa',
          'employee visa'
        ],
        "iets" => [
          "academic",
          "general training",
        ],
        "pte" => [
          "general",
          "academic",
        ],
      ];
      return $defaultArray;
    }

    public static function loadimmigration()
    {
      $data = DB::table("document_category")->select('type', 'subcategory', 'field_type', 'name')->get()->toArray();
          $mergedArray = []; 

        foreach ($data as $value) {
            $type = strtolower($value->type);
            $subcategory = strtolower($value->subcategory);
            $name = strtolower($value->name);

            // Check if type exists in merged array
            if (!isset($mergedArray[$type])) {
                $mergedArray[$type] = [];
            }

            // Check if subcategory exists in type array
            if (!isset($mergedArray[$type][$subcategory])) {
                $mergedArray[$type][$subcategory] = [];
            }
            
            // Check if the name already exists in the subcategory array
            $existsIndex = null;
            foreach ($mergedArray[$type][$subcategory] as $index => $item) {
                if (strtolower($item['name']) === $name) {
                    $existsIndex = $index;
                    break;
                }
            }

            // If the name already exists, replace the existing data with the new one
            if ($existsIndex !== null) {
                $mergedArray[$type][$subcategory][$existsIndex] = [
                    'name' => $value->name,
                    'field_type' => $value->field_type
                ];
            } else {
                // If the name doesn't already exist, add it to the subcategory array
                $mergedArray[$type][$subcategory][] = [
                    'name' => $value->name,
                    'field_type' => $value->field_type
                ];
            }
        }
        return $mergedArray;
    }
  }