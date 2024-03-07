<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Leads extends Model
{
    use HasFactory;
    protected $table="leads";
    protected $fillable = [
        "name","mobile","email","code","age","price","dob",
        "marital_status","description","address","country",
        "state","city","zipcode","lead_type","assigned_to",
        "status","assigned_by","contacted_date","close_date",
        "lead_mode"
    ];

    public function employee(){
        return $this->hasOne(User::class,"id","assigned_to");
    }
}
