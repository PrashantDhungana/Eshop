<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyPass extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token'
    ];
    protected $table = 'verifypass';
    
    public function user(){
       return $this->belongsTo(User::class);
    }
}
