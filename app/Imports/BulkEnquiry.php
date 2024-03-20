<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Enquiry;
use Exception;
use Illuminate\Support\Facades\DB;

class BulkEnquiry implements ToCollection, WithHeadingRow 
{

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {

        // Check Excel Is Empty Or Not
        if($rows->isEmpty()){
            throw new Exception("Error! The Excel Uploaded Does Not Contain Any Data");
        }

        // Remove Empty Rows
        $filterRows = $rows->filter(function($row){
            return collect($row)->filter(function($cell){
                return !empty($cell);
            })->count() > 0;
        });

        try {
            foreach ($filterRows as $row) 
            {
                DB::beginTransaction();
                Enquiry::create([
                    'name' => $row['name'] ?? NULL,
                    'mobile' => $row['mobile_number'] ?? NULL,
                    'email' => $row['email_address'] ?? NULL,
                    'interested' => $row['interested_in'] ?? NULL,
                    'type_of_immigration' => $row['type_od_visa'] ?? NULL,
                    'source' => $row['sources'] ?? NULL,
                ]);
                DB::commit();
            }             
        } catch (\Throwable $th) {
            throw new Exception("Error! Please fill all the required fields");
        }
       
    }
}
