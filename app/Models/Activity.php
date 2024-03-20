<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity',
        'done_by',
        'sender_id',
        'receiver_id',
        'date'
    ];

    public function senderToken()
    {
        return $this->hasOne(User::class,'id',"sender_id")->select('id','device_token'); 
    } 

    public function reciverToken()
    {
        return $this->hasOne(User::class,'id',"receiver_id")->select('id','device_token'); 
    } 

    public function sender(){
        return $this->hasOne(User::class,'id',"sender_id"); 
    }
}
