<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class VerifyMail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token'
    ];
    protected $table = 'verifyemail';
    public function user(){
       return $this->belongsTo(User::class);
    }

}
