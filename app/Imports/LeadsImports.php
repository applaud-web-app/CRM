<?php

namespace App\Imports;

use App\Models\Leads;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Exception;
use Illuminate\Support\Facades\DB;


class LeadsImports implements ToCollection , WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        // For Empty Excel
        if($rows->isEmpty()){
           throw new Exception("The Excel file does not contain any data");
        }

        // Remove Blank Rows
        $filterRows = $rows->filter(function($row){
            return collect($row)->filter(function ($cell) {
                return !empty($cell);
            })->count() > 0;
        });

        if(!count($filterRows)){
            throw new Exception("The Excel file does not contain any data");
        }

        try {
            foreach ($filterRows as $row) {
                DB::beginTransaction();
                $leadCode = "#".rand();
                $crtyId = NULL;
                $stateId = NULL;
                $cityId = NULL;
                $country = DB::table('countries')->where('name',$row['country'])->first();
                $state = DB::table('states')->where('name',$row['state'])->first();
                $city = DB::table('cities')->where('name',$row['city'])->first();
                if($country){
                    $crtyId = $country->id;
                }
                if($state){
                    $stateId = $state->id;
                }
                if($city){
                    $cityId = $city->id;
                }
                
                $assignBy = NULL;
                $assignTo = NULL;
                $assignById = User::where('username',$row['assigned_by'])->first();
                if($assignById){
                    $assignBy = $assignById->id;
                }

                $assignToId = User::where('username',$row['assigned_to'])->first();
                if($assignToId){
                    $assignTo = $assignToId->id;
                }

                if($assignTo != NULL && $assignBy != NULL){
                    Leads::create([
                        'name' => $row['name'] ?? NULL,
                        'mobile' => $row['mobile_number'] ?? NULL,
                        'email' => $row['email_address'] ?? NULL,
                        'code' => $leadCode ?? NULL,
                        'age' => $row['age'] ?? NULL,
                        'price' => $row['lead_value'] ?? NULL,
                        'dob' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['dob'])->format('Y-m-d') ?? NULL,
                        'marital_status' => $row['marital_status'] ?? NULL,
                        'description' => $row['description'] ?? NULL,
                        'address' => $row['address'] ?? NULL,
                        'country' => $crtyId ?? NULL,
                        'state' => $stateId ?? NULL,
                        'city' => $cityId ?? NULL,
                        'zipcode' => $row['zip_code'] ?? NULL,
                        'lead_type' => $row['type'] ?? NULL,
                        'assigned_to' => $assignTo ?? NULL,
                        'status' => $row['status'] ?? NULL,
                        'proccess_status' => "created" ?? NULL,
                        'source' => $row['sources'] ?? NULL,
                        'assigned_by' => $assignBy ?? NULL,
                        'interested' => $row['interested_in'] ?? NULL,
                        'type_of_immigration' => $row['type_od_visa'] ?? NULL,
                        'contacted_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['contacted_date'])->format('Y-m-d') ?? NULL,
                        'close_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['close_date'])->format('Y-m-d') ?? NULL,
                        'lead_mode' => "added" ?? NULL,
                    ]);
                }
                DB::commit();
            }
        } catch (\Throwable $th) {
            throw new Exception("Error! Please fill all the required fields " .$th->getMessage());
        }
       
    }
}
