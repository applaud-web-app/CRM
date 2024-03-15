<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Common
{
  public static function immigration($usedefault = true)
  {
       $defaultArray = [
        // "visa" => [
        //     'tourist visa' => ['Passport', 'Indentity Proof', 'High School Marksheet'],
        //     'x visa' => ['Passport'],
        //     'business visa' => ['Passport', 'Identity Proof', 'GSTIN'],
        //     'student visa' => ['field1', 'field2', 'field3'],
        //     'employee visa' => ['field1', 'field2'],
        // ],
        // "iets" => [
        //     "academic" => ['field1', 'field2', 'field3'],
        //     "general training" => ["field1", "field2", "field3"],
        // ],
        // "pte" => [
        //     "general" => ["field1"],
        //     "academic" => ["field1", "field2", "field3"],
        // ],

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
      
        if($usedefault==false){
          $data = DB::table("document_category")->select('type', 'subcategory', 'field_type', 'name')->get()->toArray();
        //   $mergedArray = $defaultArray; // Start with the default array

        // // Merge fetched data with default array
        // foreach ($data as $value) {
        //     $type = strtolower($value->type);
        //     $subcategory = strtolower($value->subcategory);
        //     $name = strtolower($value->name);

        //     // Check if type exists in merged array
        //     if (!isset($mergedArray[$type])) {
        //         $mergedArray[$type] = [];
        //     }

        //     // Check if subcategory exists in type array
        //     if (!isset($mergedArray[$type][$subcategory])) {
        //         $mergedArray[$type][$subcategory] = [];
        //     }
            
        //     // Check if the name already exists in the subcategory array
        //     $existsIndex = null;
        //     foreach ($mergedArray[$type][$subcategory] as $index => $item) {
        //         if (strtolower($item['name']) === $name) {
        //             $existsIndex = $index;
        //             break;
        //         }
        //     }

        //     // If the name already exists, replace the existing data with the new one
        //     if ($existsIndex !== null) {
        //         $mergedArray[$type][$subcategory][$existsIndex] = [
        //             'name' => $value->name,
        //             'field_type' => $value->field_type
        //         ];
        //     } else {
        //         // If the name doesn't already exist, add it to the subcategory array
        //         $mergedArray[$type][$subcategory][] = [
        //             'name' => $value->name,
        //             'field_type' => $value->field_type
        //         ];
        //     }
        // }

        $mergedArray = $defaultArray; // Start with the default array

        foreach ($data as $value) {
            $type = strtolower($value->type);
            $subcategory = strtolower($value->subcategory);
            $name = strtolower($value->name);

            if (!isset($mergedArray[$type])) {
                $mergedArray[$type] = [];
            }

            if (!isset($mergedArray[$type][$subcategory])) {
                $mergedArray[$type][$subcategory] = [];
            }
            if (isset($mergedArray[$type])) {
                if (isset($mergedArray[$type][$subcategory])) {
                    $mergedArray[$type][$subcategory] = [
                        'name' => $value->name,
                        'field_type' => $value->field_type
                    ];
                } else {
                    $mergedArray[$type][$subcategory][] = [
                        'name' => $value->name,
                        'field_type' => $value->field_type
                    ];
                }
            }
        }
        return $mergedArray;
        }
      return $defaultArray;
    }
  }