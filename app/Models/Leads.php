<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DocumentCategory;

class Leads extends Model
{
    use HasFactory;
    protected $table="leads";
    protected $casts = [
        'contacted_date' => 'datetime',
    ];
    protected $fillable = [
        "name","mobile","email","code","age","price","dob",
        "marital_status","description","address","country",
        "state","city","zipcode","lead_type","assigned_to",
        "status","assigned_by","contacted_date","close_date",
        "lead_mode","source","proccess_status","enquiry_id","interested","type_of_immigration",'profile_img','notes'
    ];

    public function employee(){
        return $this->hasOne(User::class,"id","assigned_to");
    }

    public function documents(){
        return $this->hasMany(DocumentCategory::class,"type","interested");
    }

    // public function uploads(){
    //     return $this->hasMany(Documents::class,"leads_id","id");
    // }
}
