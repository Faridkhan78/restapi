<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Register extends Model

{
    use HasFactory,Notifiable,HasApiTokens;
    
    // protected $table ='register';

    protected $table = 'registers';
    
    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'name',
        'mobile',
        'image',        
    ];
}
