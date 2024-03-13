<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    use HasFactory;
    protected $table='followup';
    protected $fillable = ['lead_id','notes','serial_id','next_followup','added_by'];
}
