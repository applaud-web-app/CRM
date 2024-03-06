<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Enquiry;

class BulkEnquiry implements ToModel, WithHeadingRow 
{

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        try {
             Enquiry::create([
                'name' => $row['name'],
                'mobile' => $row['mobile_number'],
                'email' => $row['email_address'],
                'interested' => $row['interested_in'],
                'type_of_immigration' => $row['type_od_visa'],
                'source' => $row['sources'],
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
       
    }
}
