<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExployeeScore extends Model
{
    use HasFactory;
    protected $table = "employee_score";
    protected $fillable=['point','emp_id','reason','target'];
}
