<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    use HasFactory;
    protected $table = "document_category";

    public function docs(){
       return $this->belongsTo(Documents::class,'id','document_id');
    }
}
